<!-- Файл подключения базы данных -->

<?php 

$driver = 'mysql';
$host = 'localhost';
$db_name = 'users_form';
$db_user = 'crsty';
$db_pass = '23042001';
$charset = 'utf8';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO("$driver:host=$host;
        dbname=$db_name;
        charset=$charset;",
        $db_user, $db_pass, $options);
        session_start();
} catch(PDOException $e) {
    die ('Нет связи с базой');
}