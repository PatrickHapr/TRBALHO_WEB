<?php
require "../database/authenticate.php";
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FANTASY FIGHT</title>
    <link rel="stylesheet" href="../css/derrota.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1> GAME OVER! <h1>
            <h1> VOCÊ MORREU,
                <?php
                if ($login) {
                    echo "$user_name!";
                }
                ?>
            </h1>
                <br>
                <br>
                <br>
                <a href="../index.php" class="btn btn-primary mt-3" style="font-size: 5vh;">Início</a>
                <a href="../database/logout.php" class="btn btn-primary mt-3" style="font-size: 5vh;">Sair</a>
</body>

</html>