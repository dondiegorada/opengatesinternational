<?php
  class newsDAO extends db {
    function __construct() {
      parent::__construct();
    }

    public function getMaxId($Table ,$Column) {
      $increment = 1;
	    $select = "SELECT MAX($Column) AS max_consecutive FROM $Table";
      $Max = $this -> query($select);
	  
      if (mysqli_num_rows($Max) > 0) {
        if ($row = mysqli_fetch_assoc($Max)) {
          $max_consecutive =  $row['max_consecutive'];
        }

      } else {
        $max_consecutive = 0;
      }

      return $max_consecutive += $increment;  
    }

    public function getImage(Int $id, String $column) {
      $sql = "SELECT $column FROM news WHERE id = $id";
      $result = $this -> query($sql);

      if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)[$column];
      }
    }

    // Funcion que obtiene todas las noticias
    public function getNews() {
      date_default_timezone_set('America/Bogota');
      $time = date("Y-m-d H:i:s");

      $sql = "SELECT *, IF(status = 'A', 'Activo', 'Inactivo') AS status, TIMESTAMPDIFF(SECOND, createdAt, '$time') AS time FROM news ORDER BY id DESC";
      $result = $this -> query($sql);

      $data = array();
      if (mysqli_num_rows($result) > 0) {
        for ($i = 0; $row = mysqli_fetch_assoc($result); $i++) {
          $data[$i]['id'] = $row['id'];
          $data[$i]['file'] = $row['file'];
          $data[$i]['title'] = $row['title'];
          $data[$i]['headline'] = $row['headline'];
          $data[$i]['content'] = $row['content'];
          $data[$i]['file_content'] = $row['file_content'];
          $data[$i]['status'] = $row['status'];
          $data[$i]['time'] = $this -> timeCreate($row['time']);
        }
      }

      return [
        'success' => true,
        'data' => $data
      ];
    }

    // Funcion para obtener noticia segun ID
    public function getNew($id, $admin) {

      $select = "SELECT id, file, title, headline, file_content, content, status, createdAt FROM news WHERE id = $id";
      $result = $this -> query($select);

      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($admin) { // Validamos si obtenemos desde administracion
          $html = false;

          $row['title'] = $this -> changeLabels($row['title'], $html);
          $row['headline'] = $this -> changeLabels($row['headline'], $html);
          $row['content'] = $this -> changeLabels($row['content'], $html);

        } else {
          $row['createdAt'] = date("F j/Y", strtotime($row['createdAt']));
        }

        return [
          'success' => true,
          'data' => $row
        ];

      } else {
        return [
          'success' => false
        ];
      }
    }

    // Funcion para guardar noticias
    public function setNews($file, $title, $headline, $content, $file_content, $status) {
      date_default_timezone_set('America/Bogota');

      $id = $this -> getMaxId('news', 'id');
      $createdAt = date('Y-m-d H:i:s');

      $sql = "INSERT INTO news (id, file, title, headline, content, file_content, status, createdAt)
              VALUES ($id, '$file', $title, $headline, $content, '$file_content', '$status', '$createdAt')";

      $result = $this -> query($sql);

      if ($result) {
        return [
          'success' => true,
          'msg' => 'La noticia se creo con exito',
        ];

      } else {
        throw new Exception("No se pudo crear la noticia, el motivo: ".$this -> error);
      }
    }

    // Funcion para actualizar noticias
    public function updateNews($id, $file, $title, $headline, $content, $file_content, $status) {
      date_default_timezone_set('America/Bogota');

      if (!$file) { $file = ''; } else { $file = "file = '$file',"; }
      if (!$file_content) { $file_content = ''; } else { $file_content = "file_content = '$file_content',"; }
      $updatedAt = date("Y-m-d H:i:s");

      $insert = "UPDATE news SET $file title = $title, headline = $headline, $file_content content = $content, status = '$status', updatedAt = '$updatedAt' WHERE id = $id";
      $result = $this -> query($insert);

      if ($result) {
        return [
          'success' => true,
          'msg' => 'La noticia se actualizo correctamente.'
        ];
      
      } else {
        return [
          'success' => false,
          'msg' => 'Error al actualizar noticia!... Comunicate con el departamento de desarrollo e informa del problema'
        ];
      }
    }

    // Funcion para eliminar noticia
    public function deleteNews($id) {
      $sql = "DELETE FROM news WHERE id = $id";
      $result = $this -> query($sql);

      if ($result) {
        return [
          'success' => true,
          'msg' => 'La noticia se elimino con exito.'
        ];

      } else {
        throw new Exception("No se pudo eliminar la noticia, el motivo: ".$this -> error);
      }
    }

    public function timeCreate($tiempo_en_segundos) {
      $dias = floor($tiempo_en_segundos / (3600 * 24));
      $horas = floor($tiempo_en_segundos / 3600);
      $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
      $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

      if ($dias >= 1) {
        return 'Last updated '.$dias.' days ago.';
      }

      if ($horas >= 1) {
        return 'Last updated '.$horas.' hours ago.';
      }

      if ($minutos >= 1) {
        return 'Last updated '.$minutos.' minutes ago.';
      }

      if ($segundos >= 1) {
        return 'Last updated '.$segundos.' seconds ago.';
      }
    }

    public function changeLabels($content, $html) {
      // Limpiamos para guardar en la bd
      if ($html) {

        // Agregamos etiqueta <p></p>
        $content = str_replace("(p)", "<p>", $content);
        $content = str_replace("(/p)", "</p>", $content);

        // Agregamos etiqueta <b></b>
        $content = str_replace("(b)", "<b>", $content);
        $content = str_replace("(/b)", "</b>", $content);

        // Agregamos etiqueta <i></i>
        $content = str_replace("(i)", "<i>", $content);
        $content = str_replace("(/i)", "</i>", $content);

        // Agregamos etiqueta <u></u>
        $content = str_replace("(u)", "<u>", $content);
        $content = str_replace("(/u)", "</u>", $content);

        // Agregamos etiqueta <br></br>
        $content = str_replace("(br)", "<br>", $content);

        // Agregamos etiqueta <a></a>
        $content = str_replace("(a href=*", "<a href='", $content);
        $content = str_replace("*)", "'>", $content);
        $content = str_replace("(/a)", "</a>", $content);

        // Agregamos comilla sencilla
        $content = str_replace("*", "'", $content);

      // Limpiamos para mostrar al actualizar
      } else {

        // Agregamos etiqueta (p)(/p)
        $content = str_replace("<p>", "(p)", $content);
        $content = str_replace("</p>", "(/p)", $content);

        // Agregamos etiqueta (b)(/b)
        $content = str_replace("<b>", "(b)", $content);
        $content = str_replace("</b>", "(/b)", $content);

        // Agregamos etiqueta (i)(/i)
        $content = str_replace("<i>", "(i)", $content);
        $content = str_replace("</i>", "(/i)", $content);

        // Agregamos etiqueta (u)(/u)
        $content = str_replace("<u>", "(u)", $content);
        $content = str_replace("</u>", "(/u)", $content);

        // Agregamos etiqueta (br)(/br)
        $content = str_replace("<br>", "(br)", $content);

        // Agregamos etiqueta (a)(/a)
        $content = str_replace("<a href='", "(a href=*", $content);
        $content = str_replace("'>", "*)", $content);
        $content = str_replace("</a>", "(/a)", $content);

        // Agregamos comilla sencilla
        $content = str_replace("'", "*", $content);
      }

      return $content;
    }

  }
?>