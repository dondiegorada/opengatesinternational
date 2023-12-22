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
    <header>
      <?php require('./components/navbar.html'); ?>
    </header>

    <main>
      <section class="container mt-6">
        <div class="row justify-content-center">
          <div class="col-lxx-6 col-lg-10 col-sm-12 text-center">
            <p class="h5 mb-5 p-2">
              Mantente al día con las últimas novedades en oportunidades laborales en Europa. Aquí, te ofrecemos noticias actualizadas regularmente sobre cambios en políticas de visados, tendencias laborales, historias de éxito y eventos relacionados con la búsqueda de empleo en el continente europeo.
            </p>
          </div>
        </div>
      </section>

      <section class="container-fluid container-nosotros mt-6">
        <div class="container" id="new"></div>
      </section>

      <section class="container-fluid mt-9">
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner carousel-inner-news" id="news"></div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </section>
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
    <script src="./js/newsView.js?v=<?php echo rand(1, 1000); ?>"></script>
  </body>
</html>