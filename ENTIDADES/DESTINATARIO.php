<?php
    class Destinatario implements \JsonSerializable{
        private $codigo_grupo;
        private $nombre;
    
        // Constructor
        public function __construct($codigo_grupo, $nombre) {
            $this->codigo_grupo = $codigo_grupo;
            $this->nombre = $nombre;
        }
    
        // Setter para el nombre del grupo
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
    
        // Getter para el código del grupo
        public function getCodigoGrupo() {
            return $this->codigo_grupo;
        }
    
        // Getter para el nombre del grupo
        public function getNombre() {
            return $this->nombre;
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