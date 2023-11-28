<?php
    class BAREMACION{
        private $id_baremacion;
        private $dni;
        private $convocatoria;
        private $item;
        private $nota;
        private $url;

        // Constructor
        public function __construct($id_baremacion,$dni, $convocatoria, $item, $nota, $url) {
            $this->id_baremacion=$id_baremacion;
            $this->dni = $dni;
            $this->convocatoria = $convocatoria;
            $this->item = $item;
            $this->nota = $nota;
            $this->url = $url;
        }

        public function getID_Baremacion(){
            return $this->id_baremacion;
        }

        public function setID_Baremacion($id_baremacion){
            $this->id_baremacion=$id_baremacion;
        }

        // Setter para el DNI
        public function setDNI($dni) {
            $this->dni = $dni;
        }

        // Setter para el ID de la convocatoria
        public function setConvocatoria($id_convocatoria) {
            $this->convocatoria = $id_convocatoria;
        }

        // Setter para el ID del item baremable
        public function setItem($item) {
            $this->item = $item;
        }

        // Setter para la nota
        public function setNota($nota) {
            $this->nota = $nota;
        }

        // Setter para la URL
        public function setURL($url) {
            $this->url = $url;
        }

        // Getter para el DNI
        public function getDNI() {
            return $this->dni;
        }

        // Getter para el ID de la convocatoria
        public function getConvocatoria() {
            return $this->convocatoria;
        }

        // Getter para el ID del item baremable
        public function getItem() {
            return $this->item;
        }

        // Getter para la nota
        public function getNota() {
            return $this->nota;
        }

        // Getter para la URL
        public function getURL() {
            return $this->url;
        }
    }

?>