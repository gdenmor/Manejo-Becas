<?php

class TutorLegal implements \JsonSerializable{
    private $DNI;
    private $apellido1;
    private $apellido2;
    private $nombre;
    private $domicilio;
    private $tlf;

    // Constructor
    public function __construct($dni,$apellido1, $apellido2, $nombre, $domicilio, $tlf) {
        $this->DNI = $dni;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->nombre = $nombre;
        $this->domicilio = $domicilio;
        $this->tlf = $tlf;
    }

    // Obtener el ID del tutor
    public function getDNI() {
        return $this->DNI;
    }

    // Obtener el primer apellido
    public function getApellido1() {
        return $this->apellido1;
    }

    // Obtener el segundo apellido
    public function getApellido2() {
        return $this->apellido2;
    }

    // Obtener el nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Obtener el domicilio
    public function getDomicilio() {
        return $this->domicilio;
    }

    // Obtener el teléfono
    public function getTlf() {
        return $this->tlf;
    }

    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;
    }

    // Setter para el segundo apellido
    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;
    }

    // Setter para el nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Setter para el domicilio
    public function setDomicilio($domicilio) {
        $this->domicilio = $domicilio;
    }

    // Setter para el teléfono
    public function setTlf($tlf) {
        $this->tlf = $tlf;
    }

    // Setter para el DNI
    public function setDNI($dni) {
        $this->DNI = $dni;
    }

    public function toJSON(){
        return json_encode(get_object_vars($this));
    }

    public function jsonSerialize(){
        $var=get_object_vars($this);
        return $var;
    }

}

?>
