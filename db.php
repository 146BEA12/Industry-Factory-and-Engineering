<?php
    $servername = "127.0.0.1"; // Имя сервера базы данных
    $username = "root";    // Имя пользователя базы данных
    $password = "";    // Пароль пользователя базы данных
    $dbname = "database"; // Имя базы данных

    // Создаем соединение
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверяем соединение
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
