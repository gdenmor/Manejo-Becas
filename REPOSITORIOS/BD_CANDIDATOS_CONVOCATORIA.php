<?php
    class BD_CANDIDATOS_CONVOCATORIA{
        public static function FindAll(){
            $conexion=CONEXION::AbreConexion();
            $resultado=$conexion->prepare("SELECT * from CANDIDATOS_CONVOCATORIA");
            $resultado->execute();

            $Candidatos_Convocatorias=null;

            $i=0;


            while ($tuplas=$resultado->fetch(PDO::FETCH_OBJ)) {
                $id_candidato_convocatoria=$tuplas->id_candidato_convocatoria;
                $id_convocatoria=$tuplas->id_convocatoria;
                $DNI=$tuplas->DNI;
                $fecha_nacimiento=$tuplas->fecha_nacimiento;
                $tutor_dni=$tuplas->tutor_dni;
                $tutor_legal=BD_TUTORLEGAL::FindByID($tutor_dni);
                $apellido1=$tuplas->apellido1;
                $apellido2=$tuplas->apellido2;
                $nombre=$tuplas->nombre;
                $contraseña=$tuplas->contraseña;
                $curso=$tuplas->curso;
                $tlf=$tuplas->tlf;
                $correo=$tuplas->correo;
                $domicilio=$tuplas->domicilio;
                $rol=$tuplas->rol;
                $Candidato_Convocatoria=new CANDIDATOS_CONVOCATORIA($id_candidato_convocatoria,$id_convocatoria,$DNI,$fecha_nacimiento,$tutor_legal,$apellido1,$apellido2,$nombre,$contraseña,$curso,$tlf,$correo,$domicilio,$rol);
                $Candidatos_Convocatorias[]=$Candidato_Convocatoria;
                $i++;
            }

            return $Candidatos_Convocatorias;
        }

        public static function FindByID($id_candidato_convocatoria){
            $conexion = CONEXION::AbreConexion();
            $resultado = $conexion->prepare("SELECT * FROM CANDIDATOS_CONVOCATORIA WHERE id_candidato_convocatoria=:id_candidato_convocatoria");
            $resultado->bindParam(':id_convocatoria', $id_candidato_convocatoria, PDO::PARAM_INT);
            $resultado->execute();
        
            $Candidato_Convocatoria = null;
        
            if ($resultado) {
                $tuplas = $resultado->fetch(PDO::FETCH_OBJ);
        
                if ($tuplas) {
                    $id_convocatoria=$tuplas->id_convocatoria;
                    $DNI=$tuplas->DNI;
                    $fecha_nacimiento=$tuplas->fecha_nacimiento;
                    $tutor_dni=$tuplas->tutor_dni;
                    $tutor_legal=BD_TUTORLEGAL::FindByID($tutor_dni);
                    $apellido1=$tuplas->apellido1;
                    $apellido2=$tuplas->apellido2;
                    $nombre=$tuplas->nombre;
                    $contraseña=$tuplas->contraseña;
                    $curso=$tuplas->curso;
                    $tlf=$tuplas->tlf;
                    $correo=$tuplas->correo;
                    $domicilio=$tuplas->domicilio;
                    $rol=$tuplas->rol;
                    $Candidato_Convocatoria=new CANDIDATOS_CONVOCATORIA($id_candidato_convocatoria,$id_convocatoria,$DNI,$fecha_nacimiento,$tutor_legal,$apellido1,$apellido2,$nombre,$contraseña,$curso,$tlf,$correo,$domicilio,$rol);
                }
            }
        
            return $Candidato_Convocatoria;
        }

        public static function DeleteByID($id_candidato_convocatoria){
            $conexion=CONEXION::AbreConexion();

            $resultado=$conexion->prepare("DELETE from CANDIDATO_CONVOCATORIA where id_candidato_convocatoria=:id_candidato_convocatoria");
            $resultado->bindParam(":id_candidato_convocatoria",$id_candidato_convocatoria,PDO::PARAM_INT);
            $resultado->execute();
        }

        public static function UpdateByID($id_candidato_convocatoria,$objetoActualizado){
            $conexion=CONEXION::AbreConexion();
            $fecha_nacimiento=$objetoActualizado->getFechaNacimiento();
            $DNI_tutor_legal=$objetoActualizado->getTutorLegal()->getDNI();
            $apellido1=$objetoActualizado->getApellido1();
            $apellido2=$objetoActualizado->getApellido2();
            $nombre=$objetoActualizado->getNombre();
            $contraseña=$objetoActualizado->getContraseña();
            $curso=$objetoActualizado->getCurso();
            $domicilio=$objetoActualizado->getDomicilio();
            $tlf=$objetoActualizado->getTlf();
            $correo=$objetoActualizado->getCorreo();
            $rol=$objetoActualizado->getRol();
            $DNI=$objetoActualizado->getDNI();
            $id_convocatoria=$objetoActualizado->getConvocatoria()->getIdConvocatoria();
            

            $resultado=$conexion->prepare("UPDATE CANDIDATOS_CONVOCATORIA set id_convocatoria=:id_convocatoria,DNI=:DNI,apellido1=upper(:apellido1),apellido2=upper(:apellido2),nombre=upper(:nombre),domicilio=upper(:domicilio),tlf=upper(:tlf),fecha_nacimiento=(:fecha_nacimiento),tutor_dni=upper(:DNI_tutor),contraseña=upper(:contraseña),curso=upper(:curso),correo=upper(:correo),rol=upper(:rol) where id_candidato_convocatoria=:id_candidato_convocatoria");
            $resultado->bindParam(":apellido1",$apellido1,PDO::PARAM_STR);
            $resultado->bindParam(":apellido2",$apellido2,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $resultado->bindParam(":domicilio",$domicilio,PDO::PARAM_STR);
            $resultado->bindParam(":tlf",$tlf,PDO::PARAM_STR);
            $resultado->bindParam(":DNI_tutor",$DNI_tutor_legal,PDO::PARAM_STR);
            $resultado->bindParam(":contraseña",$contraseña,PDO::PARAM_STR);
            $resultado->bindParam(":curso",$curso,PDO::PARAM_STR);
            $resultado->bindParam(":correo",$correo,PDO::PARAM_STR);
            $resultado->bindParam(":domicilio",$domicilio,PDO::PARAM_STR);
            $resultado->bindParam(":tlf",$tlf,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_nacimiento",$fecha_nacimiento,PDO::PARAM_STR);
            $resultado->bindParam(":DNI",$DNI,PDO::PARAM_STR);
            $resultado->bindParam(":rol",$rol,PDO::PARAM_STR);
            $resultado->bindParam(":id_candidato_convocatoria",$id_candidato_convocatoria,PDO::PARAM_INT);
            $resultado->bindParam(":id_convocatoria",$id_convocatoria,PDO::PARAM_INT);

            
            $resultado->execute();
        }

        public static function Insert($objeto){
            $conexion=CONEXION::AbreConexion();
            $fecha_nacimiento=$objeto->getFechaNacimiento();
            $DNI_tutor_legal="";
            if ($objeto->getTutorLegal()!==null){
                $DNI_tutor_legal=$objeto->getTutorLegal()->getDNI();
            }
            $apellido1=$objeto->getApellido1();
            $apellido2=$objeto->getApellido2();
            $nombre=$objeto->getNombre();
            $contraseña=$objeto->getContraseña();
            $curso=$objeto->getCurso();
            $domicilio=$objeto->getDomicilio();
            $tlf=$objeto->getTlf();
            $correo=$objeto->getCorreo();
            $rol=$objeto->getRol();
            $DNI=$objeto->getDNI();
            $id_convocatoria=$objeto->getConvocatoria()->getIdConvocatoria();
            

            $resultado=$conexion->prepare("INSERT INTO CANDIDATOS_CONVOCATORIA (id_convocatoria,DNI,fecha_nacimiento,tutor_dni,apellido1,apellido2,nombre,contrasena,curso,tlf,correo,domicilio,rol) values (:id_convocatoria,upper(:DNI),:fecha_nacimiento,upper(:DNI_tutor),upper(:apellido1),upper(:apellido2),upper(:nombre),upper(:contrasena),upper(:curso),upper(:tlf),upper(:correo),upper(:domicilio),upper(:rol))");
            $resultado->bindParam(":id_convocatoria",$id_convocatoria,PDO::PARAM_INT);
            $resultado->bindParam(":DNI",$DNI,PDO::PARAM_STR);
            $resultado->bindParam(":fecha_nacimiento",$fecha_nacimiento,PDO::PARAM_STR);
            $resultado->bindParam(":DNI_tutor",$DNI_tutor_legal,PDO::PARAM_STR);
            $resultado->bindParam(":apellido1",$apellido1,PDO::PARAM_STR);
            $resultado->bindParam(":apellido2",$apellido2,PDO::PARAM_STR);
            $resultado->bindParam(":nombre",$nombre,PDO::PARAM_STR);
            $resultado->bindParam(":contrasena",$contraseña,PDO::PARAM_STR);
            $resultado->bindParam(":curso",$curso,PDO::PARAM_STR);
            $resultado->bindParam(":tlf",$tlf,PDO::PARAM_STR);
            $resultado->bindParam(":correo",$correo,PDO::PARAM_STR);
            $resultado->bindParam(":domicilio",$domicilio,PDO::PARAM_STR);
            $resultado->bindParam(":rol",$rol,PDO::PARAM_STR);
            $resultado->execute();
        }
    }
?>