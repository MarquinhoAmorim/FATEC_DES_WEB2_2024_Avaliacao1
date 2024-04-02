<?php
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if (isset($_POST['nome']) && isset($_POST['ra']) && isset($_POST['placa']) && isset($_POST['flexRadioDefault'])) {

            $filename = $_POST['flexRadioDefault'].".txt";

            // Verifica se a placa e ra já existe no arquivo
            $placa_ra_existe = placaRaExiste($filename, $_POST['placa'], $_POST['ra']);

            if (!$placa_ra_existe) {
                if (!file_exists($filename)) {
                    $handle = fopen($filename, "w");
                } else {
                    $handle = fopen($filename, "a");
                }
    
                fwrite($handle, $_POST['nome'] . "|" . $_POST['ra'] . "|" . strtoupper($_POST['placa']) . "\n");
                fclose($handle);
            } 
        }

    } 



    function placaRaExiste($filename, $placa, $ra) {
        if (file_exists($filename)) {
            $linhas = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($linhas as $linha) {
                $dados = explode('|', $linha);
                if ($dados[2] == $placa || $dados[1] == $ra) {
                    return true; // Placa ou RA encontrados
                }
            }
        }

        return false; // Placa ou RA não encontrados
    }
?>


<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="https://fatweb.s3.amazonaws.com/vestibularfatec/assets/img/favicon/favicon-32x32.png">
    <link rel="stylesheet" href="style.css">
  </head>

<body>    
    
    <header class="p-3 text-bg-dark">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="home.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <h2 class="bi me-2">FATEC | Portaria</h2>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </ul>

                <div class="text-end">
                    <a href="logout.php" ype="button" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">

                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-p-square bi me-2" viewBox="0 0 16 16">
                    <path d="M5.5 4.002h2.962C10.045 4.002 11 5.104 11 6.586c0 1.494-.967 2.578-2.55 2.578H6.784V12H5.5zm2.77 4.072c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z"/>
                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
                </svg>
                
                <span class="fs-4">Estacionamento</span>
                
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </ul>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Novo 
                </button>


                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar Veículo</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <!-- Formulário -->
                    <form action="home.php" method="post">
                        <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome" name="nome">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="ra" class="form-label">Registro Acadêmico (RA)</label>
                                        <input type="text" class="form-control" id="ra" name="ra">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="placa" class="form-label">Placa do Veículo</label>
                                        <input type="text" class="form-control" id="placa" name="placa">
                                    </div>

                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="car" value="carros">
                                            <label class="form-check-label" for="car">
                                                Carro
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="moto" value="motos">
                                            <label class="form-check-label" for="moto">
                                                Moto
                                            </label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <input class="btn btn-success" type="submit" value="Cadastrar">
                        </div>
                    </form>
                <!-- Fim do Formulário -->
                    </div>
                </div>
                </div>
        </header>

        <main>
        
        <?php 
        // Verifica se há veículos no estacionamento
        $carros_file = 'carros.txt';
        $motos_file = 'motos.txt';
        
        if (file_exists($carros_file) || file_exists($motos_file)) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>RA</th>
                        <th>Nome Completo</th>
                        <th>Placa do Veículo</th>
                        <th>Veículo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop para ler os dados de ambos os arquivos
                    $filenames = array($carros_file, $motos_file);
                    foreach ($filenames as $filename) {
                        $handle = fopen($filename, "r"); // Abre o arquivo para leitura
                        if ($handle !== false) { 
                            while (!feof($handle)) {
                                $linha = fgets($handle); // Lê uma linha do arquivo
                                $dados = explode('|', $linha); // Divide a linha em partes usando o delimitador '|'
                                if (!empty($linha)){       // Verifica se a linha não está vazia
                    ?>
                            <tr>
                                <td><?php echo $dados[1];  ?></td>
                                <td><?php echo $dados[0]; ?></td>
                                <td><?php echo $dados[2]; ?></td>
                                <td><?php 
                                    if($filename == $carros_file){
                                        echo '
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/>
                                        </svg>';
                                    } else {
                                        echo '
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bicycle" viewBox="0 0 16 16">
                                        <path d="M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5m1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139zM8 9.057 9.598 6.5H6.402zM4.937 9.5a2 2 0 0 0-.487-.877l-.548.877zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53z"/>
                                        </svg>';
                                    }
                                ?></td>
                            </tr>
                    <?php
                                }
                            }
                        }
                    }
                    fclose($handle); // Fecha o arquivo
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-warning text-center" role="alert">
                Não há veículos no estacionamento!
            </div>
        <?php } ?>

            

        </main>
        <footer class="pt-5 my-5 text-body-secondary border-top text-center fixed-bottom">
            Todos os direitos reservados &copy; 2024
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

  </body>
</html>
