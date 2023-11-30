<?php
    class BD_IDIOMA{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from NIVEL_IDIOMA");
            $resultado->execute();

            $Idiomas=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id_idioma=$tuplas->id_idioma;
                $nivel=$tuplas->titulo;
                $Idioma=new NIVEL_IDIOMA($nivel,$id_idioma,);
                $Idiomas[]=$Idioma;
                $i++;
            }

            return $Idiomas;
        }

        public static function FindByID($id_idioma){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM NIVEL_IDIOMA WHERE id_idioma=:id_idioma");
            $resultado->bindParam(':id_idioma', $id_idioma, PDO::PARAM_INT);
            $resultado->execute();
        
            $Item = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $nivel=$tuplas->nivel;
                    $Idioma=new NIVEL_IDIOMA($id_idioma,$nivel);
                }
            }
        
            return $Item;
        }

        public static function DeleteByID($id_idioma){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from NIVEL_IDIOMA where id_idioma=:id_idioma");
            $resultado->bindParam(":id_idioma",$id_idioma,PDO::PARAM_INT);
            $resultado->execute();
        }

        public static function UpdateByID($id_idioma,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $nivel=$objetoActualizado->getTitulo();
            
            

            $resultado=$conexion->prepare("UPDATE NIVEL_IDIOMA set titulo=upper(:titulo) where id_idioma=:id_idioma");
            $resultado->bindParam(":id_idioma",$id_idioma,PDO::PARAM_INT);
            $resultado->bindParam(":titulo",$nivel,PDO::PARAM_STR);
            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $nivel=$objeto->getTitulo();
            

            $resultado=$conexion->prepare("INSERT INTO NIVEL_IDIOMA (nivel) values (upper(:nivel))");
            $resultado->bindParam(":nombre",$nivel,PDO::PARAM_STR);

            $resultado->execute();
        }
    }
?>