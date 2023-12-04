<?php
    class PROYECTO implements \JsonSerializable{
        private $codigo_proyecto;
        private $nombre;
        private $fecha_inicio;
        private $fecha_fin;

        // Constructor
        public function __construct($codigo_proyecto, $nombre, $fecha_inicio, $fecha_fin) {
            $this->codigo_proyecto = $codigo_proyecto;
            $this->nombre = $nombre;
            $this->fecha_inicio = $fecha_inicio;
            $this->fecha_fin = $fecha_fin;
        }

        // Setter para el nombre del proyecto
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }

        // Setter para la fecha de inicio
        public function setFechaInicio($fecha_inicio) {
            $this->fecha_inicio = $fecha_inicio;
        }

        // Setter para la fecha de fin
        public function setFechaFin($fecha_fin) {
            $this->fecha_fin = $fecha_fin;
        }

        // Getter para el código del proyecto
        public function getCodigoProyecto() {
            return $this->codigo_proyecto;
        }

        // Getter para el nombre del proyecto
        public function getNombre() {
            return $this->nombre;
        }

        // Getter para la fecha de inicio
        public function getFechaInicio() {
            return $this->fecha_inicio;
        }

        // Getter para la fecha de fin
        public function getFechaFin() {
            return $this->fecha_fin;
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