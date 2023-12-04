<?php
class BD_CANDIDATO
{
    public static function FindAll()
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * from CANDIDATOS");
        $resultado->execute();

        $Candidatos = null;

        $i = 0;


        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $DNI = $tuplas->DNI;
            $fecha_nacimiento = $tuplas->fecha_nacimiento;
            $tutor_dni = $tuplas->tutor_dni;
            $tutor_legal = BD_TUTORLEGAL::FindByID($tutor_dni);
            $apellido1 = $tuplas->apellido1;
            $apellido2 = $tuplas->apellido2;
            $nombre = $tuplas->nombre;
            $contraseña = $tuplas->contrasena;
            $curso = $tuplas->curso;
            $tlf = $tuplas->tlf;
            $correo = $tuplas->correo;
            $domicilio = $tuplas->domicilio;
            $rol = $tuplas->rol;
            $Candidato = new CANDIDATO($DNI, $fecha_nacimiento, $tutor_legal, $apellido1, $apellido2, $nombre, $contraseña, $curso, $tlf, $correo, $domicilio, $rol);
            $Candidatos[] = $Candidato;
            $i++;
        }

        return $Candidatos;
    }

    public static function FindByID($DNI)
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * FROM CANDIDATOS WHERE DNI=:DNI");
        $resultado->bindParam(':DNI', $DNI, PDO::PARAM_STR);
        $resultado->execute();

        $Candidato = null;

        if ($resultado) {
            $tuplas = $resultado->fetch(PDO::FETCH_OBJ);

            if ($tuplas) {
                $DNI = $tuplas->DNI;
                $fecha_nacimiento = $tuplas->fecha_nacimiento;
                $tutor_dni = $tuplas->tutor_dni;
                $tutor_legal = BD_TUTORLEGAL::FindByID($tutor_dni);
                $apellido1 = $tuplas->apellido1;
                $apellido2 = $tuplas->apellido2;
                $nombre = $tuplas->nombre;
                $contraseña = $tuplas->contrasena;
                $curso = $tuplas->curso;
                $tlf = $tuplas->tlf;
                $correo = $tuplas->correo;
                $domicilio = $tuplas->domicilio;
                $rol = $tuplas->rol;
                $Candidato = new CANDIDATO($DNI, $fecha_nacimiento, $tutor_legal, $apellido1, $apellido2, $nombre, $contraseña, $curso, $tlf, $correo, $domicilio, $rol);
            }
        }

        return $Candidato;
    }

    public static function DeleteByID($DNI)
    {
        $conexion = CONEXION::AbreConexion();

        $resultado = $conexion->prepare("DELETE from CANDIDATO where DNI=:DNI");
        $resultado->bindParam(":DNI", $DNI, PDO::PARAM_STR);
        $resultado->execute();
    }

    public static function UpdateByID($DNI, $objetoActualizado)
    {
        $conexion = CONEXION::AbreConexion();
        $DNI=$objetoActualizado->getDNI();
        $fecha_nacimiento = $objetoActualizado->getFechaNacimiento();
        $DNI_tutor_legal = null;
            if ($objetoActualizado->getTutorLegal() !== null) {
                $DNI_tutor_legal = $objetoActualizado->getTutorLegal()->getDNI();
            }
        $apellido1 = $objetoActualizado->getApellido1();
        $apellido2 = $objetoActualizado->getApellido2();
        $nombre = $objetoActualizado->getNombre();
        $contraseña = $objetoActualizado->getContraseña();
        $curso = $objetoActualizado->getCurso();
        $domicilio = $objetoActualizado->getDomicilio();
        $tlf = $objetoActualizado->getTlf();
        $correo = $objetoActualizado->getCorreo();
        $rol = $objetoActualizado->getRol();


        $resultado = $conexion->prepare("UPDATE CANDIDATOS set apellido1=:apellido1,apellido2=:apellido2,nombre=:nombre,domicilio=:domicilio,tlf=:tlf,fecha_nacimiento=:fecha_nacimiento,tutor_dni=:DNI_tutor,contrasena=:contrasena,curso=:curso,correo=:correo,rol=:rol where DNI=:DNI");
        $resultado->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
        $resultado->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
        $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
        $resultado->bindParam(":domicilio", $domicilio, PDO::PARAM_STR);
        $resultado->bindParam(":tlf", $tlf, PDO::PARAM_STR);
        $resultado->bindParam(":DNI_tutor", $DNI_tutor_legal, PDO::PARAM_STR);
        $resultado->bindParam(":contrasena", $contraseña, PDO::PARAM_STR);
        $resultado->bindParam(":curso", $curso, PDO::PARAM_STR);
        $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
        $resultado->bindParam(":domicilio", $domicilio, PDO::PARAM_STR);
        $resultado->bindParam(":tlf", $tlf, PDO::PARAM_STR);
        $resultado->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
        $resultado->bindParam(":DNI", $DNI, PDO::PARAM_STR);
        $resultado->bindParam(":rol", $rol, PDO::PARAM_STR);

        echo $resultado->rowCount();

        $resultado->execute();
    }

    public static function Insert($objeto)
    {
            $conexion = CONEXION::AbreConexion();
            $DNI = $objeto->getDNI();
            $fecha_nacimiento = $objeto->getFechaNacimiento();
            $DNI_tutor_legal = null;
            if ($objeto->getTutorLegal() !== null) {
                $DNI_tutor_legal = $objeto->getTutorLegal()->getDNI();
            }
            $apellido1 = $objeto->getApellido1();
            $apellido2 = $objeto->getApellido2();
            $nombre = $objeto->getNombre();
            $contraseña = $objeto->getContraseña();
            $curso = $objeto->getCurso();
            $tlf = $objeto->getTlf();
            $correo = $objeto->getCorreo();
            $domicilio = $objeto->getDomicilio();
            $rol = $objeto->getRol();



            $resultado = $conexion->prepare
            ("INSERT INTO CANDIDATOS 
            (DNI, fecha_nacimiento, tutor_dni, apellido1, 
            apellido2, nombre, contrasena, curso, tlf, correo, domicilio, rol) 
            VALUES (:DNI, :fecha_nacimiento, :DNI_tutor, :apellido1,:apellido2,:nombre,
            :contrasena,:curso,:tlf,:correo,:domicilio, :rol)");

            $resultado->bindParam(":DNI", $DNI, PDO::PARAM_STR);
            $resultado->bindParam(":fecha_nacimiento", $fecha_nacimiento, PDO::PARAM_STR);
            $resultado->bindParam(":DNI_tutor", $DNI_tutor_legal, PDO::PARAM_STR);
            $resultado->bindParam(":apellido1", $apellido1, PDO::PARAM_STR);
            $resultado->bindParam(":apellido2", $apellido2, PDO::PARAM_STR);
            $resultado->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $resultado->bindParam(":contrasena", $contraseña, PDO::PARAM_STR);
            $resultado->bindParam(":curso", $curso, PDO::PARAM_STR);
            $resultado->bindParam(":tlf", $tlf, PDO::PARAM_STR);
            $resultado->bindParam(":correo", $correo, PDO::PARAM_STR);
            $resultado->bindParam(":domicilio", $domicilio, PDO::PARAM_STR);
            $resultado->bindParam(":rol", $rol, PDO::PARAM_STR);

            $resultado->execute();
    }


}
