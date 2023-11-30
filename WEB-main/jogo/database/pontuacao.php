<?php

require "db_functions.php";
require "authenticate.php";

$conn = connect_db();

$score = $_POST['score'];

$sql = "INSERT INTO scores (user_id, score, date_score) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ii", $user_id, $score);
    $stmt->execute();

} else {
    echo json_encode(['error' => 'Erro ao preparar a declaração SQL']);
}

?>

<?php
