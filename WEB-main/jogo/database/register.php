<?php
require "db_functions.php";

$error = false;
$success = false;
$name = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verificação dos campos preenchidos
  if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"]) && isset($_POST["liga"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $liga = $_POST["liga"];

    // Validar formato de e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_msg = "Formato de e-mail inválido.";
      $error = true;
    } elseif ($password !== $confirm_password) {
      $error_msg = "Senha não confere com a confirmação.";
      $error = true;
    } elseif (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
      $error_msg = "A senha deve ter pelo menos 8 caracteres, conter letras maiúsculas, números e caracteres especiais.";
      $error = true;
    } else {
      // Conectar ao banco de dados
      $conn = connect_db();

      // Sanitizar entrada
      $name = mysqli_real_escape_string($conn, $name);
      $email = mysqli_real_escape_string($conn, $email);

      // Hash da senha
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Inserir usuário no banco de dados
      $sql = "INSERT INTO $table_users (name, email, password, liga) VALUES ('$name', '$email', '$hashed_password', '$liga')";

      if (mysqli_query($conn, $sql)) {
        $success = true;
      } else {
        $error_msg = mysqli_error($conn);
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
  <title>REGISTRO</title>
  <link rel="stylesheet" href="../css/registro.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <h1 class="text-primary">Dados para registro de novo usuário</h1>

  <?php if ($success): ?>
    <h3 style="color:lightgreen;">Usuário criado com sucesso!</h3>
  <?php endif; ?>

  <?php if ($error): ?>
    <h3 style="color:red;">
      <?php echo $error_msg; ?>
    </h3>
  <?php endif; ?>

  <div class="container mt-5">
    <div class="offset-sm-3">
      <form action="register.php" method="post" class="col-sm-6">
        <div class="row mb-3">
          <label for="name" class="col-sm-4 col-form-label text-info text-end">Nome:</label>
          <div class="col-sm-8">
            <input type="text" name="name" value="<?php echo htmlentities($name); ?>"
              class="form-control form-control-sm controle" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="email" class="col-sm-4 col-form-label text-info text-end">Email:</label>
          <div class="col-sm-8">
            <input type="text" name="email" value="<?php echo htmlentities($email); ?>"
              class="form-control form-control-sm controle" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="name" class="col-sm-4 col-form-label text-info text-end">Liga:</label>
          <div class="col-sm-8">
            <select name="liga" class="form-select form-select-sm controle" required>
              <option value="" selected disabled>Selecione a liga</option>
              <option value="Ruby">Ruby</option>
              <option value="Diamond">Diamond</option>
              <option value="Sapphire">Sapphire</option>
            </select>
          </div>
        </div>

        <div class="row mb-3">
          <label for="password" class="col-sm-4 col-form-label text-info text-end">Senha:</label>
          <div class="col-sm-8">
            <input type="password" name="password" value="" class="form-control form-control-sm controle" required>
          </div>
        </div>

        <div class="row mb-3">
          <label for="confirm_password" class="col-sm-4 col-form-label text-info text-end">Confirmar Senha:</label>
          <div class="col-sm-8">
            <input type="password" name="confirm_password" value="" class="form-control form-control-sm controle"
              required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-sm-10 offset-sm-6">
            <button type="submit" name="submit" class="btn btn-primary">Criar usuário</button>
          </div>
        </div>
      </form>
    </div>

    <ul>
      <li>
        <a href="../index.php" class="btn btn-primary" id="bt">Voltar</a>
      </li>
    </ul>
  </div>
</body>

</html>