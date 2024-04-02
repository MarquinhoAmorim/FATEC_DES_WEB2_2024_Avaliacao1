<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        session_start();
        if($_POST['usuario'] == 'portaria' and $_POST['senha'] == 'FatecAraras'){
            $_SESSION['loggedin'] = TRUE;
            $_SESSION["usuario"] = 'portaria';
            header("location: home.php");
        } else {
            $_SESSION['loggedin'] = FALSE;
        }
    }
?>



<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="https://fatweb.s3.amazonaws.com/vestibularfatec/assets/img/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="style.css">
  </head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">    
    <main class="form-signin w-100 m-auto">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <img class="mb-4" src="img/logo_fatec_cor.png" width="250">

            <div class="form-floating">
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
              <label for="usuario">Usuário</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
              <label for="senha">Senha</label>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-body-secondary text-center">&copy; 1969–2024</p>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>