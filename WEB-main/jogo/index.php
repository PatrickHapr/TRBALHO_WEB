<?php
  require "database/authenticate.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>FANTASY FIGHT</title>
  <link rel="stylesheet" href="css/bem-vindo.css">
</head>
<body>
  <h1> FANTASY FIGHT
    <?php
      if ($login) {
        echo ", $user_name!";
      }
    ?>
  </h1>
  <ul>
  <?php
if (!$login) {
    echo '<li><a href="database/login.php">Login</a></li>';
    echo '<li><a href="database/rank.php">Ranking</a></li>';
    echo '<li><a href="database/register.php">Registrar-se</a></li>';
} else {
    header("Location: game/inicio.php");
    exit(); 
}
?>
  </ul>
</body>
</html>
