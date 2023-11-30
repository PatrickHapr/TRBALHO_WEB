<!DOCTYPE html>
<html lang="br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/historico.css">
</head>


<body>
    <div class="container mt-5 text-center">
        <h2>Histórico</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped fixed-width-table">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Pontuação</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "db_functions.php";
                require "authenticate.php";
                $conn = connect_db();
                $sql = "SELECT users.name, scores.score, scores.date_score 
                FROM users 
                INNER JOIN scores ON users.id = scores.user_id
                WHERE users.id = $user_id ";
                $sql .= " ORDER BY scores.date_score DESC LIMIT 10";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row["score"] != null) {
                            echo "<tr>";
                            echo "<td style='color: white;'>" . $row["name"] . "</td>"; 
                            echo "<td style='color:white;'>" . $row["score"] . "</td>"; 
                            echo "<td style='color:white;'>" . $row["date_score"] . "</td>"; 
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='2'>Nenhum resultado encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <form action="../index.php" method="post" class="position-relative float-end">
        <button type="submit" name="voltar" class="btn btn-primary" id="voltar"
            style="font-size: 5vh; position: fixed; top: 10vh;left: 90vw">Voltar</button>
    </form>
</body>

</html>