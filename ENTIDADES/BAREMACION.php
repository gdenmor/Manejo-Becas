<?php
    class BAREMACION implements \JsonSerializable{
        private $id_baremacion;
        private $id_candidato_convocatoria;
        private $item;
        private $nota;
        private $url;

        // Constructor
        public function __construct($id_baremacion,$convocatoria, $item, $nota, $url) {
            $this->id_baremacion=$id_baremacion;
            $this->id_candidato_convocatoria = $convocatoria;
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


        // Setter para el ID de la convocatoria
        public function setConvocatoria($id_convocatoria) {
            $this->id_candidato_convocatoria = $id_convocatoria;
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

        // Getter para el ID de la convocatoria
        public function getCandidatoConvocatoria() {
            return $this->id_candidato_convocatoria;
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

        public function toJSON(){
            return json_encode(get_object_vars($this));
        }

        public function jsonSerialize(){
            $var=get_object_vars($this);
            return $var;
        }
    }

?>