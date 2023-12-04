<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $conexion=CONEXION::AbreConexion();
        $id=$conexion->lastInsertId();
        echo json_encode($id);
    }

?>