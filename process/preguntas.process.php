<?php
  require("../class/db.class.php");
  require("../class/preguntasDAO.php");
  // Requerimos la clase del api

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

require '../librerias/PHPMailer/src/Exception.php';
require '../librerias/PHPMailer/src/PHPMailer.php';
require '../librerias/PHPMailer/src/SMTP.php';

  class modeloProcess {
    function __construct() {
      $funcion = $_REQUEST['FUNCION'];
      if (isset($funcion)) {
        $this -> $funcion();
      }
    }

    private function savePreguntas(){
      try {
        $preguntasDAO = new preguntasDAO();
        $mail = new PHPMailer();

        $nombres = filter_input(INPUT_POST, "nombres", FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING);
        $pregunta = filter_input(INPUT_POST, "comentario", FILTER_SANITIZE_STRING);
        //apuntamos a la funcion
        $resp = $preguntasDAO -> savePregunta($nombres,$email,$pregunta);
       
        if(count($resp)>0){
            //$mail -> SMTPDebug = SMTP::DEBUG_SERVER;
            $mail -> isSMTP();   // PHPMailer necesita usar SMTP
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail -> Host = 'smtp.gmail.com';
            $mail -> SMTPAuth = true;   // Habilita la autenticación SMTP
            $mail -> CharSet="UTF-8";
            $mail -> Username = 'no-repply@ucamme.com';   // Nombre de usuario SMTP
            $mail -> Password = 'qm2S>Ch4';   // Contraseña SMTP
            $mail -> SMTPSecure = PHPMailer :: ENCRYPTION_SMTPS;   // Habilita el cifrado TLS implícito
            $mail -> Port = 465;

            // Destinatarios
            $mail -> setFrom($email, $nombres);   // Establecer de quién se enviará el mensaje
            $mail -> addAddress('support@ucamme.com', 'ucamme.com');   // Establecer a donde se enviará el mensaje
            $mail -> addCC('angie@ucamme.com','Angie');
            $mail -> addCC('camilo@ucamme.com','Camilo');
            $mail -> addCC('brayan@ucamme.com','Bryan');
            $mail -> addReplyTo($email, $nombres);   // A quien se respondera el email

            // Archivos adjuntos
            //$mail->addAttachment('/var/tmp/file.tar.gz');   // Agregar archivos adjuntos
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Nombre opcional

            // Contenido
            $mail -> isHTML(true);   // Establecer el formato de correo electrónico en HTML
            $mail -> Subject = 'Pregunta modelo webcam mclovin';   //Asunto del mensaje
            $mail -> Body = "<!DOCTYPE html>
            <html>
              <head>
                <style>

                  .cuerpo_mensaje{
                    width:100%;
                    background-color:#222121;
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

                </style>
              </head>
              <body>
                <div class='cuerpo_mensaje'>

                    <div class='image'>
                        <img src='https://res.cloudinary.com/ucam-com/image/upload/v1636647393/img-administracion/imagenes/logo_mzwz6w.png' width='80%' height='auto'></img>
                    </div>

                      
                    <div class='text'>
                    <span style='style'color: #ffffff !important'>
                          <h1 style'color: #ffffff !important'>Pregunta modelo webcam McLovin84 Studio</h1>
                          <h2 style'color: #ffa500 !important'>Pregunta: </h2>
                          $pregunta
                          <p>Nombre: $nombres</p>
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

  }
  $modeloProcess = new modeloProcess(); 