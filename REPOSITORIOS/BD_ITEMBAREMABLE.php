<?php
    class BD_ITEMBAREMABLE{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from ITEM_BAREMABLE");
            $resultado->execute();

            $Items_Baremables=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id_item=$tuplas->id_item;
                $nombre=$tuplas->nombre;
                $Item=new ITEM_BAREMABLE($id_item,$nombre);
                $Items_Baremables[]=$Item;
                $i++;
            }

            return $Items_Baremables;
        }

        public static function FindByID($id_item){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM ITEM_BAREMABLE WHERE id_item=:id_item");
            $resultado->bindParam(':id_item', $id_item, PDO::PARAM_INT);
            $resultado->execute();
        
            $Item = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $id_item=$tuplas->id_item;
                    $nombre=$tuplas->nombre;
                    $Item=new ITEM_BAREMABLE($id_item,$nombre);
                }
            }
        
            return $Item;
        }

        public static function DeleteByID($id_item){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from ITEM_BAREMABLE where id_item=:id_item");
            $resultado->bindParam(":id_item",$id_item,PDO::PARAM_INT);
            $resultado->execute();
        }

        public static function UpdateByID($id_item,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $nombre=$objetoActualizado->getNombre();
            
            

            $resultado=$conexion->prepare("UPDATE ITEM_BAREMABLE set nombre=upper(:nombre) where id_item=:id_item");
            $resultado->bindParam(":id_item",$id_item,PDO::PARAM_INT);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $nombre=$objeto->getNombre();
            

            $resultado=$conexion->prepare("INSERT INTO ITEM_BAREMABLE (nombre) values (upper(:nombre))");
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);

            $resultado->execute();
        }
    }
?>