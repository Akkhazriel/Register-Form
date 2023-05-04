<!-- Подключаем базу данных -->

<?php require_once 'connect.php';

// Класс регистрации
class Register{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registration($login, $email, $fullName, $age, $city, $photo, $password) {

        // Проверяем что была нажата кнопка
        if(isset($_POST['register'])) {
            $login = htmlspecialchars(trim($_POST['login']));
            $email = htmlspecialchars(trim($_POST['email']));
            $fullName = htmlspecialchars(trim($_POST['fullName']));
            $age = htmlspecialchars(trim($_POST['age']));
            $city = htmlspecialchars(trim($_POST['city']));
            $password = htmlspecialchars(trim($_POST['password']));

            // ПРоверяем что поля не пусты
            if (empty($login) || empty($fullName) || empty($age) || empty($city) || empty($photo) || empty($password)) {
                $_SESSION['error-reg'] = 'Заполните все поля';
            } 

            // Проверяем валидность почты
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error-reg'] = 'Неккоректный E-mail';
            }
            
            // Проверяем валидность имени
            if (!preg_match("/^(([a-zA-Z' -]{1,30})|([а-яА-ЯЁёІіЇїҐґЄє' -]{1,30}))$/u",$fullName)) {
                $_SESSION['error-reg'] = "Введите корректное имя";
            }

            // Проверяем валидность логина
            if (strlen($login) < 3) {
                $_SESSION['error-reg'] = "Логин должен быть длиннее трех символов";
            }  else if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
                $_SESSION['error-reg'] = 'Логин может содержать только латинские буквы и цифры';
            }
            
            // Хешируем пароль
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Загружаем фотографию
            if (!empty($_FILES['photo']['name'])) {
                $photo_name = $_FILES['photo']['name'];
                $photo_tmp_name = $_FILES['photo']['tmp_name'];
                $photo_size = $_FILES['photo']['size'];
                $photo_error = $_FILES['photo']['error'];
                $photo_ext = strtolower(pathinfo($photo_name, PATHINFO_EXTENSION));

                // Проверяем формат фотографии
                if (!in_array($photo_ext, array('jpeg','jpg','png'))) {
                    $_SESSION['error-reg'] = 'Некорректный тип загруженной фотографии';
                }

                // ПРоверяем размер фотографии
                $max_file_size = 524880;
                if($photo_size > $max_file_size) {
                    $_SESSION['error-reg'] = 'Файл слишком большой';
                }

                $photo_new_name = uniqid('', true) . '.' . $photo_ext;
                $photo_dest = '../uploads/' . $photo_new_name;
                move_uploaded_file($photo_tmp_name, $photo_dest);
            } else {
                $photo_new_name = null;
            }

            // Проверяем существует ли пользователь с таким логином или почтой
            $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE login = :login OR email = :email');
            $stmt->execute(['login' => $login, 'email' => $email]);
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $_SESSION['error-reg'] = 'Пользователь с таким логином или почтой уже существует';
                echo $_SESSION['error-reg'];     
            } else {
                $stmt = $this->pdo->prepare("INSERT INTO users
                (login, email, fullName, age, city, password, photo)
                VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute(array($login, $email, $fullName, $age, $city, $password_hash, $photo_new_name));
                echo 'Вы успешно зарегистрировались';
                header("Location: ../blocks/auth.php");
            }
            
        }
    }
        
}

// Добавляем нового пользователя при регистрации
$addUser = new Register($pdo);

$login = $_POST['login'];
$email = $_POST['email'];
$fullName = $_POST['fullName'];
$age = $_POST['age'];
$city = $_POST['city'];
$password = $_POST['password'];
$photo = $_FILES['photo'];


$addUser->registration($login, $email, $fullName, $age, $city, $photo, $password);