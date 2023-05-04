<!-- Файл с авторизацией -->

<?php require_once 'connect.php';

// Класс авторизации, принимает в себя базу данных,
// Проходит проверку на существование пользователя, 
// Проходит проверку на то что все поля заполнены
// После авторизации вся информация о пользователе передается в сессию
class Auth{
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function authtorisation($login, $password) {
        if(isset($_POST['auth'])) {
            // Рефакторим полученные данные для избежания sql инъекций
            $login = htmlspecialchars(trim($_POST['login']));
            $password = htmlspecialchars(trim($_POST['password']));

            if (empty($login) || empty($password)) {
                $_SESSION['error-auth'] = 'Заполните все поля';
                echo $_SESSION['error-auth'];
            }

            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE login = :login');
            $stmt->execute(['login' => $login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            // Сопоставляем полученный логин и его пароль
            if ($user && password_verify($password, $user['password'])) {
                // Записываем данные в сессию и переходим на страницу профиля
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_login'] = $user['login'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_fullname'] = $user['fullName'];
                $_SESSION['user_age'] = $user['age'];
                $_SESSION['user_city'] = $user['city'];
                $_SESSION['user_photo'] = $user['photo'];
                header("Location: ../index.php");
            } else {
                // Ошибка
                $_SESSION['error-auth'] = 'Неправильный логин или пароль';
                header("Location: ../blocks/auth.php");
            }
        }   
    }
}


if(isset($_POST['login']) && isset($_POST['password'])) {  
    $login = $_POST['login'];
    $password = $_POST['password'];
    $authUser = new Auth($pdo);
    $authUser->authtorisation($login, $password);
}