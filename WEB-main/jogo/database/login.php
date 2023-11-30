<?php
require "db_functions.php";
require "authenticate.php";

$error = false;
$email = "";

if (!$login && $_SERVER["REQUEST_METHOD"] == "POST") {
  // Verifica se os campos foram preenchidos
  if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar formato de e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_msg = "Formato de e-mail inválido.";
      $error = true;
    } else {
      // Conectar ao banco de dados
      $conn = connect_db();

      // Sanitizar entrada
      $email = mysqli_real_escape_string($conn, $email);

      // Consultar o banco de dados para o usuário
      $sql = "SELECT id, name, email, password FROM $table_users WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verificar a senha usando password_verify()
        if (password_verify($password, $user["password"])) {
          // Definir as informações do usuário na sessão
          $_SESSION["user_id"] = $user["id"];
          $_SESSION["user_name"] = $user["name"];
          $_SESSION["user_email"] = $user["email"];

          // Redirecionar para a página após o login
          header("Location: ../game/inicio.php");
          exit();
        } else {
          $error_msg = "Senha incorreta!";
          $error = true;
        }
      } else {
        $error_msg = "Usuário não encontrado!";
        $error = true;
      }
      mysqli_close($conn);
    }
  } else {
    $error_msg = "Por favor, preencha todos os dados.";
    $error = true;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="../css/login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <h1 class="text-primary">Login</h1>
  <?php
  if ($login) {
    header("Location: ../jogo.php");
    exit();
  }
  ?>

  <?php if ($error): ?>
    <h3 style="color:red;">
      <?php echo $error_msg; ?>
    </h3>
  <?php endif; ?>

  <div class="container mt-5">
    <div class="offset-sm-3">
      <form action="login.php" method="post" class="col-sm-6">
        <div class="row mb-3">
          <label for="email" class="col-sm-4 col-form-label text-info text-end">Email:</label>
          <div class="col-sm-8">
            <input type="text" name="email" value="<?php echo htmlentities($email); ?>"
              class="form-control form-control-sm controle" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="password" class="col-sm-4 col-form-label text-info text-end">Senha:</label>
          <div class="col-sm-8">
            <input type="password" name="password" value="" class="form-control form-control-sm controle" required>
          </div>
        </div>
        <div>
        </div>
        <div class="row mb-3">
          <div class=" text-center">
            <input type="submit" name="submit" value="Entrar" id="bt" class="btn btn-primary">
          </div>
        </div>
      </form>
    </div>
    <ul>
      <li>
        <a href="../index.php" class="btn btn-primary" id="bt">Voltar</a>
      </li>
    </ul>
    
</body>

</html>