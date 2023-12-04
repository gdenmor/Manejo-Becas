<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                $tutor=BD_TUTORLEGAL::FindByID($id);
                $tut=$tutor->toJSON();
                http_response_code(200);
                echo $tut;
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
                BD_TUTORLEGAL::DeleteByID($id);
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