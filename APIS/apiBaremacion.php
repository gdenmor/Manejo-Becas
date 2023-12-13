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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el cuerpo de la solicitud
    $conexion=CONEXION::AbreConexion();
    $cuerpo = file_get_contents("php://input");

    // Obtener el nombre del archivo y la ubicación temporal
    $archivo = $_FILES['archivo']['name'];
    $temporal = $_FILES['archivo']['tmp_name'];
    $ruta = "../APORTACIONES/" . $archivo;

    // Decodificar el JSON
    $baremacion = $_POST['baremacion'];
    $barema = json_decode($baremacion);

    // Acceder a los objetos en el JSON
    $item_id = $barema->item->id_item;
    $item_nombre = $barema->item->nombre;

    $proyecto_codigo = $barema->convocatoria->convocatoria->proyecto->codigo_proyecto;
    $proyecto_nombre = $barema->convocatoria->convocatoria->proyecto->nombre;
    $proyecto_fecha_inicio = $barema->convocatoria->convocatoria->proyecto->fecha_inicio;
    $proyecto_fecha_fin = $barema->convocatoria->convocatoria->proyecto->fecha_fin;

    $convocatoria_id = $barema->convocatoria->convocatoria->id_convocatoria;
    $convocatoria_num_movilidades = $barema->convocatoria->convocatoria->num_movilidades;
    $convocatoria_tipo = $barema->convocatoria->convocatoria->tipo;
    $convocatoria_fecha_inicio = $barema->convocatoria->convocatoria->fecha_inicio;
    $convocatoria_fecha_fin = $barema->convocatoria->convocatoria->fecha_fin;
    $convocatoria_fecha_inicio_pruebas = $barema->convocatoria->convocatoria->fechainicioPruebas;
    $convocatoria_fecha_fin_pruebas = $barema->convocatoria->convocatoria->fechafinPruebas;
    $convocatoria_fecha_listado_provisional = $barema->convocatoria->convocatoria->fechaListadoProvisional;
    $convocatoria_fecha_listado_definitivo = $barema->convocatoria->convocatoria->fechaListadoDefinitivo;
    $convocatoria_pais_destino = $barema->convocatoria->convocatoria->pais_destino;
    $convocatoria_nombre = $barema->convocatoria->convocatoria->nombre;

    $candidato_DNI = $barema->convocatoria->DNI;
    $candidato_fecha_nacimiento = $barema->convocatoria->fecha_nacimiento;
    $candidato_tutor_legal = $barema->convocatoria->tutor_legal;
    $candidato_apellido1 = $barema->convocatoria->apellido1;
    $candidato_apellido2 = $barema->convocatoria->apellido2;
    $candidato_nombre = $barema->convocatoria->nombre;
    $candidato_contrasena = $barema->convocatoria->contrasena;
    $candidato_curso = $barema->convocatoria->curso;
    $candidato_tlf = $barema->convocatoria->tlf;
    $candidato_correo = $barema->convocatoria->correo;
    $candidato_domicilio = $barema->convocatoria->domicilio;
    $candidato_rol = $barema->convocatoria->rol;

    // ... Continuar accediendo a otros objetos según sea necesario

    // Crear instancias de las clases correspondientes
    $item = new ITEM_BAREMABLE($item_id, $item_nombre);
    $proyecto = new PROYECTO($proyecto_codigo, $proyecto_nombre, $proyecto_fecha_inicio, $proyecto_fecha_fin);
    $convocatoria = new CONVOCATORIA($convocatoria_id, $convocatoria_num_movilidades, $convocatoria_tipo, $convocatoria_fecha_inicio, $convocatoria_fecha_fin, $convocatoria_fecha_inicio_pruebas, $convocatoria_fecha_fin_pruebas, $convocatoria_fecha_listado_provisional, $convocatoria_fecha_listado_definitivo, $proyecto, $convocatoria_pais_destino, $convocatoria_nombre,null,null);

    $candidato_convocatoria = new CANDIDATOS_CONVOCATORIA($barema->convocatoria->id_candidato_convocatoria, $convocatoria, $candidato_DNI, $candidato_fecha_nacimiento, $candidato_tutor_legal, $candidato_apellido1, $candidato_apellido2, $candidato_nombre, $candidato_contrasena, $candidato_curso, $candidato_tlf, $candidato_correo, $candidato_domicilio, $candidato_rol,null);

    $baremaSQL = new BAREMACION($barema->id_baremacion, $candidato_convocatoria, $item, null, $ruta);

    // Insertar en la base de datos
    try{
        BD_BAREMACION::Insert($baremaSQL);

        // Mover el archivo subido a la ubicación deseada
        if (move_uploaded_file($temporal, $ruta)) {
            http_response_code(200);
            $conexion->commit();
        } else {
            http_response_code(400);
            $conexion->commit();
        }
    }catch (Exception $e){
        echo $e->getMessage();
    }
    
}

if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        
}
?>
