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
      <section class="container mt-8">
        <div class="row justify-content-center">
          <div class="col-lxx-6 col-md-11 col-sm-12 p-4">
            <h2 class="fw-bold text-primary mb-3">Nuestro compromiso</h2>
            <p class="h6 mb-5">
              Operamos de manera eficaz gracias a un proceso de reclutamiento efectivo y una selección profesional de candidatos. Nuestra presencia se extiende a lo largo y ancho del país, asegurando la contratación de empleados con las calificaciones deseadas en diversas industrias. Nos especializamos en personalizar la contratación según las necesidades específicas de nuestros clientes, garantizando que los empleados seleccionados cumplan con requisitos específicos y sean capaces de desempeñar eficientemente las tareas encomendadas.
            </p>
          </div>
        </div>
      </section>

      <section class="container-fluid container-nosotros mt-7">
        <div class="container">
          <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link active mb-3" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                Misión
              </button>
              
              <button class="nav-link mb-3" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                Visión
              </button>
              
              <button class="nav-link mb-3" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                Propósito
              </button>
            </div>

            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-6 col-md-12 col-sm-12 pl-3">
                    <p class="h6">
                      Facilitar el sueño de una carrera internacional para todo tipo de personas, ofreciendo información precisa, asesoramiento legal integral y apoyo continuo en todo el proceso. Trabajamos incansablemente para simplificar los trámites y proporcionar una experiencia transparente y confiable.
                    </p>
                  </div>

                  <div class="col"></div>

                  <div class="col-md-5 d-none-sm">
                    <div class="position-relative">
                      <img src="./media/img/objetivos.png" class="position-absolute img-panel w-100" alt="" />
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                <div class="row">
                  <div class="col-lg-6 col-md-12 col-sm-12 pl-3">
                    <p class="h6">
                      Ser la principal plataforma, compañía en América Central y del Sur que empodere a los usuarios brindándoles acceso a oportunidades laborales en Europa. Nos esforzamos por construir un puente confiable y efectivo entre los talentos de la región y las empresas europeas.
                    </p>
                  </div>

                  <div class="col"></div>

                  <div class="col-md-5 d-none-sm">
                    <div class="position-relative">
                      <img src="./media/img/vision.png" class="position-absolute img-panel w-100" alt="" />
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                <div class="row">
                  <div class="col-md-12 pl-3">
                    <p class="h6">
                      Contribuir al crecimiento profesional y personal a aquellas personas que decidan trabajar con nosotros, eliminando las barreras y brindándoles la oportunidad de desarrollarse en entornos laborales europeos. Nuestro propósito es ser el socio de confianza que guía a los usuarios en cada paso de su viaje hacia nuevas oportunidades.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="container mt-10">
        <h3 class="fw-bold text-primary text-center mb-5">¡Conoce a los expertos que hacen posible nuestro éxito!</h3>

        <!-- Swiper -->
        <div class="swiper mySwiperTeams">
          <div class="swiper-wrapper">
            <div class="swiper-slide swiper-slide-teams">
              <div class="card card-primary">
                <img src="./media/img/Diego_Hernandez.png" class="object-fit-cover mx-auto my-3" height="250" width="250" alt="..." />

                <div class="card-body p-5">
                  <h4 class="card-title text-center">Diego Hernandez</h4>
                  <p class="card-text text-center"><strong>Representante</strong></p><br>

                  <p class="card-text">
                    Soy Diego Hernández, orgulloso propietario de esta página, y mi misión es asegurarme de que cada cliente experimente una transición suave y exitosa hacia una calidad de vida mejor en Polonia. Como responsable de gestionar todos los aspectos relacionados con contratos y servicios, mi objetivo principal es brindar a nuestros clientes una experiencia inigualable. Mi compromiso con cada individuo que confía en nosotros va más allá de lo comercial. Me apasiona ayudar a las personas a encontrar una nueva vida y oportunidades en Polonia que quizás no pudieron obtener en su país de origen.
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide swiper-slide-teams">
              <div class="card card-primary">
                <img src="./media/img/man.jpg" class="card-img-top object-fit-cover" height="350" alt="...">
                <div class="card-body p-5">
                  <h4 class="card-title text-center">Jose Palma</h4>
                  <p class="card-text text-center"><strong>Talento Humano</strong></p><br>

                  <p class="card-text mb-4">
                    Soy Jose Palma, un apasionado profesional con una sólida trayectoria en el ámbito de Recursos Humanos, Mi enfoque se basa en la creencia de que cada individuo tiene un potencial único, y mi misión es descubrir y maximizar esas habilidades. Garantizando un abanico de oportunidades laborales que abarquen distintos sectores, Con un enfoque proactivo y una visión centrada en las personas, estoy comprometido a crear un impacto positivo en la vida profesional de aquellos que confían en mi experiencia.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
        </div>
      </section>

      <section class="container mt-8">
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
            <h3 class="fw-bold text-primary mt-5">Nuestros objetivos</h3>
            <p class="h6 mt-5">
              Proporcionar información detallada y actualizada sobre oportunidades laborales en Europa, incluidos requisitos, perfiles demandados y pasos a seguir, garantizando que esté siempre al alcance de ustedes.
            </p>
            
            <p class="h6 mt-3">
              Garantizar la transparencia en cada etapa del proceso, desde la aplicación hasta la colocación laboral, brindando a ustedes la seguridad de que están tomando decisiones informadas.
            </p>

            <button
              aria-controls="registro"
              class="btn btn-primary mt-5"
              type="button"
            >
              ¡Registrate ahora!
            </button>
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
    <script src="./js/index.js?v=<?php echo rand(1, 1000); ?>"></script>
  </body>
</html>