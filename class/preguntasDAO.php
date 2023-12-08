<?php
  class preguntasDAO extends db{
   
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

  public function getPreguntas(){

    $sql = "SELECT * FROM preguntas ORDER BY pregunta_id DESC";
    $result = $this -> query($sql);

    if(mysqli_num_rows($result) > 0){
      for($i=0; $row=mysqli_fetch_assoc($result); $i++){
        $data[$i] = $row;
      }
        return [
          "exito" => true,
          "result" => $data
        ];
      
    } else {
      return [
        "exito" => false,
        "msg" => "Ocurrio una inconsistencia al buscar las preguntas"
      ];
    }
  }

  
  public function savePregunta($nombre,$email,$pregunta){

    date_default_timezone_set('America/Bogota');
    $fecha_pregunta = date('Y-m-d H:i:s');

    $pregunta_id = $this->getMaxId('preguntas','pregunta_id');

    $insert="INSERT INTO preguntas (pregunta_id,pregunta,nombre,fecha_pregunta,email,estado) 
             VALUES ($pregunta_id,'$pregunta','$nombre','$fecha_pregunta','$email','P')";        
    $result = $this -> query($insert);

    if($result){
      return [
        "exito"=>true,
        "msg"=>"Pregunta enviada exitosamente"
      ];
    }else{
      return [
        "exito"=>false,
        "msg"=>"A ocurrido una inconsistenca, por favor intenta mas tarde."
      ];
    }

  }

  }