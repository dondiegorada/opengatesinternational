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

  public function getAll ( String $estado ) : bool | mysqli_result {
    $sql = "SELECT _id, nombres, apellidos, telefono, email, edad, comentario, fecha_registro,
          (CASE estado WHEN 'P' THEN 'Pendiente' WHEN 'A' THEN 'Aprobado' ELSE 'Rechazado' END)AS estado FROM customers WHERE estado = '$estado' ORDER BY _id DESC";
    
    $result = $this -> query($sql);

    if ( mysqli_num_rows( $result ) > 0 ) return $result;

    return false;
  }

  public function getByTerm ( String $term, String $status ) : bool | mysqli_result {
    $sql = "SELECT *, (CASE estado WHEN 'P' THEN 'Pendiente' WHEN 'A' THEN 'Aprobado' ELSE 'Rechazado' END) AS estado
            FROM customers
            WHERE estado = '$status' AND nombres LIKE '%$term%' LIMIT 10";
    
    $result = $this -> query( $sql );

    if ( !$result ) return false;
    
    return $result;
  }

  public function getById ( int $id ) : bool | object | null {
    $sql = "SELECT * FROM customers WHERE _id = $id";
    $result = $this -> query( $sql );

    if ( mysqli_num_rows($result) > 0 ) {
      return $result -> fetch_object();
    
    } else {
      return false;
    }
  }

  public function create ( $nombres, $email, $comentario, $telefono, $ruta ) {

    date_default_timezone_set('America/Bogota');

    $edad = filter_input(INPUT_POST, "edad", FILTER_SANITIZE_NUMBER_INT);
    $fecha_registro = date('Y-m-d H:i:s');
    $apellidos = '';

    // Debemos partir los nombre
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

  public function seleccionar( $_id ) {
    $update = "UPDATE customers SET estado = 'A' WHERE _id = $_id";
    $result = $this -> query($update);
    
    if ( $result ) {
      $row = $this -> getById( $_id );

      return [
        "message" => "El registro ".$row -> nombres." se aceptó correctamente",
        "success" => true
      ];

    }else{
      return[
        "message" => "Inconsistencia aprobando",
        "success" => false
      ];
    }
  }

  public function declinar($_id) {
    $update = "UPDATE customers SET estado = 'R' WHERE _id = $_id";
    $result = $this -> query($update);
    
    if ($result) {
      $row = $this -> getById( $_id );

      return [
        "message" => "El registro ".$row -> nombres." se rechazó correctamente",
        "success" => true
      ];

    } else {
      return [
        "message" => "Inconsistencia declinando",
        "success" => false
      ];
    }
  }
}