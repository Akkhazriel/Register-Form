<!-- Файл с авторизацией -->

<!-- Подключаем базу данных -->
<?php require_once '../logic/connect.php'; ?>

<!-- Задаем переменные -->
<?php $title = "Авторизация" ?>
<?php $link = "../css/auth.css" ?>

<!-- Подключаем шапку сайта -->
<?php require_once '../blocks/header.php'; ?>

<section class="authorisation">
    <div class="auth__block">
        <div class="auth__content">
            <h1>Hello, do we know each other?</h1>
        </div>
        <!-- Форма для авторизации -->
        <form action="../logic/signin.php" method="POST" class="auth__form">
            <input type="text" name="login" placeholder="Login" class="auth__inp">
            <input type="password" name="password" placeholder="Password" class="auth__inp">

            <button type="submit" name="auth" class="btn__auth">Войти</button>
            <a href="register.php" class="btn__link">Еще нет аккаунта?</a>
        </form>
    </div>
</section>