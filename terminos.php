<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Terminos - Condiciones</title>
    <?php require('./components/head.html'); ?>
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo rand(1, 1000); ?>">
  </head>

  <body>
    <header>
      <?php require('./components/navbar.html'); ?>
    </header>

    <main>
      <div class="container mt-5">
        <div class="col-12">
          <div class="contacto shadow-lg">
            <div class="elements-form">
              <div class="recuadro-rotate"></div>
              <div class="circulo-rotate"></div>
            </div>
            
            <h2 class="fw-bold text-center m-2">Terminos y condiciones</h2><br>
            
            <h5 class="fw-bold">1. Aceptación</h5>
            <p class="h5">
              Al registrarte en Open Gates International, aceptas cumplir con estos términos y condiciones. Si no estás de acuerdo con alguna parte de estos términos, te pedimos que no utilices nuestros servicios.
            </p><br />

            <h5 class="fw-bold">2. Información del Usuario</h5>
            <p class="h5">
              Al registrarte, proporcionas información precisa y completa sobre ti mismo según lo solicitado en el formulario de registro. Es tu responsabilidad mantener esta información actualizada.
            </p><br />

            <h5 class="fw-bold">3. Privacidad y Protección de Datos</h5>
            <p class="h5">
              Entendemos la importancia de tu privacidad. Consulta nuestra Política de Privacidad para obtener información detallada sobre cómo recopilamos, utilizamos y protegemos tu información personal.
            </p><br />

            <h5 class="fw-bold">4. Uso Apropiado</h5>
            <p class="h5">
              Te comprometes a utilizar Open Gates International de manera ética y conforme a todas las leyes y regulaciones aplicables. No puedes utilizar nuestros servicios para actividades ilegales, fraudulentas o inapropiadas.
            </p><br />

            <h5 class="fw-bold">6. Cambios en los Términos y Condiciones</h5>
            <p class="h5">
              Nos reservamos el derecho de modificar estos términos y condiciones en cualquier momento. Los cambios entrarán en vigencia tan pronto como se publiquen en el sitio web. Te recomendamos que revises periódicamente esta sección.
            </p><br />

            <h5 class="fw-bold">7. Terminación de la Cuenta</h5>
            <p class="h5">
              Nos reservamos el derecho de suspender o cerrar tu cuenta en cualquier momento por incumplimiento de estos términos y condiciones.
            </p><br />

            <h5 class="fw-bold">8. Contacto</h5>
            <p class="h5">
              Si tienes alguna pregunta sobre estos términos y condiciones, puedes contactarnos en info@opengatesinternational.com.
            </p><br />
          </div>
        </div>
      </div>
    </main>

    <footer>
      <?php require('./components/footer.html'); ?>
    </footer>

    <script src="./librerias/jquery-3.5.1.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous">
    </script>
    <script src="./librerias/popper.min.js"></script>
    <script src="./librerias/sweetalert2/dist/sweetalert2.js"></script>
    <script src="./librerias/wow/dist/wow.min.js"></script>
    <script src="./js/index.js"></script>

  </body>
</html>