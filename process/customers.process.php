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

        $nombres = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $telefono = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
        $comentario = filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_STRING);
        
        //apuntamos a la funcion
        $resp = $customersDAO -> create($nombres,$email,$comentario,$telefono);

        if(count($resp)>0){

          //$mail -> SMTPDebug = SMTP::DEBUG_SERVER;
          $mail -> isSMTP();   // PHPMailer necesita usar SMTP
          //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
          $mail -> Host = 'smtp.gmail.com';
          $mail -> SMTPAuth = true;   // Habilita la autenticación SMTP
          $mail -> CharSet="UTF-8";
          $mail -> Username = 'no-reply@opengatesinternational.com';   // Nombre de usuario SMTP
          $mail -> Password = 'Opengates2023)';   // Contraseña SMTP
          $mail -> SMTPSecure = PHPMailer :: ENCRYPTION_SMTPS;   // Habilita el cifrado TLS implícito
          $mail -> Port = 465;

          // Destinatarios
          $mail -> setFrom($email, $nombres);   // Establecer de quién se enviará el mensaje
          $mail -> addAddress('johndev983@gmail.com', 'Open Gates International');   // Establecer a donde se enviará el mensaje
         // $mail -> addCC('diego@lucistudio.info','Diego');
          //$mail -> addCC('bryansugi@gmail.com','Bryan');
          $mail -> addReplyTo($email, $nombres);   // A quien se respondera el email

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
                      <img src='https://res.cloudinary.com/ucam-com/image/upload/v1636647393/img-administracion/imagenes/logo_mzwz6w.png' width='80%' height='auto'></img>
                  </div>


                  <div class='text'>
                  <span style='style'color: #ffffff !important'>
                        <h1 style'color: #ffffff !important'>Solicitud para encontrar empleo en Europa desde Centro y Sur América</h1>
                        <h2 style'color: #ffa500 !important'>Descripción</h2>
                        $comentario
                        <p>Telefono: $telefono</p>
                        <p>Email: $email</p>
                  </span>
                  </div>

              </div>

            </body>
          </html>";

          if (!$mail->send()) {
            //echo "error: ".$mail->ErrorInfo;
            echo json_encode(['msg' => 'Ocurrio una inconsistencia por favor intenta mas tarde', 'exito'=>false]);
          }else {
            echo json_encode($resp);
          }
        }

      } catch(Exception $ex) {
        echo "Ha sucedido el siguiente error: ".$ex->getMessage();
      }
    }

    private function seleccionarModelo(){
      try {
        //code...
        $_id = filter_input(INPUT_GET, "_id", FILTER_SANITIZE_STRING);

        $modeloDAO = new customersDAO();

        $resp = $modeloDAO -> seleccionar($_id);

        if(count($resp)>0){
          echo json_encode($resp);
        }else{
          echo json_encode([
            "msg"=>"ocurrio una inconsistencia",
            "exito"=>false
          ]);
        }


      } catch (Exception $ex) {
        echo "Ha sucedido el siguiente error: ".$ex->getMessage();
      }
    }

    private function declinar(){
      try {
        //code...
        $_id = filter_input(INPUT_GET, "_id", FILTER_SANITIZE_STRING);

        $modeloDAO = new customersDAO();

        $resp = $modeloDAO -> declinar($_id);

        if(count($resp)>0){
          echo json_encode($resp);
        }else{
          echo json_encode([
            "msg"=>"ocurrio una inconsistencia",
            "exito"=>false
          ]);
        }


      } catch (Exception $ex) {
        echo "Ha sucedido el siguiente error: ".$ex->getMessage();
      }
    }
  }
  $customersProcess = new customersProcess();