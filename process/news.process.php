<?php
  require("../class/db.class.php");
  require("../class/newsDAO.php");

  class news {
    function __construct() {
      $funcion = $_REQUEST['FUNCION'];
      if (isset($funcion)) {
        $this -> $funcion();
      }
    }

    private function getNews() {
      try {
        // code...
        $newsDAO = new newsDAO();
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $admin = filter_input(INPUT_GET, 'admin', FILTER_SANITIZE_STRING);

        if (!$id) {
          $response = $newsDAO -> getNews();
        } else {
          $response = $newsDAO -> getNew($id, $admin);
        }

            
        if (isset($response)) {
          echo json_encode($response);
        }
            
      } catch (Exception $ex) {
        echo "Error Processing Request".$ex -> getMessage();
      }
    }

    private function setNews() {
      try {
        // code...
        $newsDAO = new newsDAO();

        $title = '"'.$newsDAO -> changeLabels(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING), true).'"'; // Convertimos a HTML
        $headline = '"'.$newsDAO -> changeLabels(filter_input(INPUT_POST, "headline", FILTER_SANITIZE_STRING), true).'"'; // Convertimos a HTML
        $content = '"'.$newsDAO -> changeLabels(filter_input(INPUT_POST, "content", FILTER_SANITIZE_STRING), true).'"'; // Convertimos a HTML
        $file_content = $_FILES['file_content']['name'];
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

        // Validamos errores en las imagenes
        if ($_FILES['file']['error']) {
          echo json_encode([ 'success' => false, 'msg' => 'Error al cargar la imagen.']); exit();

        } else if ($_FILES['file_content']['error']) {
          echo json_encode([ 'success' => false, 'msg' => 'Error al cargar la imagen del contenido.']); exit();
        }

        // Validamos peso de las imagenes
        $mb = 1048576;
        if ($_FILES['file']['size'] >= $mb * 5) {
          echo json_encode([ 'success' => false, 'msg' => 'El peso de la imagen es muy grande por favor disminuyelo.' ]); exit();

        } else if ($_FILES['file_content']['size'] >= $mb * 5) {
          echo json_encode([ 'success' => false, 'msg' => 'El peso de la imagen del contenido es muy grande por favor disminuyelo.' ]); exit();
        }

        // Validamos el tipo de la imagen
        if ($_FILES['file']['type'] != "image/jpg" && $_FILES['file']['type'] != "image/png" && $_FILES['file']['type'] != "image/gif" && $_FILES['file']['type'] != "image/jpeg" && $_FILES['file']['type'] != "image/webp") {
          echo json_encode([ 'success' => false, 'msg' => 'El tipo de archivo no es permitido. Formatos admitidos (jpg, png, gif, webp, jpeg)' ]); exit();

        } else if ($_FILES['file_content']['type'] != "image/jpg" && $_FILES['file_content']['type'] != "image/png" && $_FILES['file_content']['type'] != "image/gif" && $_FILES['file_content']['type'] != "image/jpeg" && $_FILES['file_content']['type'] != "image/webp") {
          echo json_encode([ 'success' => false, 'msg' => 'El tipo de archivo del contenido no es permitido. Formatos admitidos (jpg, png, gif, webp, jpeg)' ]); exit();
        }

        $arrayNameFile = explode('.', $_FILES['file']['name']);
        $file = $arrayNameFile[0].rand().".".$arrayNameFile[count($arrayNameFile) - 1];

        $arrayNameFileContent = explode('.', $_FILES['file_content']['name']);
        $file_content = $arrayNameFileContent[0].rand().".".$arrayNameFileContent[count($arrayNameFileContent) - 1];

        // Ruta de la carpeta destino en el servidor
        $destinationFile = $_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file; // Carpeta de destino
        $uploadFile = move_uploaded_file($_FILES['file']['tmp_name'], $destinationFile); // Subimos imagen a directorio local

        // Ruta de la carpeta destino en el servidor
        $destinationFileContent = $_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file_content; // Carpeta de destino
        $uploadFileContent = move_uploaded_file($_FILES['file_content']['tmp_name'], $destinationFileContent); // Subimos imagen del contenido a directorio local

        if (!$uploadFile) { // Validamos si se subio la imagen
          echo json_encode([ 'success' => false, 'msg' => 'Ocurrio una inconsistencia subiendo la imagen, por favor intente mas tarde.' ]);

        } else if (!$uploadFileContent) {
          echo json_encode([ 'success' => false, 'msg' => 'Ocurrio una inconsistencia subiendo la imagen del contenido, por favor intente mas tarde.' ]);
        }
        
        $response = $newsDAO -> setNews($file, $title, $headline, $content, $file_content, $status);

        if ($response['success']) {
          echo json_encode($response);
        }
            
      } catch (Exception $ex) {
        echo "Error Processing Request".$ex -> getMessage();
      }
    }

    private function updateNews() {
      try {
        // code...
        $newsDAO = new newsDAO();

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $title = '"'.$newsDAO -> changeLabels(filter_input(INPUT_POST, "title-update", FILTER_SANITIZE_STRING), true).'"'; // Convertimos a HTML
        $headline = '"'.$newsDAO -> changeLabels(filter_input(INPUT_POST, "headline-update", FILTER_SANITIZE_STRING), true).'"'; // Convertimos a HTML
        $content = '"'.$newsDAO -> changeLabels(filter_input(INPUT_POST, "content-update", FILTER_SANITIZE_STRING), true).'"'; // Convertimos a HTML
        $status = filter_input(INPUT_POST, 'status-update', FILTER_SANITIZE_STRING);

        // Validamos si existe imagen para actualizar
        if ($_FILES['file-update']['error']) { $file = null; } else {
          $file = $newsDAO -> getImage($id, 'file');
          unlink($_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file); // Eliminamos imagen a actualizar

          $arrayNameFile = explode('.', $_FILES['file-update']['name']);
          $file = $arrayNameFile[0].rand().".".$arrayNameFile[count($arrayNameFile) - 1];

          // Ruta de la carpeta destino en el servidor
          $destinationFile = $_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file; // Carpeta de destino
          $uploadFile = move_uploaded_file($_FILES['file-update']['tmp_name'], $destinationFile); // Subimos imagen a directorio local
        }

        // Validamos si existe imagen del contenido para actualizar
        if ($_FILES['file_content-update']['error']) { $file_content = null; } else {
          $file_content = $newsDAO -> getImage($id, 'file_content');
          unlink($_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file_content); // Eliminamos imagen a actualizar

          $arrayNameFile = explode('.', $_FILES['file_content-update']['name']);
          $file_content = $arrayNameFile[0].rand().".".$arrayNameFile[count($arrayNameFile) - 1];

          // Ruta de la carpeta destino en el servidor
          $destinationFile = $_SERVER['DOCUMENT_ROOT'].'/media/imagenes/news/'.$file_content; // Carpeta de destino
          $uploadFile = move_uploaded_file($_FILES['file_content-update']['tmp_name'], $destinationFile); // Subimos imagen a directorio local
        }
        
        $response = $newsDAO -> updateNews($id, $file, $title, $headline, $content, $file_content, $status);

        if ($response['success']) {
          echo json_encode($response);
        }
            
      } catch (Exception $ex) {
        echo "Error Processing Request".$ex -> getMessage();
      }
    }

    private function deleteNews() {
      try {
        // code...
        $newsDAO = new newsDAO();
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        $file = filter_input(INPUT_POST, 'file', FILTER_SANITIZE_STRING);
        $file_content = filter_input(INPUT_POST, 'file_content', FILTER_SANITIZE_STRING);

        $response = $newsDAO -> deleteNews($id);
            
        if ($response['success']) {
          unlink($_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file);
          unlink($_SERVER['DOCUMENT_ROOT'].'/media/img/news/'.$file_content);
          echo json_encode($response);
        }
            
      } catch (Exception $ex) {
        echo "Error Processing Request".$ex -> getMessage();
      }
    }

  }

  $news = new news();
?>