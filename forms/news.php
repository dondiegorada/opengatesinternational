<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../media/imagenes/logo.png">
    <title>Noticias</title>
    <link rel="stylesheet" href="../framework/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../librerias/animate.css/animate.min.css">
    <link rel="stylesheet" href="../librerias/sweetalert2/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/cargaImgs.css">
  </head>

  <body>
    <header class="header">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#F1EDE9" fill-opacity="1" d="M0,64L80,96C160,128,320,192,480,186.7C640,181,800,107,960,74.7C1120,43,1280,53,1360,58.7L1440,64L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
        </path>
      </svg>
      <div class="back">
        <a type="button" href="../list/panel.php"> 
          <img src="../media/img/back.svg" alt="regresar" height="40">
        </a>
      </div>
      <div class="titulo">
        <h2>Noticias</h2>
      </div>
    </header>

    <main>
      <section class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#labels" type="button" role="tab" aria-controls="labels" aria-selected="true">Etiquetas</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="false">Noticias</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#create" type="button" role="tab" aria-controls="create" aria-selected="false">Crear noticia</button>
          </li>
          <li class="nav-item" role="presentation" id="nav-update" style="display: none;">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Actualizar noticia</a>
          </li>
        </ul>
        <br>

        <div class="col-md-12">
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="labels" role="tabpanel" aria-labelledby="profile-tab">
              <h3>Caracteres y etiquetas de contenido</h3>
              <p>Las etiquetas de contenido son las que agrupan el contenido que hay en su interior.</p>

              <table class="table table-sm table-striped table-bordered text-center">
                <thead>
                  <tr>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Descripción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>*</td>
                    <td>Define una comilla simple.</td>
                  </tr>
                  <tr>
                    <th>(p) - (/p)</th>
                    <td>Define un párrafo.</td>
                  </tr>
                  <tr>
                    <th>(b) - (/b)</th>
                    <td>Representa el texto marcado con un estilo en negrita.</td>
                  </tr>
                  <tr>
                    <th>(i) - (/i)</th>
                    <td>Muestra el texto marcado con un estilo en cursiva o itálica.</td>
                  </tr>
                  <tr>
                    <th>(u) - (/u)</th>
                    <td>Muestra el texto subrayado.</td>
                  </tr>
                  <tr>
                    <th>(br)</th>
                    <td>Inserta un salto de línea.</td>
                  </tr>
                  <tr>
                    <th>(a href=*Direct Link*) - (/a)</th>
                    <td>Representa un hiperenlace.</td>
                  </tr>
                </tbody>
              </table>
            </div>
      
            <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="home-tab">
              <div class="col-md-12 table-responsive-sm">
                <table id="table" class="table table-sm table-striped table-bordered text-center">
                  <thead>
                    <tr>
                      <th></th>
                      <th scope="col">ID</th>
                      <th scope="col">Imagen</th>
                      <th scope="col">Titulo</th>
                      <th scope="col">Titular</th>
                      <th scope="col">Contenido</th>
                      <th scope="col">Estado</th>
                    </tr>
                  </thead>
                  <tbody id="tbody"></tbody>
                </table>
              </div>
            </div>

            <div class="tab-pane fade" id="create" role="tabpanel" aria-labelledby="profile-tab">
              <form id="form" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="mb-3">
                          <label for="file" class="form-label">File <span style="color: red;">*</span></label>
                          <input class="form-control" type="file" name="file" id="file" onChange="imgPrevius('img-create', this)" required />
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating mt-3">
                          <select class="form-select" name="status" id="status" aria-label="Floating label select example" required>
                            <option selected>Seleccione...</option>
                            <option value="A">Activo</option>
                            <option value="I">Inactivo</option>
                          </select>
                          <label for="floatingStatus">Estado <span style="color: red;">*</span></label>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="title" id="title" onkeyup="titleText('title', 'text_title')" required />
                          <label for="floatingTitle">Titulo de la noticia <span style="color: red;">*</span></label>
                        </div>

                        <div class="form-floating mb-3">
                          <textarea class="form-control" name="headline" id="headline" style="height: 100px" onkeyup="headlineText('headline', 'text_headline')" require ></textarea>
                          <label for="floatingHeadline">Titular de la noticia <span style="color: red;">*</span></label>
                        </div>

                        <div class="mb-3">
                          <label for="file_content" class="form-label">Imagen de contenido <span style="color: red;">*</span></label>
                          <input class="form-control" type="file" name="file_content" id="file_content" required />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card-deck">
                      <div class="card" style="background-color: #222121; border: 0 solid; color: #FFFFFF;">
                        <img src="https://cdn.pixabay.com/photo/2017/09/10/18/25/question-2736480_960_720.jpg" id="img-create" class="card-img-top" height="160" style="object-fit: cover;">
                        <div class="card-body">
                          <h5 class="card-title" id="text_title" style="color: #FFFFFF;">Title of the news</h5>
                          <p class="card-text" id="text_headline">Here*s a longer description with supporting text below as a natural introduction to the additional content.
                            
                          <a href="#" class="text-danger">See more...</a>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Last updated 3 seconds ago.</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <textarea class="form-control" name="content" id="content" style="height: 200px" require ></textarea>
                      <label for="floatingContents">Contenido de la noticia <span style="color: red;">*</span></label>
                      <small class="text-danger" id="valida-demo"></small>
                    </div>

                    <input type="submit" class="btn btn-danger" value="Crear noticia">
                    <button type="button" class="btn btn-secondary" onclick="showContent(false)"><i class="fa fa-eye" aria-hidden="true"></i> Demo</button>
                    <br><br>
                  </div>
                </div>
              </form>
            </div>

            <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="profile-tab">
              <form id="form-update" method="POST" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">

                      <div class="col-md-8">
                        <div class="mb-3">
                          <label for="file" class="form-label">File <span style="color: red;">*</span></label>
                          <input class="form-control" type="file" name="file-update" id="file-update" onChange="imgPrevius('img-update', this)" />
                          <input type="hidden" name="fileD" id="fileD" />
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating mt-3">
                          <select class="form-select" name="status-update" id="status-update" aria-label="Floating label select example" required>
                            <option selected>Seleccione...</option>
                            <option value="A">Activo</option>
                            <option value="I">Inactivo</option>
                          </select>
                          <label for="floatingStatus">Estado <span style="color: red;">*</span></label>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="title-update" id="title-update" onkeyup="titleText('title-update', 'text_title-update')" required />
                          <label for="floatingTitle">Titulo de la noticia <span style="color: red;">*</span></label>
                        </div>

                        <div class="form-floating mb-3">
                          <textarea class="form-control" name="headline-update" id="headline-update" style="height: 100px" onkeyup="headlineText('headline-update', 'text_headline-update')" require ></textarea>
                          <label for="floatingHeadline">Titular de la noticia <span style="color: red;">*</span></label>
                        </div>

                        <div class="mb-3">
                          <label for="file_content" class="form-label">Imagen de contenido <span style="color: red;">*</span></label>
                          <input class="form-control" type="file" name="file_content-update" id="file_content-update" />
                          <input type="hidden" name="file_contentD" id="file_contentD" />
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card-deck">
                      <div class="card" style="background-color: #222121; border: 0 solid; color: #FFFFFF;">
                        <img id="img-update" class="card-img-top" height="160" style="object-fit: cover;">
                        <div class="card-body">
                          <h5 class="card-title" id="text_title-update" style="color: #FFFFFF;">Title of the news</h5>
                          <p class="card-text" id="text_headline-update">Here*s a longer description with supporting text below as a natural introduction to the additional content.</p>
                          <a href="#" class="text-danger">See more...</a>
                        </div>
                        <div class="card-footer">
                          <small class="text-muted">Last updated 3 seconds ago.</small>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <textarea class="form-control" name="content-update" id="content-update" style="height: 200px" require ></textarea>
                      <label for="floatingContents">Contenido de la noticia <span style="color: red;">*</span></label>
                    </div>

                    <input type="hidden" name="id" id="id" required />
                    <input type="submit" class="btn btn-danger" value="Actualizar noticia">
                    <button class="btn btn-secondary" onclick="hideFormUpdate()">Cancelar</button>
                    <br><br>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </section>
    </main>

    <!-- Modal content -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content p-4" style="background-color: #222121;">
          <i class="fa fa-times-circle text-danger close-modal fa-2x" onclick="$('.bd-example-modal-lg').modal('hide')" aria-hidden="true"></i>
          
          <div class="card" style="background-color: #222121; border: 0 solid; color: #FFFFFF;">
            <img class="card-img-top" id="img-content" height="300" style="object-fit: cover;" alt="Card image cap">
            <div class="card-body card-content">
              <h3 class="card-title text-warning text-center" style="font-weight: bolder;">Card title</h3>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            </div>
          </div>

        </div>
      </div>
    </div>

    <script src="../librerias/jquery-3.5.1.min.js"></script>
    <script src="../framework/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../librerias/sweetalert2/dist/sweetalert2.js"></script>
    <script src="../js/alerts.js?<?php echo rand(); ?>"></script>
    <script src="../js/news.js?<?php echo rand(); ?>"></script>
  </body>
</html>