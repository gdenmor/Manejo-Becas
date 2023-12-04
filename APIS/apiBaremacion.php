<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                $baremacion=BD_BAREMACION::FindByID($id);
                $bar=$baremacion->toJSON();
                http_response_code(200);
                echo $bar;
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
                BD_BAREMACION::DeleteByID($id);
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
        $archivo=$_FILES['archivo']['name'];
        $temporal=$_FILES['archivo']['tmp_name'];
        $ruta="../APORTACIONES/".$archivo;
        $baremacion=$_POST['baremacion'];
        $barema=json_decode($baremacion);
        $item=new ITEM_BAREMABLE($barema->item->id_item,$barema->item->nombre);
        $proyecto=new PROYECTO($barema->convocatoria->convocatoria->proyecto->codigo_proyecto,
        $barema->convocatoria->convocatoria->proyecto->nombre,$barema->convocatoria->convocatoria->proyecto->fecha_inicio,
        $barema->convocatoria->convocatoria->proyecto->fecha_fin);
        $convocatoria=new CONVOCATORIA($barema->convocatoria->convocatoria->id_convocatoria,$barema->convocatoria->convocatoria->num_movilidades,
        $barema->convocatoria->convocatoria->tipo,$barema->convocatoria->convocatoria->fecha_inicio,$barema->convocatoria->convocatoria->fecha_fin,$barema->convocatoria->convocatoria->fechainicioPruebas,
        $barema->convocatoria->convocatoria->fechafinPruebas,$barema->convocatoria->convocatoria->fechaListadoProvisional,$barema->convocatoria->convocatoria->fechaListadoDefinitivo,$proyecto,$barema->convocatoria->convocatoria->pais_destino,$barema->convocatoria->convocatoria->nombre);
        $candidato_convocatoria=new CANDIDATOS_CONVOCATORIA(null,$convocatoria,$barema->convocatoria->DNI,
        $barema->convocatoria->fecha_nacimiento,$barema->convocatoria->tutor_legal,$barema->convocatoria->apellido1,
        $barema->convocatoria->apellido2,$barema->convocatoria->nombre,$barema->convocatoria->contrasena,$barema->convocatoria->curso,$barema->convocatoria->tlf,
        $barema->convocatoria->correo,$barema->convocatoria->domicilio,$barema->convocatoria->rol);
        $baremaSQL=new BAREMACION($barema->id_baremacion,$candidato_convocatoria,$item,null,$ruta);
        BD_BAREMACION::Insert($baremaSQL);

        /*if (move_uploaded_file($temporal,$ruta)){
            http_response_code(200);
        }else{
            http_response_code(400);
        }*/
    }

    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        
    }



?>