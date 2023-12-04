<?php
    class CONVOCATORIA_BAREMABLE_IDIOMA implements \JsonSerializable{
        private $id_convocatoria_baremable_idioma;
        private $convocatoria;
        private $idioma;
        private $id_baremo;
        private $nota_idioma;

        // Constructor
        public function __construct($id_convocatoria_baremable_idioma,$convocatoria, $idioma, $baremo,$nota_idioma) {
            $this->id_convocatoria_baremable_idioma=$id_convocatoria_baremable_idioma;
            $this->convocatoria = $convocatoria;
            $this->idioma = $idioma;
            $this->id_baremo = $baremo;
            $this->nota_idioma=$nota_idioma;
        }

        public function getNota_Idioma(){
            return $this->nota_idioma;
        }

        public function setNota_Idioma($nota_idioma){
            $this->nota_idioma=$nota_idioma;
        }

        public function getID_Convocatoria_Baremable_Idioma(){
            return $this->id_convocatoria_baremable_idioma;
        }

        public function setID_Convocatoria_Baremable_Idioma($id_convocatoria_baremable_idioma){
            $this->id_convocatoria_baremable_idioma=$id_convocatoria_baremable_idioma;
        }


        // Setter para el id de la convocatoria
        public function setIdConvocatoria($convocatoria) {
            $this->convocatoria = $convocatoria;
        }

        // Setter para el id del idioma
        public function setIdIdioma($idioma) {
            $this->idioma = $idioma;
        }

        // Setter para el id del baremo
        public function setIdBaremo($id_baremo) {
            $this->id_baremo = $id_baremo;
        }

        // Getter para el id de la convocatoria
        public function getIdConvocatoria() {
            return $this->convocatoria;
        }

        // Getter para el id del idioma
        public function getIdioma() {
            return $this->idioma;
        }

        // Getter para el id del baremo
        public function getIdBaremo() {
            return $this->id_baremo;
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