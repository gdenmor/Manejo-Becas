<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $conexion=CONEXION::AbreConexion();
        $conexion->beginTransaction();
    }



?>