<?php
    require_once "../Manejo-Becas/ENTIDADES/TUTOR_LEGAL.php";
    class BD_TUTORLEGAL{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from CANDIDATOS");
            $resultado->execute();

            $array=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $DNI=$tuplas->DNI;
                $fecha_nacimiento=$tuplas->fecha_nacimiento;
                $tutor_dni=$tuplas->tutor_dni;
                $tutor=BD_TUTORLEGAL::FindByID($tutor_dni);
                $apellido1=$tuplas->apellido1;
                $apellido2=$tuplas->apellido2;
                $nombre=$tuplas->nombre;
                $contraseña=$tuplas->contraseña;
                $curso=$tuplas->curso;
                $tlf=$tuplas->tlf;
                $correo=$tuplas->correo;
                $domicilio=$tuplas->domicilio;
                //MODIFICAR EL OBJETO
                $Tutor=new TutorLegal($DNI,$apellido1,$apellido2,$nombre,$domicilio,$tlf);
                $array[$i]=$Tutor;
                $i++;
            }

            

            return $array;
        }

        public static function FindByID($DNI){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM TUTOR_LEGAL WHERE DNI=:DNI");
            $resultado->bindParam(':DNI', $DNI, PDO::PARAM_STR);
            $resultado->execute();
        
            $Tutor = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $DNI=$tuplas->DNI;
                    $apellido1=$tuplas->apellido1;
                    $apellido2=$tuplas->apellido2;
                    $nombre=$tuplas->nombre;
                    $domicilio=$tuplas->domicilio;
                    $tlf=$tuplas->tlf;
                    $Tutor=new TutorLegal($DNI,$apellido1,$apellido2,$nombre,$domicilio,$tlf);
                }
            }
        
            return $Tutor;
        }

        public static function DeleteByID($DNI){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from TUTOR_LEGAL where DNI=:DNI");
            $resultado->bindParam(":DNI",$DNI,PDO::PARAM_STR);
            $resultado->execute();
        }

        public static function UpdateByID($DNI,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $apellido1=$objetoActualizado->getApellido1();
            $apellido2=$objetoActualizado->getApellido2();
            $nombre=$objetoActualizado->getNombre();
            $domicilio=$objetoActualizado->getDomicilio();
            $tlf=$objetoActualizado->getTlf();
            

            $resultado=$conexion->prepare("UPDATE TUTOR_LEGAL set apellido1=upper(:apellido1),apellido2=upper(:apellido2),nombre=upper(:nombre),domicilio=upper(:domicilio),tlf=upper(:tlf) where DNI=:DNI");
            $resultado->bindParam(":apellido1",$apellido1,PDO::PARAM_STR);
            $resultado->bindParam(":apellido2",$apellido2,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $resultado->bindParam(":domicilio",$domicilio,PDO::PARAM_STR);
            $resultado->bindParam(":tlf",$tlf,PDO::PARAM_STR);
            $resultado->bindParam(":DNI",$DNI,PDO::PARAM_STR);
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $apellido1=$objeto->getApellido1();
            $apellido2=$objeto->getApellido2();
            $nombre=$objeto->getNombre();
            $domicilio=$objeto->getDomicilio();
            $tlf=$objeto->getTlf();
            $DNI=$objeto->getDNI();
            

            $resultado=$conexion->prepare("INSERT INTO TUTOR_LEGAL (DNI,apellido1,apellido2,nombre,domicilio,tlf) values (upper(:apellido1),upper(:apellido2),upper(:nombre),upper(:domicilio),upper(:tlf))");
            $resultado->bindParam(":apellido1",$apellido1,PDO::PARAM_STR);
            $resultado->bindParam(":apellido2",$apellido2,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $resultado->bindParam(":domicilio",$domicilio,PDO::PARAM_STR);
            $resultado->bindParam(":tlf",$tlf,PDO::PARAM_STR);
            $resultado->bindParam(":DNI",$DNI,PDO::PARAM_STR);
            $resultado->execute();
        }
    }


?>