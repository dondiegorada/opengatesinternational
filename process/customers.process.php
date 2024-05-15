<?php
  require("../class/db.class.php");
  require("../class/customersDAO.php");

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require '../librerias/PHPMailer/src/Exception.php';
  require '../librerias/PHPMailer/src/PHPMailer.php';
  require '../librerias/PHPMailer/src/SMTP.php';
  // Requerimos la clase del api

  class customersProcess {
    function __construct() {
      $funcion = $_REQUEST['FUNCION'];
      if (isset($funcion)) {
        $this -> $funcion();
      }
    }

    private function create() {
      try {
        $customersDAO = new customersDAO();
        $mail = new PHPMailer();

        // if ( mime_content_type($_FILES['cv']['tmp_name']) !== 'application/pdf' ) {
        //   exit( json_encode([
        //     "msg" => "El tipo de archivo no es permitido. Formatos admitidos (pdf)",
        //     "exito" => false
        //   ]));
        // }

        // $arrayName = explode( '.', $_FILES['cv']['name'] );
        // $size_array = count( $arrayName );
        // $name_imagen = $arrayName[0].rand().".".$arrayName[$size_array - 1];

        // $url = explode('/', $_SERVER['PHP_SELF']);

        // // ruta de la carpeta destino en el servidor
        // $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/media/img/pdf/'.$name_imagen;
        // $move = move_uploaded_file( $_FILES['cv']['tmp_name'], $carpeta_destino);
        // $ruta = 'opengatesinternational.com/media/img/pdf/'.$name_imagen;
        $ruta = '';
  
        // movemos la imagen del directorio temporal al directorio escogido
        // if ( !$move ) {
        //   exit( echo json_encode([
        //     "msg" => "Inconsistencia guardado la imagen",
        //     "exito" => false
        //   ]));
        // }

        $name = htmlspecialchars( $_REQUEST['name'], ENT_QUOTES );
        $phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
        $email = htmlspecialchars( $_REQUEST['email'], ENT_QUOTES );
        $year = filter_input(INPUT_POST, "year", FILTER_VALIDATE_INT);
        $city = htmlspecialchars( $_REQUEST['city'], ENT_QUOTES );
        
        // Create register
        $response = $customersDAO -> create( $name, $phone, $email, $year, $city );
          
        if ( !$response -> duplicate ) {
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPDebug = 0;
          $mail->Host = 'smtp.hostinger.com';
          $mail->Port = 587;
          $mail->SMTPAuth = true;
          $mail ->CharSet="UTF-8";
          $mail->Username = 'no-reply@oginternational.com.co';
          $mail->Password = 'Opengates2023)';
          $mail->setFrom('no-reply@oginternational.com.co', 'oginternational.com.co'); 
          $mail->addReplyTo($email, $name);
          $mail->addAddress('info@oginternational.com.co', 'Opening Gates International');   // Establecer a donde se enviará el mensaje

          // Archivos adjuntos
          //$mail->addAttachment('/var/tmp/file.tar.gz');   // Agregar archivos adjuntos
          //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Nombre opcional

          // Contenido
          $mail -> isHTML(true);   // Establecer el formato de correo electrónico en HTML
          $mail -> Subject = 'Solicitud para encontrar empleo en Europa desde Centro y Sur América';   //Asunto del mensaje
          $mail -> Body = "<!DOCTYPE html>
          <html>
            <head>
              <style>

                .cuerpo_mensaje{
                  width:100%;
                  background-color:#110E0C;
                  color: #ffffff;
                  height: auto;
                  padding: 15px;
                  display: inline-flex
                }

                .image{
                  padding: 5px;
                  width: 30%;
                }

                .text{
                  padding: 5px;
                  width: 60%;
                }

                .im{
                  color: #ffffff;
                }

              </style>
            </head>
            <body>
              <div class='cuerpo_mensaje'>

                  <div class='image'>
                      <img src='https://oginternational.com.co/media/img/logo.jpg' width='80%' height='auto' style='border-radius: 50%'></img>
                  </div>


                  <div class='text'>
                  <span style='style'color: #ffffff !important'>
                        <h1 style'color: #ffffff !important'>Solicitud para encontrar empleo en Europa desde Centro y Sur América</h1>
                        <p>Telefono: $phone</p>
                        <p>Email: $email</p>
                  </span>
                  </div>

              </div>

            </body>
          </html>";

          if (!$mail->send()) {
            echo "error: ".$mail->ErrorInfo;
            echo json_encode(['msg' => 'Ocurrio una inconsistencia por favor intenta mas tarde', 'exito'=>false]);
          
          } else {
            echo json_encode($response);
          }
        } else{
          echo json_encode($response);
        }

      } catch(Exception $ex) {
        echo "Ha sucedido el siguiente error: ".$ex->getMessage();
      }
    }

    function getAll() {
      try {
        $modeloDAO = new customersDAO();

        $status = htmlspecialchars( $_REQUEST['status'], ENT_QUOTES );
        $resp = $modeloDAO -> getAll( $status );

        if ( $resp ) {
          $data = array();

          while ( $row = $resp -> fetch_object() ) {
            array_push($data, $row);
          }
        
        } else {
          $data = $resp;
        }

        echo json_encode([
          "data" => $data ? $data : [],
          "success" => true
        ]);

      } catch ( Exception $ex ) {
        echo "Ha sucedido el siguiente error: ".$ex -> getMessage();
      }
    }

    private function approvedRow() {
      try {
        // code...
        $_id = filter_input(INPUT_GET, "_id", FILTER_VALIDATE_INT);

        $modeloDAO = new customersDAO();
        $resp = $modeloDAO -> approved( $_id );

        if (count($resp) > 0) {
          echo json_encode($resp);
        
        } else {
          echo json_encode([
            "message" => "ocurrio una inconsistencia",
            "success" => false
          ]);
        }

      } catch (Exception $ex) {
        echo "Ha sucedido el siguiente error: ".$ex->getMessage();
      }
    }

    private function declinar() {
      try {
        //code...
        $_id = filter_input(INPUT_GET, "_id", FILTER_VALIDATE_INT);

        $modeloDAO = new customersDAO();
        $resp = $modeloDAO -> refused( $_id );

        if (count($resp) > 0) {
          echo json_encode($resp);

        } else {
          echo json_encode([
            "message" => "ocurrio una inconsistencia",
            "success" => false
          ]);
        }

      } catch (Exception $ex) {
        echo "Ha sucedido el siguiente error: ".$ex->getMessage();
      }
    }
  }
  $customersProcess = new CustomersProcess();