<?php
    class BD_DESTINATARIOS{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from DESTINATARIOS");
            $resultado->execute();

            $Destinatarios=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $codigo_grupo=$tuplas->codigo_grupo;
                $nombre=$tuplas->nombre;
                $Destinatario=new Destinatario($codigo_grupo,$nombre);
                $Destinatarios[]=$Destinatario;
                $i++;
            }

            return $Destinatarios;
        }

        public static function FindByID($codigo_grupo){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM DESTINATARIOS WHERE codigo_grupo=:codigo_grupo");
            $resultado->bindParam(':codigo_grupo', $codigo_grupo, PDO::PARAM_INT);
            $resultado->execute();
        
            $Destinatario = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $nombre=$tuplas->nombre;
                    $Destinatario=new Destinatario($codigo_grupo,$nombre);
                }
            }
        
            return $Destinatario;
        }

        public static function DeleteByID($codigo_grupo){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from DESTINATARIOS where codigo_grupo=:codigo_grupo");
            $resultado->bindParam(":codigo_grupo",$codigo_grupo,PDO::PARAM_INT);
            $resultado->execute();
        }

        public static function UpdateByID($codigo_grupo,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $nombre=$objetoActualizado->getNombre();
            

            $resultado=$conexion->prepare("UPDATE DESTINATARIOS set nombre=upper(:nombre) where codigo_grupo=:codigo_grupo)");
            $resultado->bindParam(":codigo_grupo",$codigo_grupo,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $codigo_grupo=$objeto->getCodigoGrupo();
            $nombre=$objeto->getNombre();
            

            $resultado=$conexion->prepare("INSERT INTO DESTINATARIOS (codigo_grupo,nombre) values (upper(:codigo_grupo),upper(:nombre))");
            $resultado->bindParam(":codigo_grupo",$codigo_grupo,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            
            $resultado->execute();
        }
    }

?>