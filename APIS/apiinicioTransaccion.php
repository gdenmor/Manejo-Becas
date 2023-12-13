<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        try{
            $conexion=CONEXION::AbreConexion();
            $conexion->beginTransaction();
            http_response_code(200);
            $obj=json_encode(get_object_vars($conexion));
            echo $obj;
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    

?>