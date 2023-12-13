<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $conexion=CONEXION::AbreConexion();
        $conexion->commit();
        http_response_code(200);
    }
?>