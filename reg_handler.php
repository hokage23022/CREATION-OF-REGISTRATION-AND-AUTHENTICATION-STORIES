<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reg_db";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salt = 'slefie7';
    // Получаем данные из формы
    $user = $_POST['username'];
    $password = md5($salt . $_POST['password']); // Хешируем пароль

    // SQL-запрос для вставки данных
    $sql = "INSERT INTO users (username, password, salt) VALUES ('$user', '$password', '$salt')";

    if ($conn->query($sql) === TRUE) {
        // Регистрация прошла успешно
        header("Location: reg.php?message=" . urlencode("Реєстрація пройшла успішно!") . "&type=success");
        exit();
    } else {
        // Ошибка при регистрации
        header("Location: reg.php?message=" . urlencode("Помилка: " . $conn->error) . "&type=error");
        exit();
    }
}

// Закрываем соединение
$conn->close();
?>