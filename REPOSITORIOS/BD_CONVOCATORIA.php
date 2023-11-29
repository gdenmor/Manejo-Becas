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
            $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
            $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto);
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
                $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
                $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto);
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
        $fechainicioPruebas = $objetoActualizado->getFechaInicioBaremacion();
        $fechafinPruebas = $objetoActualizado->getFechaFinBaremacion();
        $fechaListadoProvisional = $objetoActualizado->getFechaInicioListadoProvisional();
        $fechaListadoDefinitivo = $objetoActualizado->getFechaInicioListadoDefinitivo();
        $codigo_proyecto = $objetoActualizado->getProyecto()->getCodigoProyecto();



        $resultado = $conexion->prepare("UPDATE CONVOCATORIAS set num_movilidades=:num_movilidades,tipo=upper(:tipo),fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,
                                        fechaInicioPruebas=:fechaInicioPruebas,fechaFinPruebas=:fechaFinPruebas,fechaListadoProvisional=:fechaListadoProvisional,
                                        fechaListadoDefinitivo=:fechaListadoDefinitivo,
                                        codigo_proyecto=:codigo_proyecto where id_convocatoria=:id_convocatoria");

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

    public static function Insert($objeto)
    {
        $conexion = CONEXION::AbreConexion();
        $num_movilidades = $objeto->getNumMovilidades();
        $tipo = $objeto->getTipo();
        $fecha_inicio = $objeto->getFechaInicio();
        $fecha_fin = $objeto->getFechaFin();
        $fechainicioPruebas = $objeto->getFechaInicioBaremacion();
        $fechafinPruebas = $objeto->getFechaFinBaremacion();
        $fechaListadoProvisional = $objeto->getFechaInicioListadoProvisional();
        $fechaListadoDefinitivo = $objeto->getFechaInicioListadoDefinitivo();
        $codigo_proyecto = $objeto->getProyecto()->getCodigoProyecto();


        $resultado = $conexion->prepare("INSERT INTO CONVOCATORIAS (num_movilidades,tipo,fecha_inicio,fecha_fin,fechaInicioPruebas,fechaFinPruebas,fechaListadoProvisional,fechaListadoDefinitivo,codigo_proyecto) 
                                        values (:num_movilidades,upper(:tipo),:fecha_inicio,:fecha_fin,
                                        :fechaInicioPruebas,:fechaFinPruebas,:fechaListadoProvisional,:fechaListadoDefinitivo,:codigo_proyecto)");

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

    public static function BuscaConvocatoriasActivas()
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * FROM CONVOCATORIAS WHERE fecha_inicio>=sysdate() and fecha_fin<=sysdate()");
        $resultado->execute();

        $Convocatorias = null;

        $i=0;


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
                $Proyecto = BD_PROYECTO::FindByID($codigo_proyecto);
                $Convocatoria = new CONVOCATORIA($id_convocatoria, $num_movilidades, $tipo, $fecha_inicio, $fecha_fin, $fechainicioPruebas, $fechafinPruebas, $fechaListadoProvisional, $fechaListadoDefinitivo, $Proyecto);
                $Convocatorias[] = $Convocatoria;
                $i++;
            }
        }

        return $Convocatorias;
    }

}
