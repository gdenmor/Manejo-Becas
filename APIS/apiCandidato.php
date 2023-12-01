<?php
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $DNI=$_GET['dni'];
        if (isset($DNI)){
            $validador=new VALIDATOR();
            if ($validador->validaDNI($DNI)){
                $candidato=BD_CANDIDATO::FindByID($DNI);
                //$cand=$candidato->toJSON();
                http_response_code(200);
                echo $cand;
            }else{
                http_response_code(300);
            }
        }else{
            http_response_code(400);
        }
    }



?>