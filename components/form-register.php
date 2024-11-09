<div class="row content-form">
  <div class="col-md-5 mb-5">
    <h4 class="fw-bold">¿Estás buscando una forma confiable y segura de obtener tu visa y tu empleo?</h4>

    <p class="h6 mt-4">
      registrate y deja tus datos de contacto, podrás acceder a un servicio personalizado y gratuito que te ayudará a encontrar el trabajo y la visa que mejor se adapten a tu perfil y a tus expectativas.
    </p>
  </div>

  <div class="col"></div>

  <div class="col-md-6">
    <h2 class="fw-bold">¡Registrate ahora!</h2>

    <form id="form" method="POST" enctype="multipart/form-data">
      <!-- One "tab" for each step in the form: -->

      <div class="row tab mb-4">
        <div class="mb-3">Nombres</div>

        <div class="col-md-12 mb-3">
          <input class="form-control" id="fname" name="fname" oninput="this.className = 'form-control'" placeholder="First name" type="text" required />
        </div>

        <div class="col-md-12">
          <input class="form-control" id="lname" name="lname" oninput="this.className = 'form-control'" placeholder="Last name" type="text" required />
        </div>
      </div>

      <div class="row tab mb-4">
        <div class="mb-3">Información de residencia</div>

        <div class="col-md-12 mb-3">
          <select class="form-select" id="country" name="country" oninput="this.className = 'form-control'" required>
            <option value="" selected>Selecciona un país...</option>
          </select>
        </div>

        <div class="col-md-12 mb-3">
          <select class="form-select" id="state" name="state" oninput="this.className = 'form-control'" required>
            <option value="" selected>Selecciona un departamento...</option>
          </select>
        </div>

        <div class="col-md-12">
          <select class="form-select" id="city" name="city" oninput="this.className = 'form-control'" required>
            <option value="" selected>Selecciona una ciudad...</option>
          </select>
        </div>
      </div>

      <div class="row tab mb-4">
        <div class="mb-3">Información de contacto</div>

        <div class="col-md-12 mb-3">
          <input class="form-control" id="phone" name="phone" oninput="this.className = 'form-control'" placeholder="Phone" type="number" required />
        </div>

        <div class="col-md-12 mb-3">
          <input class="form-control" id="email" name="email" oninput="this.className = 'form-control'" placeholder="E-mail" type="email" required />
        </div>

        <div class="col-md-12 mb-3">
          <select class="form-select" id="passport" name="passport" oninput="this.className = 'form-control'" required>
            <option selected>Pasaporte</option>
            <option value="si">Si</option>
            <option value="no">No</option>
          </select>
        </div>

        <div class="col-md-12">
          <select class="form-select" id="year" name="year" oninput="this.className = 'form-control'" required> <?php
            $year = array(18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39); ?>

            <option selected>Edad</option> <?php

            foreach ($year as $value) { ?>
              <option value="<?php echo $value; ?>"><?php echo $value; ?></option> <?php
            } ?>

            <option value="40">40+</option>
          </select>
        </div>
      </div>

      <div class="row tab mb-4">
        <div class="col-md-12">
          <p class="my-2">¿Cual es tu interes principal?</p>
          
          <div class="my-3">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="check_option" id="check_pasaporte" value="Pasaporte">
              <label class="form-check-label" for="check_pasaporte">
                Pasaporte
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="check_option" id="check_viajar_eur" value="Viajar a europa">
              <label class="form-check-label" for="check_viajar_eur">
                Viajar a Europa
              </label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="radio" name="check_option" id="check_visa" value="Visa">
              <label class="form-check-label" for="check_visa">
                Visa
              </label>
            </div>

            <select class="form-select" id="tipo_visa" name="tipo_visa" oninput="this.className = 'form-control'">
              <option value="" selected>Selecciona un tipo de visa...</option>
            </select>

          </div>
        </div>

        <div class="mb-3">Testimonio</div>

        <div class="col-md-12 mb-3">
          <textarea class="form-control" id="testimony" name="testimony" rows="4"></textarea>
        </div>

        <div class="form-check form-switch mb-3" style="padding-left: 3.3em;">
          <input class="form-check-input" type="checkbox" role="switch" id="check-terminos">
          <label class="form-check-label" for="flexSwitchCheckDefault">
            Aceptar <a href="./terminos.php" class="text-primary">terminos y condiciones</a>
          </label>
        </div>
      </div>

      <div id="finish-content" class="row p-3 fw-bold"></div>

      <div id="steps-buttons" style="overflow:auto;">
      <!-- Circles which indicates the steps of the form: -->
        <div style="float: right;">
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
          <span class="step"></span>
        </div>

        <div style="float: left;">
          <button class="btn btn-sm btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
          <button class="btn btn-sm btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
      </div>
    </form>
  </div>
</div>