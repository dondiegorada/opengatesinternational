<?php
  
class validacionDAO extends db{
   
    function __construct() {
      parent::__construct();
    }

    public function isKeyword($password){

        $select="SELECT keyword FROM keywords WHERE estado = 'A' ORDER BY keyword_id DESC LIMIT 1";
        $result = $this->query($select);

        if(mysqli_num_rows($result)>0){
            $keyword = mysqli_fetch_assoc($result)['keyword'];
            if($password==$keyword){
                return[
                    "resp"=>"Ingreso exitoso",
                    "exito"=>true
                ];
            }else{
                return[
                    "resp"=>"Palabra clave incorrecta",
                    "exito"=>false
                ];
            }
        }else{
            return[
                    "resp"=>"Inconsistencia en tabla keywords",
                    "exito"=>false
                ];
        }
    }

}