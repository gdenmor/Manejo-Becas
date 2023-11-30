<?php
    class BD_PROYECTO{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from PROYECTOS");
            $resultado->execute();

            $Proyectos=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $codigo_proyecto=$tuplas->codigo_proyecto;
                $nombre=$tuplas->nombre;
                $fecha_inicio=$tuplas->fecha_inicio;
                $fecha_fin=$tuplas->fecha_fin;
                $Proyecto=new PROYECTO($codigo_proyecto,$nombre,$fecha_inicio,$fecha_fin);
                $Proyectos[]=$Proyecto;
                $i++;
            }

            return $Proyectos;
        }

        public static function FindByNombre($nombre){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM PROYECTOS WHERE nombre=:nombre");
            $resultado->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $resultado->execute();
        
            $Proyecto = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $nombre=$tuplas->nombre;
                    $codigo_proyecto=$tuplas->codigo_proyecto;
                    $fecha_inicio=$tuplas->fecha_inicio;
                    $fecha_fin=$tuplas->fecha_fin;
                    $Proyecto=new PROYECTO($codigo_proyecto,$nombre,$fecha_inicio,$fecha_fin);
                }
            }
        
            return $Proyecto;
        }

        public static function FindByID($codigo_proyecto){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM PROYECTOS WHERE codigo_proyecto=:codigo_proyecto");
            $resultado->bindParam(':codigo_proyecto', $codigo_proyecto, PDO::PARAM_STR);
            $resultado->execute();
        
            $Proyecto = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $nombre=$tuplas->nombre;
                    $codigo_proyecto=$tuplas->codigo_proyecto;
                    $fecha_inicio=$tuplas->fecha_inicio;
                    $fecha_fin=$tuplas->fecha_fin;
                    $Proyecto=new PROYECTO($codigo_proyecto,$nombre,$fecha_inicio,$fecha_fin);
                }
            }
        
            return $Proyecto;
        }

        public static function DeleteByID($codigo_proyecto){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from PROYECTOS where codigo_proyecto=:codigo_proyecto");
            $resultado->bindParam(":codigo_proyecto",$codigo_proyecto,PDO::PARAM_STR);
            $resultado->execute();
        }

        public static function UpdateByID($codigo_proyecto,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $nombre=$objetoActualizado->getNombre();
            $fecha_inicio=$objetoActualizado->getFechaInicio();
            $fecha_fin=$objetoActualizado->getFechaFin();
            
            

            $resultado=$conexion->prepare("UPDATE CANDIDATOS set nombre=upper(:nombre),fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin where codigo_proyecto=:codigo_proyecto");
            $resultado->bindParam(":codigo_proyecto",$codigo_proyecto,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_inicio",$fecha_inicio,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_fin",$fecha_fin,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $nombre=$objeto->getNombre();
            $fecha_inicio=$objeto->getFechaInicio();
            $fecha_fin=$objeto->getFechaFin();
            $codigo_proyecto=$objeto->getCodigoProyecto();
            

            $resultado=$conexion->prepare("INSERT INTO CANDIDATOS (codigo_proyecto,nombre,fecha_inicio,fecha_fin) values (upper(:codigo_proyecto),upper(:nombre),:fecha_inicio,:fecha_fin)");
            $resultado->bindParam(":codigo_proyecto",$codigo_proyecto,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_inicio",$fecha_inicio,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_fin",$fecha_fin,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);

            $resultado->execute();
        }
    }


?>