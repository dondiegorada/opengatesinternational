<?php

require("../class/db.class.php");
require("../class/validacionDAO.php");

class validacion {

    function __construct() {
      $funcion = $_REQUEST['FUNCION'];
      if (isset($funcion)) {
        $this -> $funcion();
      }
    }

    private function validaKeyword(){
        try {
            //code...
            $password = filter_input(INPUT_GET,'password',FILTER_SANITIZE_STRING);

            $validacionDAO = new validacionDAO();

            $resp = $validacionDAO->isKeyword($password);
            
            if(isset($resp) && count($resp)>0){

                session_name("panel");
                session_start();

                $_SESSION['bandera'] = true;

                echo json_encode($resp);
            }else{
                echo json_encode([
                    "resp"=>"Ocurrio una inconsistencia",
                    "exito"=> false
                ]);
            }
            
        } catch (Exception $ex) {
           echo "Error Processing Request".$ex->getMessage();
        }
    }

}

$validacion = new Validacion();