<?php
    class CANDIDATOS_CONVOCATORIA{
        private $id_convocatoria;
        private $dni;

        // Constructor
        public function __construct($id_convocatoria, $dni) {
            $this->id_convocatoria = $id_convocatoria;
            $this->dni = $dni;
        }

        // Setter para el ID de la convocatoria
        public function setIdConvocatoria($id_convocatoria) {
            $this->id_convocatoria = $id_convocatoria;
        }

        // Setter para el DNI del candidato
        public function setDNI($dni) {
            $this->dni = $dni;
        }

        // Getter para el ID de la convocatoria
        public function getIdConvocatoria() {
            return $this->id_convocatoria;
        }

        // Getter para el DNI del candidato
        public function getDNI() {
            return $this->dni;
        }
    }
?>