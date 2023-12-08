<?php

require("../class/db.class.php");
require("../class/cargaImagenesDAO.php");

class cargaImagenes {

    function __construct() {
      $funcion = $_REQUEST['FUNCION'];
      if (isset($funcion)) {
        $this -> $funcion();
      }
    }

    private function Upload(){
        try {
            //code...
            $seccion_id = filter_input(INPUT_POST,'seccion_id',FILTER_SANITIZE_NUMBER_INT);
            $alt = filter_input(INPUT_POST,'alt',FILTER_SANITIZE_STRING);

            $cargaImagenesDAO = new cargaImagenesDAO();

            $data = $cargaImagenesDAO->multiplicidad($seccion_id);

            if(!$data['exito'] && $data['reemplazo']){
                echo json_encode([
                    "msg"=>$data['msg'],
                    "exito"=>$data['exito'],
                    "reemplazo"=>$data['reemplazo'],
                    "banner_seccion_id"=>$data['banner_seccion_id']
                ]);
                exit();
            }

            $imagen_error =$_FILES['imagen']['error'];

            if($imagen_error){
                echo json_encode([
                    "msg"=>"Error al cargar la imagen",
                    "exito"=>false
                ]);
                exit();
            }

            $mb = 1048576;
            $tamaño_imagen= $_FILES['imagen']['size'];

            if($tamaño_imagen >= $mb*5){
                echo json_encode([
                    "msg"=>"El peso de la imagen es muy grande por favor disminuyelo",
                    "exito"=>false
                ]);
                exit();
            }

            $tipo_imagen= $_FILES['imagen']['type'];

            if($tipo_imagen != "image/jpg" && $tipo_imagen != "image/png" && $tipo_imagen != "image/gif" && $tipo_imagen != "image/jpeg" && $tipo_imagen != "imagen/webp"){
                echo json_encode([
                    "msg"=>"El tipo de archivo no es permitido. Formatos admitidos (jpg,png,gif,webp,jpeg)",
                    "exito"=>false
                ]);
                exit();
            }

            $name_imagen = $_FILES['imagen']['name'];
            $arrayName = explode('.',$name_imagen);
            $size_array = count($arrayName);
            $name_imagen = $arrayName[0].rand().".".$arrayName[$size_array-1];

            $url=$_SERVER['PHP_SELF'];
            $url = explode('/', $url);
   
            //ruta de la carpeta destino en el servidor
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/'.$url[1].'/media/imagenes/'.$name_imagen;
            $move = move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino);
            $ruta = 'localhost/'.$url[1].'/media/imagenes/'.$name_imagen;
      
            //movemos la imagen del directorio temporal al directorio escogido
            if(!$move){
                echo json_encode([
                    "msg"=>"Inconsistencia guardado la imagen",
                    "exito"=>false
                ]);
                exit();
            }

            $resp = $cargaImagenesDAO->UploadImages($ruta,$seccion_id,$alt);
          
            if(isset($resp) && count($resp)>0){
                echo json_encode($resp);
            }else{
                echo json_encode([
                    "msg"=>"Ocurrio una inconsistencia",
                    "exito"=> false
                ]);
            }
            
        } catch (Exception $ex) {
           echo "Error Processing Request".$ex->getMessage();
        }
    }


    private function updateImagen(){
        try {
            //code...
            $seccion_id = filter_input(INPUT_POST,'seccion_id',FILTER_SANITIZE_NUMBER_INT);
            $alt = filter_input(INPUT_POST,'alt',FILTER_SANITIZE_STRING);
            $banner_seccion_id = filter_input(INPUT_POST,'banner_seccion_id',FILTER_SANITIZE_NUMBER_INT);

            $dataDelete = $this->deleteImagen($seccion_id);
            if(!$dataDelete['exito']){
                echo json_encode([
                    "msg"=>"Inconsistencia eliminando imagen del servidor",
                    "exito"=>false
                ]);
                exit();
            }

            $cargaImagenesDAO = new cargaImagenesDAO();

            $imagen_error =$_FILES['imagen']['error'];

            if($imagen_error){
                echo json_encode([
                    "msg"=>"Error al cargar la imagen",
                    "exito"=>false
                ]);
                exit();
            }

            $name_imagen = $_FILES['imagen']['name'];
            $arrayName = explode('.',$name_imagen);
            $name_imagen = $arrayName[0].rand().".".end($arrayName);

            $url=$_SERVER['PHP_SELF'];
            $url = explode('/', $url);
   
            //ruta de la carpeta destino en el servidor
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/'.$url[1].'/media/imagenes/'.$name_imagen;
            $move = move_uploaded_file($_FILES['imagen']['tmp_name'],$carpeta_destino);
            $ruta = 'localhost/'.$url[1].'/media/imagenes/'.$name_imagen;
      
            //movemos la imagen del directorio temporal al directorio escogido
            if(!$move){
                echo json_encode([
                    "msg"=>"Inconsistencia guardado la imagen",
                    "exito"=>false
                ]);
                exit();
            }

            $resp = $cargaImagenesDAO->updateUploadImages($ruta,$seccion_id,$alt,$banner_seccion_id);
          
            if(isset($resp) && count($resp)>0){
                echo json_encode($resp);
            }else{
                echo json_encode([
                    "msg"=>"Ocurrio una inconsistencia",
                    "exito"=> false
                ]);
            }
            
        } catch (Exception $ex) {
           echo "Error Processing Request".$ex->getMessage();
        }
    }

    private function deleteImagen($seccion=null){

        $banner_seccion_id = filter_input(INPUT_GET,'banner_seccion_id',FILTER_SANITIZE_NUMBER_INT);

        $cargaImagenesDAO = new cargaImagenesDAO();

        if($seccion != null){
            $data = $cargaImagenesDAO->getRuta($seccion,null);
        }else{
            $data = $cargaImagenesDAO->getRuta(null,$banner_seccion_id);
        }
        
        if(isset($data) && $data['exito']){
            $ruta = $data['ruta'];

            $arrayRuta=explode('/',$ruta);
            $file_name = end($arrayRuta);

            $url=$_SERVER['PHP_SELF'];
            $url = explode('/', $url);
   
            //ruta de la carpeta destino en el servidor
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/'.$url[1].'/media/imagenes/'.$file_name;

            $delete = unlink($carpeta_destino);

            if(!$delete){
                echo json_encode([
                    "msg"=>"Ocurrio una inconsistencia eliminando el archivo",
                    "exito"=> false
                ]);
            }else{
                if($seccion != null){
                    return[
                        "exito"=>true
                    ];
                }else{
                    //debemos ir a la base de datos y eliminar el registro
                    $deleteReg = $cargaImagenesDAO->deleteImagen($banner_seccion_id);
                    if(count($deleteReg)>0){
                        echo json_encode($deleteReg);
                    }else{
                        echo json_encode([
                            "msg"=>"Ocurrio una inconsistencia eliminando",
                            "exito"=> false
                        ]);
                    }
                }
            }
        }else{
            echo json_encode([
                "msg"=>"Ocurrio una inconsistencia obteniendo la ruta",
                "exito"=> false
            ]);
        }
    }

}

$cargaImagenes = new CargaImagenes();