<?php
    class CONVOCATORIA_BAREMABLE_IDIOMA{
        private $id_convocatoria;
        private $id_idioma;
        private $id_baremo;

        // Constructor
        public function __construct($id_convocatoria, $id_idioma, $id_baremo) {
            $this->id_convocatoria = $id_convocatoria;
            $this->id_idioma = $id_idioma;
            $this->id_baremo = $id_baremo;
        }

        // Setter para el id de la convocatoria
        public function setIdConvocatoria($id_convocatoria) {
            $this->id_convocatoria = $id_convocatoria;
        }

        // Setter para el id del idioma
        public function setIdIdioma($id_idioma) {
            $this->id_idioma = $id_idioma;
        }

        // Setter para el id del baremo
        public function setIdBaremo($id_baremo) {
            $this->id_baremo = $id_baremo;
        }

        // Getter para el id de la convocatoria
        public function getIdConvocatoria() {
            return $this->id_convocatoria;
        }

        // Getter para el id del idioma
        public function getIdIdioma() {
            return $this->id_idioma;
        }

        // Getter para el id del baremo
        public function getIdBaremo() {
            return $this->id_baremo;
        }
    }

?>