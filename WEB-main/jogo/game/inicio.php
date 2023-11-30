<?php
  require "../database/authenticate.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>FANTASY FIGHT</title>
  <link rel="stylesheet" href="../css/inicio.css">
</head>
<body>
  <h1> Bem-Vindo
    <?php
        echo "$user_name!";
    ?>
  </h1>
  <ul>
  <?php
    echo '<li><a href="../game/jogo.php">Jogar</a></li>';
    echo '<li><a href="../database/historico.php">Histórico</a></li>';
    echo '<li><a href="../database/rank.php">Ranking</a></li>';
    echo '<li><a href="../database/logout.php">Sair</a></li>';
?>
  </ul>
</body>
</html>
