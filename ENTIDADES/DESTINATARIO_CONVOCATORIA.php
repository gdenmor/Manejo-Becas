<?php
    class DESTINATARIO_CONVOCATORIA implements \JsonSerializable{
        private $id_destinatario_convocatoria;
        private $convocatoria;
        private $destinatario;

        public function __construct($id_destinatario_convocatoria,$convocatoria,$destinatario){
            $this->id_destinatario_convocatoria=$id_destinatario_convocatoria;
            $this->convocatoria=$convocatoria;
            $this->destinatario=$destinatario;
        }

        public function getConvocatoria(){
            return $this->convocatoria;
        }

        public function getDestinatario(){
            return $this->destinatario;
        }

        public function setConvocatoria($convocatoria){
            $this->convocatoria=$convocatoria;
        }

        public function setDestinatario($destinatario){
            $this->destinatario=$destinatario;
        }

        public function getID_Destinatario_Convocatoria(){
            return $this->id_destinatario_convocatoria;
        }

        public function setID_Destinatario_Convocatoria($id_destinatario_convocatoria){
            $this->id_destinatario_convocatoria=$id_destinatario_convocatoria;
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