<?php
require 'db_credentials.php';


$conn = mysqli_connect($servername, $username, $db_password);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (mysqli_query($conn, $sql)) {
    echo "<br>Database created successfully<br>";
} else {
    echo "<br>Error creating database: " . mysqli_error($conn);
}

mysqli_select_db($conn, $dbname);


$table_users = 'users'; 
$sql = "CREATE TABLE IF NOT EXISTS $table_users (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(35) NOT NULL,
  email VARCHAR(35) NOT NULL,
  password VARCHAR(255) NOT NULL,
  liga VARCHAR(20) NOT NULL, 
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE (email)
)";

$table_scores = 'scores';

$sql_score = "CREATE TABLE IF NOT EXISTS $table_scores (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id INT(6) UNSIGNED,
  score INT NOT NULL,
  date_score DATETIME NULL,
  FOREIGN KEY (user_id) REFERENCES $table_users(id) ON DELETE CASCADE
)";

if (mysqli_query($conn, $sql)) {
    echo "<br>Table created successfully<br>";
} else {
    echo "<br>Error creating table: " . mysqli_error($conn);
}
if (mysqli_query($conn, $sql_score)) {
    echo "<br>Table created successfully<br>";
} else {
    echo "<br>Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>