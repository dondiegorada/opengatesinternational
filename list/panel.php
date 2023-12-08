<?php
  session_name("panel");
  session_start();

  if (!$_SESSION["bandera"]) {
    header("Location: ../");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="icon" type="image/png" href="../media/imagenes/logo.png">
    <link rel="stylesheet" href="../framework/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../librerias/animate.css/animate.min.css">
    <link rel="stylesheet" href="../librerias/sweetalert2/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../styles/panel.css?v=<?php echo rand(1, 1000); ?>">
  </head>

  <body>
    <div class="container p-4">
      <header>
        <h2 class="text-light">
          <img src="../media/img/logo.png" alt="logo open gates international" height="60" class="rounded-circle"> Panel Administrativo
        </h2>
      </header>
        
      <main>
        <div class="row p-4">
          <div class="col-sm-4 mt-2">
            <div class="card shadow-lg">
              <div class="card-body">
                <h5 class="card-title text-light">Carga de imagenes</h5>
                <p class="card-text text-light">Mantén actualizada la pagina.</p>
                <a href="../forms/cargaImagenes.php" class="btn btn-primary">Entrar</a>
              </div>
            </div>
          </div>
        
          <!-- <div class="col-sm-4 mt-2">
            <div class="card shadow-lg">
              <div class="card-body">
                <h5 class="card-title text-light">Noticias</h5>
                <p class="card-text text-light">Crea noticias del momento sobre el modelaje webcam y nuestro studio.</p>
                <a href="#" class="btn btn-primary">Entrar</a>
              </div>
            </div>
          </div> -->
              
          <!-- <div class="col-sm-4 mt-2">
            <div class="card shadow-lg">
              <div class="card-body">
                <h5 class="card-title text-light">Información</h5>
                <p class="card-text text-light">Modifica los textos a tu gusto y mejoralos cada dia</p>
                <a href="#" class="btn btn-primary">Entrar</a>
              </div>
            </div>
          </div> -->
          
          <div class="col-sm-4 mt-2">
            <div class="card shadow-lg">
              <div class="card-body">
                <h5 class="card-title text-light">Personas registradas</h5>
                <p class="card-text text-light">Clasifica los registros y ten un control.</p>
                <a href="./customers.php" class="btn btn-primary">Entrar</a>
              </div>
            </div>
          </div>
          
          <!-- <div class="col-sm-4 mt-2">
            <div class="card shadow-lg">
              <div class="card-body">
                <h5 class="card-title text-light">Redes sociales</h5>
                <p class="card-text text-light">Agrega las redes sociales que mas interacción tienen</p>
                <a href="#" class="btn btn-primary">Entrar</a>
              </div>
            </div>
          </div> -->
        </div>
      </main>
        
      <footer>
        <a type="button" class="btn btn-warning mt-4" href="../closeSession.php">Cerrar panel</a>
      </footer>
    </div>
    
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffc209" fill-opacity="0.5" d="M0,64L40,85.3C80,107,160,149,240,176C320,203,400,213,480,197.3C560,181,640,139,720,112C800,85,880,75,960,90.7C1040,107,1120,149,1200,181.3C1280,213,1360,235,1400,245.3L1440,256L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
    <script src="../framework/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../librerias/sweetalert2/dist/sweetalert2.js"></script>
  </body>
</html>