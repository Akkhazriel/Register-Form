<!-- Основной файл с профилем -->

<!-- Подключаем базу данных -->
<?php require_once 'logic/connect.php'; ?>

<!-- Подключаем файл с авторизацией -->
<?php require_once 'logic/signin.php'; ?>

<!-- Задаем переменные  -->
<?php $title = 'Главная'; ?>
<?php $link = 'css/main.css'; ?>

<!-- Подключаем шапку сайта -->
<?php require_once 'blocks/header.php'; ?>

<section class="main">
    <div class="profile">
        <!-- Проверяем, что сессия содержит в себе ID авторизованного пользователя -->
        <?php if(isset($_SESSION['user_id'])): ?>
            <div class="profile__content">
                <!-- Выводим всю информацию по пользователю которая есть в базе данных -->
                <h1>Добро пожаловать, <?php echo $_SESSION['user_fullname']; ?>!</h1>
                <p>Ваш логин: <?php echo $_SESSION['user_login']; ?></p>
                <p>Ваш E-mail: <?php echo $_SESSION['user_email']; ?></p>
                <p>Ваш возраст: <?php echo $_SESSION['user_age']; ?></p>
                <p>Ваш город: <?php echo $_SESSION['user_city']; ?></p>
                <!-- Выводим фотографию если она есть -->
                <?php if ($_SESSION['user_photo']): ?>
                    <img src="uploads/<?php echo $_SESSION['user_photo']; ?>" alt="Фото пользователя">
                <?php endif; ?>
                <!-- Ссылка на выход из аккаунта  -->
                <a href="logic/logout.php">Выйти из аккаунта</a>
            </div>
        <?php else: ?>
            <!-- Если сессия не содержит в себе ID пользователя -->
            <h1>Вы не авторизованы</h1>
            <p>Пожалуйста, 
                <a href="blocks/auth.php">Войдите</a> или 
                <a href="blocks/register.php">Зарегистрируйтесь</a>
            </p>
        <?php endif; ?>

    </div>
</section>

<!-- Подключаем нижнюю часть сайта -->
<?php require_once 'blocks/footer.php'; ?>