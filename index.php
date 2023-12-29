<?php
  require("./class/db.class.php");
  require("./class/cargaImagenesDAO.php");

  $cargaImagenes = new cargaImagenesDAO();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Opening Gates International</title>
    <meta name="description" content="Trabajo en el exterior, tramita tu visa de trabajo, asesoría personalizada" />
    <meta name="keywords" content="Trabajo, Visa, Europa" />
    <?php require('./components/head.html'); ?>
    <link rel="stylesheet" href="./styles/styles.css?v=<?php echo rand(1, 1000); ?>" />
  </head>

  <body>
    <main>
      <div class="container-home">
        <header>
          <?php require('./components/navbar.html'); ?>
        </header>

        <section class="container mt-5">
          <div class="row justify-content-center">
            <div class="col-lxx-6 col-lg-10 col-sm-12 text-center" style="position: relative; z-index: 1;">
              <h2>Bienvenido a Opening Gates International</h2>
              <p class="h5 mb-5">
                Tu guía confiable para encontrar empleo en Europa desde Centro y Sur América. Nos especializamos en brindar información precisa y útil sobre los procedimientos de visado y empleo en diversos países europeos.
              </p>
              
              <a
                aria-controls="registro"
                class="btn btn-lg btn-primary"
                href="./register.php"
                type="button"
              >
                ¡Registrate ahora!
              </a>
            </div>
          </div>
        </section>
      </div>

      <section class="container" style="margin-top: -60px">
        <div class="row">
          <div class="col-lg-3 col-sm-6 mb-sm-1">
            <div class="card">
              <div class="card-body d-flex align-items-center p-4">
                <img src="./media/img/pasaporte.png" alt="" />
                <p class="card-text ml-1">Explora europa con toda confianza</p>
              </div>
            </div>
          </div>
        
          <div class="col-lg-3 col-sm-6 mb-sm-1">
            <div class="card">
              <div class="card-body d-flex align-items-center p-4">
                <img src="./media/img/viajar.png" alt="" />
                <p class="card-text ml-1">Empieza tu viaje laboral con nosotros</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6 mb-sm-1">
            <div class="card">
              <div class="card-body d-flex align-items-center p-4">
                <img src="./media/img/destino.png" alt="" />
                <p class="card-text ml-1">Encuentra ciudades y países</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6 mb-sm-1">
            <div class="card">
              <a class="icon-link icon-link-hover" href="./register.php">
                <div class="card-body d-flex align-items-center p-4">
                  <img src="./media/img/viajes-de-negocios.png" alt="" />
                  <p class="card-text text-primary ml-1">
                    <em>"Confía en Tu Futuro, Regístrate"</em>
                  </p>
                </div>
                <svg class="bi" aria-hidden="true"><use xlink:href="#arrow-right"></use></svg>
              </a>
            </div>
          </div>
        </div>
      </section>

      <section class="container">
        <!-- Swiper -->
        <div class="swiper mySwiper">
          <div class="swiper-wrapper" id="news-cards"></div>
          <div class="swiper-pagination"></div>
        </div>
      </section>

      <section class="container mt-9">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="text-primary">
              ¿Quieres conocer los requisitos y las oportunidades que te ofrece europa?
            </h2>
            <p class="h5 mt-4">
              Si quieres trabajar en Europa, debes saber que existen diferentes tipos de visa que te permiten ingresar y permanecer en el continente europeo por un período determinado. El tipo de visa que debes solicitar depende de varios factores, como tu nacionalidad, tu profesión, la duración y el propósito de tu estancia, el país al que quieres ir, etc.
            </p>
          </div>
        </div>
      </section>

      <section class="container-fluid container-form mt-9">
        <div class="container">
          <div class="row pt-13">
            <div class="col-md-5 mb-5">
              <h3 class="fw-bold">¿Estás buscando una forma confiable y segura de obtener tu visa y tu empleo?</h3>

              <p class="h5 mt-4">
                registrate y deja tus datos de contacto, podrás acceder a un servicio personalizado y gratuito que te ayudará a encontrar el trabajo y la visa que mejor se adapten a tu perfil y a tus expectativas.
              </p>
            </div>

            <div class="col"></div>

            <div class="col-md-6">
              <h2 class="fw-bold text-center-sm">¡Registrate ahora!</h2>
            
              <form id="form" class="p-2">
                <div class="row">
                  <div class="col-md-12 mb-4">
                    <label for="inputPassword5" class="form-label">Nombres y Apellidos</label>
                    <input type="text" id="name" class="form-control" aria-describedby="passwordHelpBlock" required />
                  </div>

                  <div class="col-md-6 mb-4">
                    <label for="inputPassword5" class="form-label">Telefóno</label>
                    <input type="number" id="phone" class="form-control" aria-describedby="passwordHelpBlock" required>
                  </div>
                  
                  <div class="col-md-6 mb-4">
                    <label for="inputPassword5" class="form-label">Edad</label>
                    <select class="form-select" id="edad" aria-label="Floating label seleccione edad" required> <?php
                      $year = array(18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39); ?>

                      <option selected>Seleccione</option> <?php
                      
                      foreach ($year as $value) { ?>
                        <option value="<?php echo $value; ?>"><?php echo $value; ?></option> <?php
                      } ?>
                      
                      <option value="40">40+</option>
                    </select>
                  </div>

                  <div class="col-md-12 mb-4">
                    <label for="inputPassword5" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" aria-describedby="passwordHelpBlock" required />
                  </div>

                  <!-- <div class="col-md-12 mb-4">
                    <label for="formFileSm" class="form-label">Hoja de vida</label>
                    <input class="form-control form-control" id="formFileSm" type="file">
                  </div> -->

                  <div class="col-md-12 mb-4">
                    <div class="mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Testimonios</label>
                      <textarea class="form-control" id="testimonio" rows="3"></textarea>
                    </div>
                  </div>
                
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
        </div>
      </section>

      <section class="container">
        <div class="row">
          <div class="col-12 text-center">
            <h2 class="fw-bold text-primary">Países y ciudades más recomendados para trabajar en Europa</h2>
            <p class="h5 mt-4">
              Europa es un continente muy diverso y atractivo para trabajar, ya que ofrece una gran variedad de culturas, idiomas, paisajes, climas y oportunidades laborales. Sin embargo, no todos los países y las ciudades son iguales, y algunos pueden ofrecer mejores condiciones y ventajas que otros, dependiendo de tu perfil, tus preferencias y tus expectativas.
            </p>
          </div>
        </div>
      </section>

      <section class="container mt-13">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <img src="./media/img/polonia.jpg" class="w-100 object-fit-cover img-rounded" alt="Polonia">
          </div>

          <div class="col-xxl-6 col-md-7 position-relative-lg">
            <img src="./media/img/travelers-ilustration.png" class="card-ilustration position-absolute d-none-sm" alt="">
            <div class="card-text-right p-7">
              <h3 class="fw-bold">Polonia</h3>
              <p class="h6">
                Polonia ha experimentado un sólido crecimiento económico en las últimas décadas, incluso durante períodos de recesión en Europa. Este crecimiento ha generado oportunidades laborales en varios sectores.
              </p>
            </div>
          </div>
        </div>

        <div class="row justify-content-center mt-25">
          <div class="col-xxl-6 col-md-7 position-relative">
            <img src="./media/img/travel-ilustration.png" class="card-ilustration position-absolute d-none-sm" alt="" />
            <div class="card-text-left p-7">
              <h3 class="fw-bold">Alemania</h3>
              <p class="h6">
                Alemania es la mayor economía de Europa y una de las más potentes del mundo, lo que la convierte en un destino muy atractivo para trabajar. Además, es un país con una rica historia, una cultura diversa y una naturaleza impresionante.
              </p>
            </div>
          </div>

          <div class="col-md-5">
            <img src="./media/img/alemania.jpg" class="w-100 object-fit-cover img-rounded" alt="Alemania">
          </div>
        </div>

        <div class="row justify-content-center mt-25">
          <div class="col-md-5">
            <img src="./media/img/espana.jpg" height="450" class="w-100 object-fit-cover img-rounded" alt="España">
          </div>

          <div class="col-xxl-6 col-md-7 position-relative">
            <img src="./media/img/collaborating-ilustration.png" class="card-ilustration position-absolute d-none-sm" alt="">
            <div class="card-text-right p-7">
              <h3 class="fw-bold">España</h3>
              <p class="h6">
                España tiene una economía diversificada que abarca diversos sectores, como el turismo, la agricultura, la industria manufacturera, la tecnología y los servicios. Esto significa que hay oportunidades laborales en una variedad de campos.
              </p>
            </div>
          </div>
        </div>
      </section>

      <section class="container mt-25">
        <div class="row">
          <div class="col-12">
            <h2 class="text-primary fw-bold text-center">¡información importante!</h2>
          </div>

          <div class="col-md-6">
            <div class="d-flex align-items-center mt-5">
              <span class="badge rounded-pill text-bg-secondary">01</span>
              <p class="h5 fw-bold ml-1 mt-2">Guía de Visas</p>
            </div>

            <p class="h6 mt-3">
              Explora nuestras detalladas guías sobre los diferentes tipos de visas y requisitos para trabajar en países europeos. Desde la solicitud hasta la obtención, te proporcionamos la información esencial para hacer tu experiencia sin complicaciones.
            </p>

            <div class="d-flex align-items-center mt-5">
              <span class="badge rounded-pill text-bg-secondary">02</span>
              <p class="h5 fw-bold ml-1 mt-2">Cómo Funciona</p>
            </div>

            <p class="h6 mt-3">
              Explora nuestro proceso paso a paso, desde la búsqueda de empleo hasta la obtención del visado. Te guiaremos a través de cada etapa, brindándote la información necesaria para tomar decisiones informadas y seguras.
            </p>

            <div class="d-flex align-items-center mt-5">
              <span class="badge rounded-pill text-bg-secondary">03</span>
              <p class="h5 fw-bold ml-1 mt-2">Experiencias Exitosas</p>
            </div>

            <p class="h6 mt-3">
              Descubre historias inspiradoras de personas que han logrado encontrar empleo en Europa a través de nuestra orientación y recursos. Sus experiencias te motivarán a dar el siguiente paso en tu carrera.
            </p>

            <a
              aria-controls="registro"
              class="btn btn-outline-primary mt-5"
              href="./register.php"
              type="button"
            >
              Saber más ...
            </a>
          </div>

          <div class="col-md-6 d-none-sm">
            <div class="position-relative">
              <img
                alt=""
                class="allipse-317"
                src="./media/img/ellipse-317.png"
              />
              
              <img
                alt=""
                class="allipse-318"
                src="./media/img/ellipse-318.png"
              />
            </div>
          </div>
        </div>
      </section>

      <section class="container-fluid p-0 mt-16">
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner"> <?php
            // $images = $cargaImagenes -> getImages(1);

            if ( isset($images) ) {
              $i = 0;
              while ($row = mysqli_fetch_assoc( $images )) {
                $i == 0 ? $active = "active" : $active = ""; ?>
                  <div class="carousel-item <?php echo $active; ?>">
                    <img class="d-block object-fit-cover w-100" src="http://<?php echo $row['imagen']; ?>" alt="<?php echo $row['alt']; ?>" />
                  </div> <?php 
                $i++;
              }
            
            } else { ?>
              <div class="carousel-item active">
                <img class="d-block object-fit-cover w-100" src="./media/img/electrician.jpg" alt="imagen predeterminada" />
              </div> 
              
              <div class="carousel-item">
                <img class="d-block object-fit-cover w-100" src="./media/img/welder.jpg" alt="imagen predeterminada" />
              </div> <?php
            } ?>
          </div>
          
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

      <section class="container mt-16">
        <div class="row justify-content-center">
          <div class="col-md-5">
            <div class="position-relative h-sm-30">
              <img
                alt=""
                class="position-absolute w-100"
                src="./media/img/ellipse-1.png"
                style="left: 30px;"
              />
              <img
                alt=""
                class="position-absolute w-100"
                src="./media/img/ellipse-2.png"
                style="top: 30px;"
              />
              <img
                alt=""
                class="position-absolute w-100"
                src="./media/img/airport.png"
                style="left: 80px; top: 60px;"
              />
            </div>
          </div>

          <div class="col"></div>

          <div class="col-md-5 p-4">
            <h3 class="fw-bold text-primary mt-5"><em>"Descubre Tu Futuro Laboral en Europa con Opening Gates International"</em></h3>
            <p class="h6 mt-5">
              Entendemos la importancia de brindarte seguridad y tranquilidad en tu búsqueda laboral en Europa. Nuestra dedicación es garantizar que cada paso de tu viaje esté respaldado por información precisa, asistencia experta y recursos confiables.
            </p>
            
            <p class="h6">
              Nos comprometemos a ser tu socio de confianza en cada fase de tu proceso de solicitud y búsqueda de empleo en Europa.
            </p>

            <a
              aria-controls="registro"
              class="btn btn btn-primary mt-5"
              href="./register.php"
              type="button"
            >
              ¡Registrate ahora!
            </a>
          </div>
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
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="./js/webcam.js?v=<?php echo rand(1, 1000); ?>"></script>
    <script src="./js/index.js"></script>
  </body>
</html>