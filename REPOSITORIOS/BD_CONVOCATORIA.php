<?php
class BD_CONVOCATORIA
{
    public static function FindAll()
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * from CONVOCATORIAS");
        $resultado->execute();

        $Convocatorias = null;

        $i = 0;


        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $id_convocatoria = $tuplas->id_convocatoria;
            $num_movilidades = $tuplas->num_movilidades;
            $tipo = $tuplas->tipo;
            $fecha_inicio = $tuplas->fecha_inicio;
            $fecha_fin = $tuplas->fecha_fin;
            $fechainicioPruebas = $tuplas->fechaInicioPruebas;
            $fechafinPruebas = $tuplas->fechaFinPruebas;
            $fechaListadoProvisional = $tuplas->fechaListadoProvisional;
            $fechaListadoDefinitivo = $tuplas->fechaListadoDefinitivo;
            $codigo_proyecto = $tuplas->codigo_proyecto;
            $destino = $tuplas->pais_destino;
            $nombre = $tuplas->nombre;
            $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
            $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto, $destino, $nombre);
            $Convocatorias[] = $Convocatoria;
            $i++;
        }

        return $Convocatorias;
    }

    public static function FindByID($id_convocatoria)
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * FROM CONVOCATORIAS WHERE id_convocatoria=:id_convocatoria");
        $resultado->bindParam(':id_convocatoria', $id_convocatoria, PDO::PARAM_STR);
        $resultado->execute();

        $Convocatoria = null;

        if ($resultado) {
            $tuplas = $resultado->fetch(PDO::FETCH_OBJ);

            if ($tuplas) {
                $id_convocatoria = $tuplas->id_convocatoria;
                $num_movilidades = $tuplas->num_movilidades;
                $tipo = $tuplas->tipo;
                $fecha_inicio = $tuplas->fecha_inicio;
                $fecha_fin = $tuplas->fecha_fin;
                $fechainicioPruebas = $tuplas->fechaInicioPruebas;
                $fechafinPruebas = $tuplas->fechaFinPruebas;
                $fechaListadoProvisional = $tuplas->fechaListadoProvisional;
                $fechaListadoDefinitivo = $tuplas->fechaListadoDefinitivo;
                $codigo_proyecto = $tuplas->codigo_proyecto;
                $destino = $tuplas->pais_destino;
                $nombre = $tuplas->nombre;
                $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
                $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto, $destino, $nombre);
            }
        }

        return $Convocatoria;
    }

    public static function DeleteByID($id_convocatoria)
    {
        $conexion = CONEXION::AbreConexion();

        $resultado = $conexion->prepare("DELETE from CONVOCATORIAS where id_convocatoria=:id_convocatoria");
        $resultado->bindParam(":id_convocatoria", $id_convocatoria, PDO::PARAM_INT);
        $resultado->execute();
    }

    public static function UpdateByID($id_convocatoria, $objetoActualizado)
    {
        $conexion = CONEXION::AbreConexion();
        $num_movilidades = $objetoActualizado->getNumMovilidades();
        $tipo = $objetoActualizado->getTipo();
        $fecha_inicio = $objetoActualizado->getFechaInicio();
        $fecha_fin = $objetoActualizado->getFechaFin();
        $fechainicioPruebas = $objetoActualizado->getFechaInicioPruebas();
        $fechafinPruebas = $objetoActualizado->getFechaFinPruebas();
        $fechaListadoProvisional = $objetoActualizado->getFechaListadoProvisional();
        $fechaListadoDefinitivo = $objetoActualizado->getFechaListadoDefinitivo();
        $codigo_proyecto = $objetoActualizado->getProyecto()->getCodigoProyecto();
        $pais_destino = $objetoActualizado->getPais();
        $nombre = $objetoActualizado->getNombre();



        $resultado = $conexion->prepare("UPDATE CONVOCATORIAS set num_movilidades=:num_movilidades,tipo=upper(:tipo),fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,
                                        fechaInicioPruebas=:fechaInicioPruebas,fechaFinPruebas=:fechaFinPruebas,fechaListadoProvisional=:fechaListadoProvisional,
                                        fechaListadoDefinitivo=:fechaListadoDefinitivo,
                                        codigo_proyecto=:codigo_proyecto,pais_destino=:pais_destino,nombre=:nombre where id_convocatoria=:id_convocatoria");

        $resultado->bindParam(":num_movilidades", $num_movilidades, PDO::PARAM_INT);
        $resultado->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $resultado->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
        $resultado->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
        $resultado->bindParam(":fechaInicioPruebas", $fechainicioPruebas, PDO::PARAM_STR);
        $resultado->bindParam(":fechaFinPruebas", $fechafinPruebas, PDO::PARAM_STR);
        $resultado->bindParam(":fechaListadoProvisional", $fechaListadoProvisional, PDO::PARAM_STR);
        $resultado->bindParam(":fechaListadoDefinitivo", $fechaListadoDefinitivo, PDO::PARAM_STR);
        $resultado->bindParam(":codigo_proyecto", $codigo_proyecto, PDO::PARAM_STR);
        $resultado->bindParam(":id_convocatoria", $id_convocatoria, PDO::PARAM_INT);
        $resultado->bindParam(":pais_destino", $pais_destino, PDO::PARAM_STR);
        $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);

        $resultado->execute();
    }

    public static function Insert($objeto)
    {
        $conexion = CONEXION::AbreConexion();
        $num_movilidades = $objeto->getNumMovilidades();
        $tipo = $objeto->getTipo();
        $fecha_inicio = $objeto->getFechaInicio();
        $fecha_fin = $objeto->getFechaFin();
        $fechainicioPruebas = $objeto->getFechaInicioPruebas();
        $fechafinPruebas = $objeto->getFechaFinPruebas();
        $fechaListadoProvisional = $objeto->getFechaListadoProvisional();
        $fechaListadoDefinitivo = $objeto->getFechaListadoDefinitivo();
        $codigo_proyecto = $objeto->getProyecto()->getCodigoProyecto();
        $pais_destino = $objeto->getPais();
        $nombre = $objeto->getNombre();


        $resultado = $conexion->prepare("INSERT INTO CONVOCATORIAS (nombre,pais_destino,num_movilidades,tipo,fecha_inicio,fecha_fin,fechaInicioPruebas,fechaFinPruebas,fechaListadoProvisional,fechaListadoDefinitivo,codigo_proyecto) 
                                        values (:nombre,:pais_destino,:num_movilidades,upper(:tipo),:fecha_inicio,:fecha_fin,
                                        :fechaInicioPruebas,:fechaFinPruebas,:fechaListadoProvisional,:fechaListadoDefinitivo,:codigo_proyecto)");

        $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $resultado->bindParam(":pais_destino", $pais_destino, PDO::PARAM_STR);
        $resultado->bindParam(":num_movilidades", $num_movilidades, PDO::PARAM_INT);
        $resultado->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $resultado->bindParam(":fecha_inicio", $fecha_inicio, PDO::PARAM_STR);
        $resultado->bindParam(":fecha_fin", $fecha_fin, PDO::PARAM_STR);
        $resultado->bindParam(":fechaInicioPruebas", $fechainicioPruebas, PDO::PARAM_STR);
        $resultado->bindParam(":fechaFinPruebas", $fechafinPruebas, PDO::PARAM_STR);
        $resultado->bindParam(":fechaListadoProvisional", $fechaListadoProvisional, PDO::PARAM_STR);
        $resultado->bindParam(":fechaListadoDefinitivo", $fechaListadoDefinitivo, PDO::PARAM_STR);
        $resultado->bindParam(":codigo_proyecto", $codigo_proyecto, PDO::PARAM_STR);

        $resultado->execute();
    }

    public static function MostrarConvocatoriasPasadasFechAportacion(){
        $conexion = CONEXION::AbreConexion();
        $resultado=$conexion->prepare("SELECT * from CONVOCATORIAS where sysdate()>fechaInicioPruebas");
        $resultado->execute();

        $Convocatorias=null;
        $i=0;

        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $id_convocatoria = $tuplas->id_convocatoria;
            $num_movilidades = $tuplas->num_movilidades;
            $tipo = $tuplas->tipo;
            $fecha_inicio = $tuplas->fecha_inicio;
            $fecha_fin = $tuplas->fecha_fin;
            $fechainicioPruebas = $tuplas->fechaInicioPruebas;
            $fechafinPruebas = $tuplas->fechaFinPruebas;
            $fechaListadoProvisional = $tuplas->fechaListadoProvisional;
            $fechaListadoDefinitivo = $tuplas->fechaListadoDefinitivo;
            $codigo_proyecto = $tuplas->codigo_proyecto;
            $destino = $tuplas->pais_destino;
            $nombre = $tuplas->nombre;
            $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
            $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto, $destino, $nombre);
            $Convocatorias[] = $Convocatoria;
            $i++;
        }

        return $Convocatorias;

    }

    public static function BuscaConvocatoriasActivas($DNI)
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("select c.* from CONVOCATORIAS c
        inner join DESTINATARIOS_CONVOCATORIAS dc on dc.id_convocatoria=c.id_convocatoria
        inner join CANDIDATOS ca on ca.curso=dc.id_destinatario_convocatoria
        where ca.DNI='33680662Z' and  c.fecha_inicio<=sysdate() and c.fecha_fin>=sysdate()");
        $resultado->execute();

        $Convocatorias = null;

        $i = 0;


        if ($resultado) {
            $tuplas = $resultado->fetch(PDO::FETCH_OBJ);

            if ($tuplas) {
                $id_convocatoria = $tuplas->id_convocatoria;
                $num_movilidades = $tuplas->num_movilidades;
                $tipo = $tuplas->tipo;
                $fecha_inicio = $tuplas->fecha_inicio;
                $fecha_fin = $tuplas->fecha_fin;
                $fechainicioPruebas = $tuplas->fechaInicioPruebas;
                $fechafinPruebas = $tuplas->fechaFinPruebas;
                $fechaListadoProvisional = $tuplas->fechaListadoProvisional;
                $fechaListadoDefinitivo = $tuplas->fechaListadoDefinitivo;
                $codigo_proyecto = $tuplas->codigo_proyecto;
                $destino = $tuplas->pais_destino;
                $nombre = $tuplas->nombre;
                $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
                $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto, $destino, $nombre);
                $Convocatorias[] = $Convocatoria;
                $i++;
            }
        }

        return $Convocatorias;
    }

    public static function sacarID()
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("select last_insert_id() as id");
        $resultado->execute();

        $Convocatorias = null;

        $id = 0;


        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $id = $tuplas->id;
        }

        return $id;
    }

    public static function Transaccion(
        $proyecto,
        $fechainicio,
        $fechafin,
        $movilidades,
        $fechainicioPruebas,
        $fechafinPruebas,
        $fechalistadoprovisional,
        $fechalistadodefinitivo,
        $destino,
        $nombre,
        $baremo,
        $desti,
        $maximas,
        $requisitos,
        $minimas,
        $aportas,
        $idioma
    ){
        try{
            $conexion=CONEXION::AbreConexion();
            echo '<p style="margin-left: 50%;">PEPE</p>';
            $conexion->beginTransaction();
            $Proyecto = BD_PROYECTO::FindByNombre($proyecto);
            $tipo = "";
            $fechaini = new DateTime($fechainicio);
            $fechaf = new DateTime($fechafin);
            $diff = $fechaf->diff($fechaini);
            $dias = $diff->days;
            if ($dias >= 90) {
                $tipo = "Larga";
            } else {
                $tipo = "Corta";
            }

            $convocatoria = new CONVOCATORIA(null, $movilidades, $tipo, $fechainicio, $fechafin, $fechainicioPruebas, $fechafinPruebas, $fechalistadoprovisional, $fechalistadodefinitivo, $Proyecto, $destino, $nombre);
            BD_CONVOCATORIA::Insert($convocatoria);

            $id = BD_CONVOCATORIA::sacarID();

            $convocatoria->setID($id);

            for ($i = 0; $i < count($baremo); $i++) {
                $baremoelegido = $baremo[$i];
                if ($baremoelegido->getNombre() !== "Idioma") {
                    $convocatoria_baremable = new CONVOCATORIA_BAREMABLE(null, $convocatoria, $baremoelegido, $maximas[$i], $requisitos[$i], $minimas[$i], $aportas[$i]);
                    BD_CONVOCATORIA_BAREMABLE::Insert($convocatoria_baremable);
                }
            }

            for ($i = 0; $i < count($desti); $i++) {
                $destielegido = $desti[$i];
                $destinatario_conv = new DESTINATARIO_CONVOCATORIA(null, $convocatoria, $destielegido);
                BD_DESTINATARIOS_CONVOCATORIAS::Insert($destinatario_conv);
            }

            if ($idioma!=null){
                $errores=0;
                $niveles=BD_IDIOMA::FindAll();
                for ($i=0;$i<count($niveles);$i++){
                    if (isset($_POST['notaidioma'.$i])&&$_POST['notaidioma'.$i]>0){
                        $nota= (int)$_POST['notaidioma'.$i];
                        $convocatoria_baremo_idioma=new CONVOCATORIA_BAREMABLE_IDIOMA(null,$convocatoria,$niveles[$i],$idioma,$nota);
                        BD_CONVOCATORIA_BAREMABLE_IDIOMA::Insert($convocatoria_baremo_idioma);
                    }else{
                        $errores++;
                    }
                }

                if ($errores!==0){
                    echo "Error";
                    $conexion->rollBack();
                }else{
                    echo "<p>Convocatoria insertada correctamente</p>";
                    $conexion->commit();
                }
            }
        }catch (Exception $e){
            $conexion->rollBack();
            echo "Error: " . $e->getMessage();
        }
    }

    
}
