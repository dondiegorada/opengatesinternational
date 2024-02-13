<?php
  session_name("panel");
  session_start();

  if (!$_SESSION["bandera"]) {
    header("Location: ../");
  }

  require("../class/db.class.php");
  require("../class/customersDAO.php");

  $customersDAO = new customersDAO();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="icon" type="image/png" href="../media/img/logo.png">
    <link rel="canonical" href="https://lucistudio.com.co">
    <link rel="stylesheet" href="../framework/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../librerias/animate.css/animate.min.css">
    <link rel="stylesheet" href="../librerias/sweetalert2/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@300&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="../styles/cargaImgs.css" />
  </head>

  <body>
    <header>
      <div class="header">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
          <path fill="#F1EDE9" fill-opacity="1" d="M0,64L80,96C160,128,320,192,480,186.7C640,181,800,107,960,74.7C1120,43,1280,53,1360,58.7L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
          </path>
        </svg>
      
        <div class="back">
          <a type="button" href="./panel.php"> 
            <img src="../media/img/back.svg" alt="regresar" height="40" />
          </a>
        </div>
        
        <div class="titulo">
          <h2> Personas Registradas</h2>
        </div>
      </div>
    </header>

    <main>
      <section class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
              Pendientes
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
              Aprobados
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
              Rechazados
            </button>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="mt-5 position-relative z-index-1">
              <input
                aria-describedby="passwordHelpBlock"
                class="form-control"
                id="search"
                placeholder="Buscar..."
                type="text"
                onkeydown="search(this);"
              />
              
              <!-- <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
              </div> -->
            </div>

            <div class="table-responseve mt-5">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nombres</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Edad</th>
                    <th>Testimonios</th>
                    <th>Estado</th>
                    <th>Fecha de registro</th>
                    <th colspan="2">Opción</th>
                  </tr>
                </thead>
                    
                <tbody id="tbody"></tbody>
              </table>
            </div>
          </div>
          
          <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="table-responseve mt-5">
              <table class="table table-striped table-bordered">
                  <thead>
                      <tr>
                          <th>Nombres</th>
                          <th>Apellidos</th>
                          <th>Telefono</th>
                          <th>Email</th>
                          <th>Edad</th>
                          <th>Dudas</th>
                          <th>Estado</th>
                          <th>Fecha de registro</th>
                          <th>Opción</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      $modelos = $customersDAO -> getAll('A');

                      if ( $modelos ) {
                          while($row = mysqli_fetch_assoc($modelos)){
                          ?>
                          <tr>
                              <td><?php echo $row['nombres']; ?></td>
                              <td><?php echo $row['apellidos']; ?></td>
                              <td><?php echo $row['telefono']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td><?php echo $row['edad']; ?></td>
                              <td><?php echo $row['comentario']; ?></td>
                              <td><span class="badge bg-warning"><?php echo $row['estado']; ?></span></td>
                              <td><?php echo $row['fecha_registro']; ?></td>
                              <td>
                                <button type="button" class="btn" onclick="declinar(<?php echo $row['_id']?>)">
                                  <img src="../media/img/cerrar.svg" height="30" alt="declinar">
                                </button>
                              </td>
                          </tr>
                          <?php
                          }
                      }else{

                      }
                      ?>
                  </tbody>
              </table>
            </div>
          </div>
          
          <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <div class="table-responseve mt-5">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Edad</th>
                            <th>Dudas</th>
                            <th>Estado</th>
                            <th>Fecha de registro</th>
                            <th>Opción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $modelos = $customersDAO -> getAll('R');

                        if ( $modelos ) {
                            while($row = mysqli_fetch_assoc($modelos)){
                            ?>
                            <tr>
                                <td><?php echo $row['nombres']; ?></td>
                                <td><?php echo $row['apellidos']; ?></td>
                                <td><?php echo $row['telefono']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['edad']; ?></td>
                                <td><?php echo $row['comentario']; ?></td>
                                <td><span class="badge bg-dark"><?php echo $row['estado']; ?></span></td>
                                <td><?php echo $row['fecha_registro']; ?></td>
                                <td>
                                  <button type="button" class="btn" onclick="seleccionar(<?php echo $row['_id']?>)">
                                    <img src="../media/img/comprobado.svg" height="30" alt="aprobar">
                                  </button>
                                </td>
                            </tr>
                            <?php
                            }
                        }else{

                        }
                        ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </section>
    </main>

    <script src="../librerias/jquery-3.5.1.min.js"></script>
    <script src="../framework/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../librerias/popper.min.js"></script>
    <script src="../librerias/sweetalert2/dist/sweetalert2.js"></script>
    <script src="../js/users.js?v=<?php echo rand(1, 1000); ?>"></script>
      
  </body>
</html>