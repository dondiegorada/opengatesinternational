<?php
  class customersDAO extends db {
   
    function __construct() {
      parent::__construct();
    }

    public function getMaxId($Table,$Column){
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

  public function getAll() {
    $sql = "SELECT _id, nombres, apellidos, telefono, email, edad, comentario, fecha_registro,
          (CASE estado WHEN 'P' THEN 'Pendiente' WHEN 'A' THEN 'Aprobado' ELSE 'Rechazado' END)AS estado FROM customers ORDER BY _id DESC";
    
    $result = $this -> query($sql);

    if (mysqli_num_rows($result) > 0) {
      return $result;
    }
  }

  public function create ($nombres,$email,$comentario,$telefono) {

    date_default_timezone_set('America/Bogota');

    $edad = filter_input(INPUT_POST, "edad", FILTER_SANITIZE_NUMBER_INT);
    $fecha_registro = date('Y-m-d H:i:s');
    $apellidos = '';

    //debemos partir los nombre
    $posiciones = explode(" ", $nombres);

    if(count($posiciones)>3){
      $nombres = $posiciones[0].' '.$posiciones[1];
      $apellidos = $posiciones[2].' '.$posiciones[3];
    }else if(count($posiciones)>2){
       $nombres = $posiciones[0].' '.$posiciones[1];
       $apellidos = $posiciones[2];
    }else if(count($posiciones)>1){
      $nombres = $posiciones[0].' '.$posiciones[1];
    }else{
      $nombres = $posiciones[0];
    }

    $select="SELECT * FROM customers WHERE email = '$email' OR telefono = '$telefono'";
    $result = $this -> query($select);

    if (mysqli_num_rows($result) > 0) {
      return [
        "exito" => false,
        "msg" => "Ya te registraste anteriormente, si no es así intenta cambiando el email o el numero de télefono",
        "duplicado" => true
      ];

    }

    $modelo_id = $this -> getMaxId('customers','_id');

    $insert = "INSERT INTO customers (_id,nombres,apellidos,telefono,email,edad,comentario,fecha_registro) 
             VALUES ($modelo_id,'$nombres','$apellidos','$telefono','$email',$edad,'$comentario','$fecha_registro')";
    $result = $this -> query($insert);

    if ($result) {
      return [
        "exito" => true,
        "msg" => "En un rango maximo de 24 horas nos comunicaremos contigo",
        "duplicado" => false
      ];
    
    } else {
      return [
        "exito" => false,
        "msg" => "A ocurrido una inconsistenca, por favor intenta mas tarde.",
        "duplicado" => false
      ];
    }
  }

  public function seleccionar($_id){
    $update = "UPDATE customers SET estado = 'A' WHERE _id = $_id";
    $result = $this -> query($update);
    
    if ($result) {
      return [
        "msg"=>"Modelo seleccionada exitosamente",
        "exito"=>true
      ];

    }else{
      return[
        "msg"=>"Inconsistencia actualizando la modelo",
        "exito"=>false
      ];
    }
  }

  public function declinar($_id) {
    $update = "UPDATE customers SET estado = 'R' WHERE _id = $_id";
    $result = $this -> query($update);
    
    if ($result) {
      return [
        "msg" => "Declinado exitosamente",
        "exito" => true
      ];

    } else {
      return [
        "msg" => "Inconsistencia declinando",
        "exito" => false
      ];
    }
  }
}