<?php
  class customersDAO extends db {
   
    function __construct() {
      parent::__construct();
    }

    public function getMaxId($Table, $Column) {
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
    $sql = "SELECT customers.*,
              (CASE status WHEN 'P' THEN 'Pendiente' WHEN 'A' THEN 'Aprobado' ELSE 'Rechazado' END) AS status,
              (CASE passport WHEN 0 THEN 'No tiene' ELSE 'Si tiene' END) AS passport,
              (SELECT name FROM city WHERE _id = customers.city) as city,
              (SELECT name FROM tipos_visa WHERE _id = customers.tipo_visa) as tipo_visa
            FROM customers WHERE status = '$estado' ORDER BY _id DESC";

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

  public function create ( String $name, int $phone, String $email, String $testimony, int $year, int $city, int $passport, $tipo_visa, String $interes ) {
    date_default_timezone_set('America/Bogota');
    $createdAt = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM customers WHERE email = '$email' OR phone = '$phone'";
    $result = $this -> query( $sql );

    if ( mysqli_num_rows( $result ) > 0 ) {
      return (object) [
        "success" => false,
        "message" => "Ya te registraste anteriormente, si no es así intenta cambiando el email o el numero de télefono.",
        "duplicate" => true
      ];
    }

    $_id = $this -> getMaxId('customers','_id');

     // Si tipo_visa está vacío o no se proporciona, asignar NULL
     $tipo_visa = (!empty($tipo_visa) && $tipo_visa != 0) ? (int)$tipo_visa : 'NULL';

    $sql = "INSERT INTO customers (_id, name, phone, email, comentario, year, city, passport, interes, tipo_visa, createdAt) 
               VALUES ($_id, '$name', '$phone', '$email', '$testimony', $year, $city, $passport, '$interes', $tipo_visa, '$createdAt')";
    $result = $this -> query( $sql );

    if ( $result ) {
      return (object) [
        "success" => true,
        "message" => "En un rango maximo de 24 horas nos comunicaremos contigo.",
        "duplicate" => false
      ];
    
    } else {
      return (object) [
        "success" => false,
        "message" => "A ocurrido una inconsistenca, por favor intenta mas tarde.",
        "duplicate" => false
      ];
    }
  }

  public function approved( $_id ) {
    $update = "UPDATE customers SET status = 'A' WHERE _id = $_id";
    $result = $this -> query($update);
    
    if ( $result ) {
      return [
        "message" => "El registro fue aprobado correctamente",
        "success" => true
      ];

    }else{
      return[
        "message" => "Inconsistencia aprobando",
        "success" => false
      ];
    }
  }

  public function refused( $_id ) {
    $update = "UPDATE customers SET status = 'R' WHERE _id = $_id";
    $result = $this -> query($update);
    
    if ($result) {
      return [
        "message" => "El registro se rechazó correctamente",
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