<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Opening Gates International</title>
    <meta name="description" content="Trabajo en el exterior, tramita tu visa de trabajo, asesoría personalizada" />
    <meta name="keywords" content="Trabajo, Visa, Europa" />
    <?php require('./components/head.html'); ?>
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo rand(1, 1000); ?>">
  </head>

  <body>
    <div class="container-fluid container-form">
      <header>
        <?php require('./components/navbar.html'); ?>
      </header>
      
      <main class="container z-index-1">
        <div class="row pt-8">
          <div class="col-md-5 content-form mb-5">
            <h3 class="fw-bold">¿Estás buscando una forma confiable y segura de obtener tu visa y tu empleo?</h3>

            <p class="h5 mt-4">
              registrate y deja tus datos de contacto, podrás acceder a un servicio personalizado y gratuito que te ayudará a encontrar el trabajo y la visa que mejor se adapten a tu perfil y a tus expectativas.
            </p>
          </div>

          <div class="col"></div>

          <div class="col-md-6">
            <h2 class="fw-bold">¡Registrate ahora!</h2>
          
            <form id="form" class="p-2" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-12 mb-4">
                  <label for="inputPassword5" class="form-label">Nombres y Apellidos</label>
                  <input type="text" id="name" name="name" class="form-control" aria-describedby="passwordHelpBlock" required />
                </div>

                <div class="col-md-6 mb-4">
                  <label for="inputPassword5" class="form-label">Telefóno</label>
                  <input type="number" id="phone" name="phone" class="form-control" aria-describedby="passwordHelpBlock" required>
                </div>
                
                <div class="col-md-6 mb-4">
                  <label for="years" class="form-label">Edad</label>
                  <select class="form-select" id="years" name="years" aria-label="Floating label seleccione edad" required> <?php
                    $year = array(18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39); ?>

                    <option selected>[ Selecciona ]</option> <?php
                    
                    foreach ($year as $value) { ?>
                      <option value="<?php echo $value; ?>"><?php echo $value; ?></option> <?php
                    } ?>
                    
                    <option value="40">40+</option>
                  </select>
                </div>

                <div class="col-md-12 mb-4">
                  <label for="inputPassword5" class="form-label">Email</label>
                  <input type="email" id="email" name="email" class="form-control" aria-describedby="passwordHelpBlock" required />
                </div>

                <div class="col-md-6 mb-4">
                  <label for="country" class="form-label">País</label>
                  <select class="form-select" id="country" name="country" aria-label="Floating label seleccione country" required>
                    <option selected>[ Selecciona ]</option>
                  </select>
                </div>

                <div class="col-md-6 mb-4">
                  <label for="state" class="form-label">Departamento o Estado</label>
                  <select class="form-select" id="state" name="state" aria-label="Floating label seleccione state" required>
                    <option selected>[ Selecciona un país ]</option>
                  </select>
                </div>

                <!-- <div class="col-md-12 mb-4">
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Testimonios</label>
                    <textarea class="form-control" id="testimonio" name="testimonio" rows="3"></textarea>
                  </div>
                </div> -->
              
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input" type="checkbox" role="switch" id="check-terminos">
                  <label class="form-check-label" for="flexSwitchCheckDefault">
                    Aceptar <a href="./terminos.php" class="text-primary">terminos y condiciones</a>
                  </label>
                </div>
              
                <div class="gap-2">
                  <button type="submit" class="btn btn-primary" id="enviar" disabled>Enviar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>

    <footer>
      <?php require('./components/footer.html'); ?>
    </footer>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
      <div id="liveToast" class="toast text-bg-dark" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header text-bg-light">
          <strong class="me-auto"></strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body"></div>
      </div>
    </div>

    <script src="./librerias/jquery-3.5.1.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous">
    </script>
    <script src="./librerias/popper.min.js"></script>
    <script src="./librerias/sweetalert2/dist/sweetalert2.js"></script>
    <script src="./librerias/wow/dist/wow.min.js"></script>
    <script src="./js/alerts.js"></script>
    <script src="./js/utils.js"></script>
    <script src="./js/register.js?v=<?php echo rand(1, 1000); ?>"></script>
  </body>
</html>