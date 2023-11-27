<?php
    class DESTINATARIO_CONVOCATORIA{
        private $convocatoria;
        private $destinatario;

        public function __construct($convocatoria,$destinatario){
            $this->convocatoria=$convocatoria;
            $this->destinatario=$destinatario;
        }

        public function getConvocatoria(){
            $this->convocatoria;
        }

        public function getDestinatario(){
            $this->destinatario;
        }

        public function setConvocatoria($convocatoria){
            $this->convocatoria=$convocatoria;
        }

        public function setDestinatario($destinatario){
            $this->destinatario=$destinatario;
        }
    }


?>