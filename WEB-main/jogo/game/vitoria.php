<?php
require "../database/db_functions.php";
require "../database/authenticate.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>FANTASY FIGHT</title>
    <link rel="stylesheet" href="../css/vitoria.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1> VITÓRIA!!! <h1>
            <h1> VOCÊ É O HERÓI
                <?php
                if ($login) {
                    echo ", $user_name!";
                }
                ?>
            </h1>
            <h1> PONTUAÇÃO:
                <?php
                $conn = connect_db();
                $sql = "SELECT scores.score
                        FROM users 
                        INNER JOIN scores ON users.id = scores.user_id
                        WHERE users.id = $user_id
                        ORDER BY scores.date_score DESC LIMIT 1";

                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $score = $row['score'];
                    echo $score;
                } else {
                    echo "Pontuação não encontrada.";
                }
                ?>
            </h1>
            <h1>
                <br>
                <br>
                <br>
                <a href="../index.php" class="btn btn-primary mt-3" style="font-size: 5vh;">Início</a>
                <a href="../index.php" class="btn btn-primary mt-3" style="font-size: 5vh;">Sair</a>
            </h1>
</body>

</html>