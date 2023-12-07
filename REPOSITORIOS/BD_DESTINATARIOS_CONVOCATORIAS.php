<?php
    class BD_DESTINATARIOS_CONVOCATORIAS{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from DESTINATARIOS_CONVOCATORIAS");
            $resultado->execute();

            $Destinatarios_Convocatorias=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id_destinatario_convocatoria=$tuplas->id_destinatario_convocatoria;
                $id_convocatoria=$tuplas->id_convocatoria;
                $id_destinatario=$tuplas->id_destinatario;
                $convocatoria=BD_CONVOCATORIA::FindByID($id_convocatoria);
                $Destinatario=BD_DESTINATARIOS::FindByID($id_destinatario);
                $Destinatario_Convocatoria=new Destinatario_Convocatoria($id_destinatario_convocatoria,$convocatoria,$Destinatario);
                $Destinatarios_Convocatorias[]=$Destinatario_Convocatoria;
                $i++;
            }

            return $Destinatarios_Convocatorias;
        }

        public static function FindByID($id_destinatario_convocatoria){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM DESTINATARIOS_CONVOCATORIAS WHERE id_destinatario_convocatoria=:id_destinatario_convocatoria");
            $resultado->bindParam(':id_destinatario_convocatoria', $id_destinatario_convocatoria, PDO::PARAM_INT);
            $resultado->execute();
        
            $Destinatario_Convocatoria = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $id_convocatoria=$tuplas->id_convocatoria;
                    $id_destinatario=$tuplas->codigo_grupo;
                    $convocatoria=BD_CONVOCATORIA::FindByID($id_convocatoria);
                    $Destinatario=BD_DESTINATARIOS::FindByID($id_destinatario);
                    $Destinatario_Convocatoria=new Destinatario_Convocatoria($id_destinatario_convocatoria,$convocatoria,$Destinatario);
                }
            }
        
            return $Destinatario_Convocatoria;
        }

        public static function DeleteByID($id_destinatario_convocatoria){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from DESTINATARIOS_CONVOCATORIAS WHERE id_destinatario_convocatoria=:id_destinatario_convocatoria");
            $resultado->bindParam(':id_destinatario_convocatoria', $id_destinatario_convocatoria, PDO::PARAM_INT);
            $resultado->execute();
        }

        public static function UpdateByID($id_destinatario_convocatoria,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $id_convocatoria=$objetoActualizado->getConvocatoria()->getIdConvocatoria();
            $codigo_grupo=$objetoActualizado->getDestinatario()->getCodigoGrupo();
            

            $resultado=$conexion->prepare("UPDATE DESTINATARIOS_CONVOCATORIAS set id_convocatoria=:id_convocatoria,codigo_grupo=:codigo_grupo where id_destinatario_convocatoria=:id_destinatario_convocatoria");
            $resultado->bindParam(':id_destinatario_convocatoria', $id_destinatario_convocatoria, PDO::PARAM_INT);
            $resultado->bindParam(":id_convocatoria",$id_convocatoria,PDO::PARAM_INT);
            $resultado->bindParam(":codigo_grupo",$codigo_grupo,PDO::PARAM_STR);
            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $codigo_grupo=$objeto->getDestinatario()->getCodigoGrupo();
            $id_convocatoria=$objeto->getConvocatoria()->getIdConvocatoria();
            

            $resultado=$conexion->prepare("INSERT INTO DESTINATARIOS_CONVOCATORIAS (id_convocatoria,codigo_grupo) values (:id_convocatoria,:codigo_grupo)");
            $resultado->bindParam(":id_convocatoria",$id_convocatoria,PDO::PARAM_INT);
            $resultado->bindParam(":codigo_grupo",$codigo_grupo,PDO::PARAM_STR);
            
            $resultado->execute();
        }
    }
?>