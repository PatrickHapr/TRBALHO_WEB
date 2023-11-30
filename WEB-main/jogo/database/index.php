<?php
require "authenticate.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>[WEB 1] Exemplo Sistema de Login</title>
</head>
<body>
  <header>
    <h1>Bem-vindo
      <?php
      if ($login) {
        echo ", $user_name!";
      } else {
        echo "!";
      }
      ?>
    </h1>
  </header>

  <main>
    <p>Escolha uma das opções:</p>
    <ul>
      <?php if ($login): ?>
        <li><a href="logout.php">Logout</a></li>
      <?php else: ?>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Registrar-se</a></li>
      <?php endif; ?>
    </ul>
  </main>
</body>
</html>
