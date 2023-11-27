<?php
    class CONVOCATORIA_BAREMABLE{
        private $id_convocatoria;
        private $id_baremo;
        private $maximo;
        private $requisito;
        private $minimo;

        // Constructor
        public function __construct($id_convocatoria, $id_baremo, $maximo, $requisito, $minimo, $subealumno) {
            $this->id_convocatoria = $id_convocatoria;
            $this->id_baremo = $id_baremo;
            $this->maximo = $maximo;
            $this->requisito = $requisito;
            $this->minimo = $minimo;
        }

        // Setter para el id de la convocatoria
        public function setIdConvocatoria($id_convocatoria) {
            $this->id_convocatoria = $id_convocatoria;
        }

        // Setter para el id del baremo
        public function setIdBaremo($id_baremo) {
            $this->id_baremo = $id_baremo;
        }

        // Setter para el valor máximo
        public function setMaximo($maximo) {
            $this->maximo = $maximo;
        }

        // Setter para el requisito
        public function setRequisito($requisito) {
            $this->requisito = $requisito;
        }

        // Setter para el valor mínimo
        public function setMinimo($minimo) {
            $this->minimo = $minimo;
        }


        // Getter para el id de la convocatoria
        public function getIdConvocatoria() {
            return $this->id_convocatoria;
        }

        // Getter para el id del baremo
        public function getIdBaremo() {
            return $this->id_baremo;
        }

        // Getter para el valor máximo
        public function getMaximo() {
            return $this->maximo;
        }

        // Getter para el requisito
        public function getRequisito() {
            return $this->requisito;
        }

        // Getter para el valor mínimo
        public function getMinimo() {
            return $this->minimo;
        }
    }


?>