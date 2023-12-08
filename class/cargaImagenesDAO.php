<?php
  
class cargaImagenesDAO extends db{
   
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

    public function getSecciones(){

        $select="SELECT seccion_id, nombre FROM seccion WHERE imagen = '1'";
        $result = $this->query($select);

        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }

    public function multiplicidad($seccion_id){
        $select="SELECT multiple FROM seccion WHERE seccion_id=$seccion_id";
        $result = $this->query($select);

        if(!mysqli_num_rows($result)>0){
            return[
                "msg"=>"Inconsistencia buscando la sección",
                "exito"=> false
            ];
        }

        $row=mysqli_fetch_assoc($result);
        $multiple = $row['multiple'];

        if($multiple==0){

            $select="SELECT banner_seccion_id FROM banners_seccion WHERE seccion_id=$seccion_id";
            $result = $this->query($select);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                $banner_seccion_id = $row['banner_seccion_id'];
                return[
                    "msg"=>"Ya existe una imagen para esta sección ¿ deseas reemplazarla ?",
                    "reemplazo"=>true,
                    "banner_seccion_id"=>$banner_seccion_id,
                    "exito"=> false
                ];
                exit();
            }else{
                return[
                    "reemplazo"=>false,
                    "exito"=> true
                ];
            }

        }else{
            return[
                "reemplazo"=>false,
                "exito"=> true
            ];
        }
    }

    public function getRuta($seccion_id=null,$banner_seccion_id=null){

        if($seccion_id != null){
            $select="SELECT imagen FROM banners_seccion WHERE seccion_id=$seccion_id";
            $result = $this->query($select);
        }else{
            $select="SELECT imagen FROM banners_seccion WHERE banner_seccion_id=$banner_seccion_id";
            $result = $this->query($select);
        }

        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $ruta = $row['imagen'];

            return[
                "ruta"=>$ruta,
                "exito"=>true
            ];
        }else{
            return[
                "exito"=>false
            ];
        }
    }

    public function uploadImages($ruta,$seccion_id,$alt){
        
        $banner_seccion_id = $this->getMaxId('banners_seccion','banner_seccion_id');

        $insert="INSERT INTO banners_seccion (banner_seccion_id,imagen,alt,seccion_id) 
                VALUES ($banner_seccion_id,'$ruta','$alt',$seccion_id)";
        $result = $this->query($insert);

        if(!$result){
            return[
                "msg"=>"Inconsistencia agregando la imagen a la base de datos",
                "exito"=> false
            ];
        }

        return[
            "msg"=>"Datos cargados exitosamente",
            "exito"=> true
        ];

    }

    public function updateUploadImages($ruta,$seccion_id,$alt,$banner_seccion_id){

        $update="UPDATE banners_seccion SET imagen='$ruta',alt='$alt',seccion_id=$seccion_id
                 WHERE banner_seccion_id=$banner_seccion_id";
        $result = $this->query($update);

        if(!$result){
            return[
                "msg"=>"Inconsistencia actualizando la imagen en base de datos",
                "exito"=> false
            ];
        }

        return[
            "msg"=>"Datos actualizados exitosamente!",
            "exito"=> true
        ];

    }

    public function deleteImagen($banner_seccion_id){
        $delete="DELETE FROM banners_seccion WHERE banner_seccion_id=$banner_seccion_id";
        $result = $this->query($delete);
        if(!$result){
            return[
                "msg"=>"Inconsistencia eliminando la imagen en base de datos",
                "exito"=> false
            ];
            exit();
        }

        return[
            "msg"=>"Imagen eliminada exitosamente!",
            "exito"=> true
        ];


    }

    public function getBannersPorSeccion($seccion_id){
        $select="SELECT banner_seccion_id, imagen, alt, seccion_id FROM banners_seccion WHERE seccion_id=$seccion_id";
        $result = $this->query($select);
        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }

    public function getImages($seccion_id){
        $select="SELECT banner_seccion_id, imagen, alt FROM banners_seccion WHERE seccion_id=$seccion_id";
        $result = $this->query($select);
        if(mysqli_num_rows($result)>0){
            return $result;
        }
    }

}