<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $DNI=$_GET['dni'];
        if (isset($DNI)){
            $validador=new VALIDATOR();
            if ($validador->validaDNI($DNI)){
                $candidato=BD_CANDIDATO::FindByID($DNI);
                $cand=$candidato->toJSON();
                http_response_code(200);
                echo $cand;
            }else{
                http_response_code(300);
            }
        }else{
            http_response_code(400);
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $DNI=$_GET['dni'];
        if (isset($DNI)){
            $validador=new VALIDATOR();
            if ($validador->validaDNI($DNI)){
                BD_CANDIDATO::DeleteByID($DNI);
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