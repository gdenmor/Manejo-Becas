<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                $convocatoria=BD_DESTINATARIOS_CONVOCATORIAS::FindByID($id);
                $conv=$convocatoria->toJSON();
                http_response_code(200);
                echo $conv;
            }else{
                http_response_code(300);
            }
        }else{
            http_response_code(400);
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                BD_DESTINATARIOS_CONVOCATORIAS::DeleteByID($id);
                http_response_code(200);
            }else{
                http_response_code(300);
            }
        }else{
            http_response_code(400);
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $cuerpo=file_get_contents("php://input");
        
    }

    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        
    }



?>