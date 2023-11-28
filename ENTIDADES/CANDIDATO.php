<?php
    class CANDIDATO{
        private $DNI;
        private $fecha_nacimiento;
        private $tutor_legal;
        private $apellido1;
        private $apellido2;
        private $nombre;
        private $contraseña;
        private $curso;
        private $tlf;
        private $correo;
        private $domicilio;
        private $rol;

        public function getDNI(){
            return $this->DNI;
        }

        public function setDNI($DNI){
            $this->DNI=$DNI;
        }

        public function getFechaNacimiento(){
            return $this->fecha_nacimiento;
        }

        public function setFechaNacimiento($fecha_nacimiento){
            $this->fecha_nacimiento=$fecha_nacimiento;
        }

        public function getTutorLegal(){
            return $this->tutor_legal;
        }

        public function setTutorLegal($tutor_legal){
            $this->tutor_legal=$tutor_legal;
        }

        public function getApellido1(){
            return $this->apellido1;
        }

        public function setApellido1($apellido1){
            $this->apellido1=$apellido1;
        }

        public function getApellido2(){
            return $this->apellido2;
        }

        public function setApellido2($apellido2){
            $this->apellido2=$apellido2;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setNombre($nombre){
            $this->nombre=$nombre;
        }

        public function getContraseña(){
            return $this->contraseña;
        }

        public function setContraseña($contraseña){
            $this->contraseña=$contraseña;
        }

        public function getCurso(){
            return $this->curso;
        }

        public function setCurso($curso){
            $this->fecha_nacimiento=$curso;
        }

        public function getTlf(){
            return $this->tlf;
        }

        public function setTlf($tlf){
            $this->tutor_legal=$tlf;
        }

        public function getCorreo(){
            return $this->correo;
        }

        public function setCorreo($correo){
            $this->correo=$correo;
        }

        public function getDomicilio(){
            return $this->domicilio;
        }

        public function setDomicilio($domicilio){
            $this->domicilio=$domicilio;
        }

        public function getRol(){
            return $this->rol;       
        }

        public function setRol($rol){
            $this->rol=$rol;
        }

        public function __construct($DNI,$fecha_nacimiento,$tutor_legal,$apellido1,$apellido2,$nombre,$contraseña,$curso,$tlf,$correo,$domicilio,$rol){
            $this->DNI=$DNI;
            $this->fecha_nacimiento=$fecha_nacimiento;
            $this->tutor_legal=$tutor_legal;
            $this->apellido1=$apellido1;
            $this->apellido2=$apellido2;
            $this->nombre=$nombre;
            $this->contraseña=$contraseña;
            $this->curso=$curso;
            $this->tlf=$tlf;
            $this->correo=$correo;
            $this->domicilio=$domicilio;
            $this->rol=$rol;
        }

    }


?>