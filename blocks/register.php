<!-- Форма для регистрации пользователя -->


<!-- Подключаем файл с базой данных -->
<?php require_once '../logic/connect.php'; ?>

<!-- Задаем переменные -->
<?php $title = "Регистрация" ?>
<?php $link = "../css/reg.css" ?>

<!-- Подключаем шапку сайта -->
<?php require_once '../blocks/header.php'; ?>

<section class="register">

    <div class="reg__block">
        <div class="register__block">
            <!-- Форма для регистрации -->
            <form action="../logic/signup.php" method="POST" class="reg__form" enctype="multipart/form-data">
                <!-- Заголовок -->
                <div class="reg__form-text">
                    <h1>Just say Hello !</h1>
                    <p>Let us know more about you !</p>
                </div>
                <!-- Строка с логином и почтой -->
                <div class="login__email">
                    <input type="text" name="login" placeholder="Login" class="reg__input">
                    <input type="text" name="email" placeholder="Email" class="reg__input">
                </div>
                <!-- Строка с датой и именем -->
                <div class="fullName__date">
                    <input type="text" name="fullName" placeholder="Full Name" class="reg__input">
                    <input type="date" required name="age" min="1920-01-01" max="2009-01-01" class="reg__input reg__input-date">
                </div>
                <!-- INPUTS -->
                <input type="text" name="city" placeholder="City" class="reg__input">
                <input type="file" name="photo" class="reg__input reg__input-photo">
                <input type="password" name="password" placeholder="Password" class="reg__input">

                <button type="submit" name="register" class="btn__reg">Зарегистрироваться</button>

            </form>
        </div>
        <!-- Контактная информация -->
        <div class="register__about">
            <a href="auth.php" class="btn__link">Уже есть аккаунт?</a>
            <p class="register__desc">
                <span>Contact Information</span> <br>
                77 Baker Street <br>
                Bondowoso. 87655 <br>
                Indonesia <br>
                We are open from Monday - Friday <br>
                08.00 am - 05.00 pm
            </p>
        </div>
    </div>

</section>

<!-- Подключаем нижнюю часть сайта -->
<?php require_once '../blocks/footer.php'; ?>