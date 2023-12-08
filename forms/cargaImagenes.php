<?php
    session_name("panel");
    session_start();

    if (!$_SESSION["bandera"]) {
      header("Location: ../");
    }

    require("../class/db.class.php");
    require("../class/cargaImagenesDAO.php");

    $cargaImagenes = new cargaImagenesDAO();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de imagenes</title>
    <link rel="icon" type="image/png" href="../media/imagenes/logo.png">
    <link rel="canonical" href="https://lucistudio.com.co">
    <link rel="stylesheet" href="../framework/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../librerias/animate.css/animate.min.css">
    <link rel="stylesheet" href="../librerias/sweetalert2/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Niramit:wght@300&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../styles/cargaImgs.css">
</head>
<body>
<header>
    <div class="header">
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
            <h2>Carga de imagenes</h2>
        </div>
    </div>
</header>
<main>
    <div class="container">
        <section>
        <h3>Carga las imagenes segun la sección</h3>

        <form class="row g-3 p-4 align-items-center" id="formImgs" method="POST" enctype="multipart/form-data">
            
                <div class="col-6  mb-3">
                    <div class="form-floating">
                        <select class="form-select" id="seccion_id" name="seccion_id" aria-label="Floating label seccion" required>
                            <option value="">Seleccione una sección</option>
                            <?php  $secciones = $cargaImagenes->getSecciones();
                                   while($row = mysqli_fetch_assoc($secciones)){ ?>
                                <option value="<?php echo $row['seccion_id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <label for="floatingSelect">Secciones</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="alt" name="alt" placeholder="digita alt de la imagen" required>
                        <label for="floatingInput">Alt imagen</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                    <label for="formFile" class="form-label">Cargar imagen</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" required>
                    </div>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-warning" id="save">Cargar</button>
                </div>
        </form>
        </section>

        <section>

            <div class="accordion p-4" id="accordionPanelsStayOpenExample">
                <?php  $secciones = $cargaImagenes->getSecciones();
                       while($row = mysqli_fetch_assoc($secciones)){ ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-heading<?php echo $row['seccion_id']; ?>">
                                <button class="accordion-button bg-light text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $row['seccion_id']; ?>" aria-expanded="true" aria-controls="panelsStayOpen-collapse<?php echo $row['seccion_id']; ?>">
                                    <?php echo $row['nombre']; ?>
                                </button>
                                </h2>
                                <div id="panelsStayOpen-collapse<?php echo $row['seccion_id']; ?>" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading<?php echo $row['seccion_id']; ?>">
                                <div class="accordion-body">
                                    <?php 
                                       $seccion_id = $row['seccion_id'];
                                       $banners = $cargaImagenes->getBannersPorSeccion($seccion_id);

                                       if(isset($banners)){
                                       
                                       ?>
                                       <div class="table-responsive">
                                       <table  id="table-seccion" class="table table-hover table-striped table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Alt(descripción)</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while($row = mysqli_fetch_assoc($banners)){
                                                    ?>
                                                    <tr>
                                                        <td><a href="https://<?php echo $row['imagen']; ?>" target="_blank"><img src="https://<?php echo $row['imagen']; ?>" height="200" class=""></a></td>
                                                        <td><?php echo $row['alt']; ?></td>
                                                        <td><button type="button" class="btn" onclick="deleteImages(<?php echo $row['banner_seccion_id']?>)"><img src="../media/imagenes/trash-bin.svg" height="50" alt="eliminar imagen"></button></td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                       </table>
                                        </div>
                                       <?php

                                        }else{
                                            ?><h5 class="text-muted">No existen imagenes en esta sección</h5><?php
                                        }
                                       
                                    ?>
                                </div>
                                </div>
                            </div>
                <?php } ?>
                
            </div>
        </section>
    </div>
</main>

<script src="../librerias/jquery-3.5.1.min.js"></script>
<script src="../framework/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../librerias/popper.min.js"></script>
<script src="../librerias/sweetalert2/dist/sweetalert2.js"></script>
<script src="../js/cargaImagenes.js"></script>
    
</body>
</html>