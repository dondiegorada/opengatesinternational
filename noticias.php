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
        <div class="row">
          <div class="col-xxl-9 col-lg-8 mb-4">
            <div class="card">
              <h5 class="card-header card-header-primary">¿La tarjeta de residencia permanente tiene un período de validez?</h5>
              
              <div class="card-body">
                <p class="card-text">
                  Vale la pena saber que el permiso de residencia permanente es indefinido, pero la tarjeta de residencia en sí tiene una validez de 10 años. Pasado este tiempo, el extranjero está obligado a obtener un nuevo documento basándose en el procedimiento de reposición de tarjeta. Deberá presentar una solicitud adecuada con al menos 30 días de antelación sin tener que volver a realizar el trámite para la obtención del permiso de residencia permanente.
                </p>

                <p class="card-text"><small class="text-muted">Enero 22, 7:16 am</small></p>
              </div>
            </div>

            <div class="container mt-5" id="new"></div>
          </div>

          <div class="col-xxl-3 col-lg-4">
            <div class="row">
              <div class="col-sm-12 mb-4">
                <div class="card">
                  <h5 class="card-header card-header-primary">Tarjeta de residencia temporal: ¿cómo conseguirla?</h5>
                  
                  <div class="card-body">
                    <p class="card-text">
                      Una tarjeta de residencia no es más que un permiso de residencia temporal y trabajo. Este documento es un permiso uniforme que le da derecho a trabajar y residir legalmente en Polonia sin necesidad de visa. Esta solución está dedicada a los extranjeros que desean permanecer en Polonia por más de 3 meses. Es uno de los tres documentos que legalizan el trabajo y la estancia de los extranjeros en nuestro país; además de ellos, también se puede encontrar la tarjeta de residente y la tarjeta de residencia permanente.
                    </p>

                    <p class="card-text"><small class="text-muted">Enero 15, 5:16 pm</small></p>
                  </div>
                </div>
              </div>

              <div class="col-sm-12">
                <div class="card">
                  <h5 class="card-header card-header-primary">Tarjeta de residencia permanente y tarjeta de residencia temporal: ¿de qué se trata exactamente?</h5>
                  
                  <div class="card-body">
                    <p class="card-text">
                      Los extranjeros que decidan vivir y trabajar en Polonia deberán contar con los documentos necesarios para hacerlo de forma legal y legal. Uno de los que no hay que olvidar es el permiso de residencia temporal y luego (si se cumplen las condiciones) el permiso de residencia permanente. Te explicamos en qué se diferencian entre sí, cuál es el período de validez de estos documentos y qué ha cambiado en la Ley de Extranjería a principios de 2022.
                    </p>

                    <p class="card-text"><small class="text-muted">Enero 10, 10:02 am</small></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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