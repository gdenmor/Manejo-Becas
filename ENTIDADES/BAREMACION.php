<?php
    class BAREMACION{
        private $dni;
        private $id_convocatoria;
        private $id_item;
        private $nota;
        private $url;

        // Constructor
        public function __construct($dni, $id_convocatoria, $id_item, $nota, $url) {
            $this->dni = $dni;
            $this->id_convocatoria = $id_convocatoria;
            $this->id_item = $id_item;
            $this->nota = $nota;
            $this->url = $url;
        }

        // Setter para el DNI
        public function setDNI($dni) {
            $this->dni = $dni;
        }

        // Setter para el ID de la convocatoria
        public function setIdConvocatoria($id_convocatoria) {
            $this->id_convocatoria = $id_convocatoria;
        }

        // Setter para el ID del item baremable
        public function setIdItem($id_item) {
            $this->id_item = $id_item;
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
        public function getIdConvocatoria() {
            return $this->id_convocatoria;
        }

        // Getter para el ID del item baremable
        public function getIdItem() {
            return $this->id_item;
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