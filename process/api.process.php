<?php

header('Content-Type: application/json');
//header('Access-Control-Allow-Origin: http://localhost');

require_once("../class/db.class.php");
require_once("../class/modeloDAO.php");
require_once("../class/preguntasDAO.php");

$funcion = filter_input(INPUT_POST, "FUNCION", FILTER_SANITIZE_STRING);

switch ($funcion) {

   case 'getModelos':
      # code...
      $modeloDAO = new modeloDAO();
      $result = $modeloDAO -> getModelos();
      
      if (count($result)>0) {
         echo json_encode($result);
      }
      break;
   
   case 'getPreguntas':
      # code...
      $preguntasDAO = new preguntasDAO();
      $result = $preguntasDAO -> getPreguntas();
      
      if (count($result)>0) {
         echo json_encode($result);
      }
      break;
}

?>