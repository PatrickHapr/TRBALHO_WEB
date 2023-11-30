<!DOCTYPE html>
<html lang="br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/rank.css">
</head>


<body>
    <div class="container mt-5 text-center">
        <h2>Ranking</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped fixed-width-table">
            <thead class="bg-info text-white">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Pontuação</th>
                    <th scope="col">Liga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require "db_functions.php";
                $conn = connect_db();
                $liga = "all";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["listarPor"])) {
                    $liga = $_POST["listarPor"];
                }

                $sql = "SELECT users.name AS user_name, scores.score AS user_score, users.liga AS user_liga 
                        FROM users
                        INNER JOIN scores ON users.id = scores.user_id";

                if ($liga !== "all") {
                    $sql .= " WHERE users.liga = '$liga'";
                }

                $sql .= " ORDER BY scores.score DESC LIMIT 10";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row["user_score"] != null) {
                            echo "<tr>";
                            echo "<td style='color: white;'>" . $row["user_name"] . "</td>"; 
                            echo "<td style='color:white;'>" . $row["user_score"] . "</td>"; 
                            echo "<td style='color:white;'>" . $row["user_liga"] . "</td>"; 
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='3'>Nenhum resultado encontrado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <form action="../index.php" method="post" class="position-relative float-end">
        <button type="submit" name="voltar" class="btn btn-primary" id="voltar"
            style="font-size: 5vh; position: fixed; top: 10vh;left: 90vw">Voltar</button>
    </form>
    <form action="rank.php" method="post" class="position-relative float-end">
    <label for="listarPor" class="visually-hidden">Listar Por</label>
    <select name="listarPor" id="listarPor" class="form-select form-select-lg" style="font-size: 1rem; position: fixed; top: 10vh; left: 5vw; width: 10vw">
        <option value="all">Mundial</option>
        <option value="ruby">Liga Ruby</option>
        <option value="sapphire">Liga Sapphira</option>
        <option value="diamond">Liga Diamond</option>
    </select>
    <input type="submit" value="Filtrar" class="btn btn-primary" style="font-size: 3vh;position: fixed; top: 10vh; left: 18vw;">
</form>
</body>

</html>