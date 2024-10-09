<!DOCTYPE html>
<html lang="uk">
  <head>
    <meta charset="UTF-8" />
    <title>Login Form</title>
    <link rel="stylesheet" href="styles/login_form.css" />
  </head>
  <body>
    <div class="box">
      <div class="form">
        <h2>Увійти</h2>

        <form action="login_handler.php" method="POST">
          
          <div class="inputBox">
            <input type="text" name="username" required="required" />
            <span>Логін</span>
            <i></i>
          </div>

          <div class="inputBox">
            <input type="password" name="password" required="required" />
            <span>Пароль</span>
            <i></i>
          </div>

          <div class="links">
            <a href="reg.php">Зареєструватись</a>
          </div>
          <input type="submit" value="Увійти" />
        <form>

        <!-- Блок для сообщений -->
            <?php if (isset($_GET['message']) && isset($_GET['type'])): ?>
                <div class="message <?php echo htmlspecialchars($_GET['type']); ?>">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
            <?php endif; ?>

      </div>
    </div>

    <script>
      // Показываем блок с сообщением, если оно есть
      const messageDiv = document.querySelector('.message');
      if (messageDiv) {
      messageDiv.style.display = 'block';

      // Скрываем сообщение через 5 секунд (5000 миллисекунд)
      setTimeout(() => {
        messageDiv.style.display = 'none';
      }, 3000);
    }
    </script>
  </body>
</html>
