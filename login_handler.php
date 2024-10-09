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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверяем, существует ли пользователь с таким именем пользователя
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Получаем данные пользователя
        $user = $result->fetch_assoc();

        // Хешируем введённый пароль с солью
        $salt = "slefie7";
        $password_hashed = md5($salt . $password);

        // Проверяем хешированный пароль
        if ($password_hashed === $user['password']) {
            // Успешный вход
            header("Location: log.php?message=" . urlencode("Вхід успішний! Ласкаво просимо, " . $user['username']) . "&type=success");
            exit();
        } else {
            // Неверный пароль
            header("Location: log.php?message=" . urlencode("Неправильний пароль!") . "&type=error");
            exit();
        }
    } else {
        // Пользователь не найден
        header("Location: log.php?message=" . urlencode("Користувача не знайдено!") . "&type=error");
        exit();
    }
}

// Закрываем соединение
$conn->close();
?>