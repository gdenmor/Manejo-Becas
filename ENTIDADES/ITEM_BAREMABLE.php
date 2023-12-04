<?php
    class ITEM_BAREMABLE implements \JsonSerializable{
        private $id_item;
        private $nombre;

        public function __construct($id_item,$nombre){
            $this->id_item=$id_item;
            $this->nombre=$nombre;
        }

        public function getID_Item(){
            return $this->id_item;
        }

        public function getNombre(){
            return $this->nombre;
        }

        public function setID_Item($id_item){
            $this->id_item=$id_item;
        }

        public function setNombre($nombre){
            $this->nombre=$nombre;
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