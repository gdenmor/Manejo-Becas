<?php
    class NIVEL_IDIOMA implements \JsonSerializable{
        private $id_idioma;
        private $titulo;

        // Constructor
        public function __construct($titulo,$id_idioma) {
            $this->titulo = $titulo;
            $this->id_idioma=$id_idioma;
        }

        // Setter para el título del idioma
        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        // Getter para el ID del idioma
        public function getIdIdioma() {
            return $this->id_idioma;
        }

        // Getter para el título del idioma
        public function getTitulo() {
            return $this->titulo;
        }

        public function toJSON(){
            return json_encode(get_object_vars($this));
        }

        public function jsonSerialize():array{
            $var=get_object_vars($this);
            return $var;
        }
    }

?>