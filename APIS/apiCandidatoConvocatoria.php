<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                $convocatoria=BD_CANDIDATOS_CONVOCATORIA::FindByID($id);
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
                BD_CANDIDATOS_CONVOCATORIA::DeleteByID($id);
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
        $candidato_convocatoria=json_decode($cuerpo);
        $num_solicitudes=BD_CANDIDATOS_CONVOCATORIA::CompruebaHaSolicitado($candidato_convocatoria->DNI,
        $candidato_convocatoria->convocatoria->id_convocatoria);
        
        if ($num_solicitudes==0){
            $proyecto=new PROYECTO($candidato_convocatoria->convocatoria->proyecto->codigo_proyecto,
            $candidato_convocatoria->convocatoria->proyecto->nombre,$candidato_convocatoria->convocatoria->proyecto->fecha_inicio,
            $candidato_convocatoria->convocatoria->proyecto->fecha_fin);
            $convocatoria=new CONVOCATORIA($candidato_convocatoria->convocatoria->id_convocatoria,$candidato_convocatoria->convocatoria->num_movilidades,
            $candidato_convocatoria->convocatoria->tipo,$candidato_convocatoria->convocatoria->fecha_inicio,$candidato_convocatoria->convocatoria->fecha_fin,$candidato_convocatoria->convocatoria->fechainicioPruebas,
            $candidato_convocatoria->convocatoria->fechafinPruebas,$candidato_convocatoria->convocatoria->fechaListadoProvisional,$candidato_convocatoria->convocatoria->fechaListadoDefinitivo,$proyecto,$candidato_convocatoria->convocatoria->pais_destino,$candidato_convocatoria->convocatoria->nombre);
            $can_conv=new CANDIDATOS_CONVOCATORIA(null,$convocatoria,$candidato_convocatoria->DNI,$candidato_convocatoria->fecha_nacimiento,
            $candidato_convocatoria->tutor_legal,$candidato_convocatoria->apellido1,$candidato_convocatoria->apellido2,$candidato_convocatoria->nombre,$candidato_convocatoria->contrasena,
            $candidato_convocatoria->curso->codigo_grupo,$candidato_convocatoria->tlf,$candidato_convocatoria->correo,$candidato_convocatoria->domicilio,$candidato_convocatoria->rol);
            BD_CANDIDATOS_CONVOCATORIA::Insert($can_conv);
            http_response_code(200);
            $id=BD_CONVOCATORIA::sacarID();
            echo json_encode($id);
        }else{
            http_response_code(400);
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        
    }



?>