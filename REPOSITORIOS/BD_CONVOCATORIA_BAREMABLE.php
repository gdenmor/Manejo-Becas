<?php
    class BD_CONVOCATORIA_BAREMABLE{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from CONVOCATORIA_BAREMABLE");
            $resultado->execute();

            $Convocatorias_Baremables=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id_convocatoria_baremable=$tuplas->id_convocatoria_baremable;
                $id_convocatoria=$tuplas->id_convocatoria;
                $convocatoria=BD_CONVOCATORIA::FindByID($id_convocatoria);
                $id_baremo=$tuplas->id_baremo;
                $baremo=BD_ITEMBAREMABLE::FindByID($id_baremo);
                $maximo=$tuplas->maximo;
                $requisito=$tuplas->requisito;
                $minimo=$tuplas->minimo;
                $aportaalumno=$tuplas->aportaalumno;
                $Convocatoria_Baremable=new CONVOCATORIA_BAREMABLE($id_convocatoria_baremable,$convocatoria,$baremo,$maximo,$requisito,$minimo,$aportaalumno);
                $Convocatorias_Baremables[]=$Convocatoria_Baremable;
                $i++;
            }

            return $Convocatorias_Baremables;
        }

        public static function FindByID($id_convocatoria_baremable){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM CONVOCATORIA_BAREMABLE WHERE id_convocatoria_baremable=:id_convocatoria_baremable");
            $resultado->bindParam(':id_convocatoria_baremable', $id_convocatoria_baremable, PDO::PARAM_INT);
            $resultado->execute();
        
            $Convocatoria_Baremable = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $id_convocatoria_baremable=$tuplas->id_convocatoria_baremable;
                    $id_convocatoria=$tuplas->id_convocatoria;
                    $convocatoria=BD_CONVOCATORIA::FindByID($id_convocatoria);
                    $id_baremo=$tuplas->id_baremo;
                    $baremo=BD_ITEMBAREMABLE::FindByID($id_baremo);
                    $maximo=$tuplas->maximo;
                    $requisito=$tuplas->requisito;
                    $minimo=$tuplas->minimo;
                    $aportaalumno=$tuplas->aportaalumno;
                    $Convocatoria_Baremable=new CONVOCATORIA_BAREMABLE($id_convocatoria_baremable,$convocatoria,$baremo,$maximo,$requisito,$minimo,$aportaalumno);
                }
            }
        
            return $Convocatoria_Baremable;
        }

        public static function DeleteByID($id_convocatoria_baremable){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from CONVOCATORIA_BAREMABLE where id_convocatoria_baremable=:id_convocatoria_baremable");
            $resultado->bindParam(":id_convocatoria_baremable",$id_convocatoria_baremable,PDO::PARAM_INT);
            $resultado->execute();
        }

        public static function UpdateByID($id_convocatoria_baremable,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $id_convocatoria=$objetoActualizado->getConvocatoria()->getIdConvocatoria();
            $id_baremo=$objetoActualizado->getBaremo()->getID_Item();
            $maximo=$objetoActualizado->getMaximo();
            $requisito=$objetoActualizado->getRequisito();
            $minimo=$objetoActualizado->getMinimo();
            $aportaalumno=$objetoActualizado->getAportaAlumno();
            
            

            $resultado=$conexion->prepare("UPDATE CONVOCATORIA_BAREMABLE set id_convocatoria=:id_convocatoria,id_baremo=:id_baremo,maximo=:maximo,requisito=:requisito,minimo=:minimo,aportaalumno=:aportaalumno where id_convocatoria_baremable=:id_convocatoria_baremable");
            $resultado->bindParam(":id_convocatoria_baremable",$id_convocatoria_baremable,PDO::PARAM_INT);
            $resultado->bindParam(":id_baremo",$id_baremo,PDO::PARAM_INT);
            $resultado->bindParam(":maximo",$maximo,PDO::PARAM_INT);
            $resultado->bindParam(":requisito",$requisito,PDO::PARAM_BOOL);
            $resultado->bindParam(":minimo",$minimo,PDO::PARAM_INT);
            $resultado->bindParam(":aportaalumno",$aportaalumno,PDO::PARAM_BOOL);
            $resultado->bindParam(":id_convocatoria",$id_convocatoria,PDO::PARAM_INT);
            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $id_convocatoria=$objeto->getConvocatoria()->getIdConvocatoria();
            $id_baremo=$objeto->getBaremo()->getID_Item();
            $maximo=$objeto->getMaximo();
            $requisito=$objeto->getRequisito();
            $minimo=$objeto->getMinimo();
            $aportaalumno=$objeto->getAportaAlumno();
            
            

            $resultado=$conexion->prepare("INSERT INTO CONVOCATORIA_BAREMABLE(id_convocatoria,id_baremo,maximo,requisito,minimo,aportaalumno) values (:id_convocatoria,:id_baremo,:maximo,:requisito,:minimo,:aportaalumno)");
            $resultado->bindParam(":id_baremo",$id_baremo,PDO::PARAM_INT);
            $resultado->bindParam(":maximo",$maximo,PDO::PARAM_INT);
            $resultado->bindParam(":requisito",$requisito,PDO::PARAM_BOOL);
            $resultado->bindParam(":minimo",$minimo,PDO::PARAM_INT);
            $resultado->bindParam(":aportaalumno",$aportaalumno,PDO::PARAM_BOOL);
            $resultado->bindParam(":id_convocatoria",$id_convocatoria,PDO::PARAM_INT);
            $resultado->execute();
        }
    }
?>