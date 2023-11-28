<?php
    class CONVOCATORIA_BAREMABLE{
        private $id_convocatoria_baremable;
        private $convocatoria;
        private $baremo;
        private $maximo;
        private $requisito;
        private $minimo;
        private $aportaalumno;

        // Constructor
        public function __construct($id_convocatoria_baremable,$convocatoria, $baremo, $maximo, $requisito, $minimo, $aportaalumno) {
            $this->id_convocatoria_baremable=$id_convocatoria_baremable;
            $this->convocatoria = $convocatoria;
            $this->baremo = $baremo;
            $this->maximo = $maximo;
            $this->requisito = $requisito;
            $this->minimo = $minimo;
            $this->aportaalumno=$aportaalumno;
        }

        public function getID_Convocatoria_Baremable(){
            return $this->id_convocatoria_baremable;
        }

        public function setID_Convocatoria_Baremable($id_convocatoria_baremable){
            $this->id_convocatoria_baremable=$id_convocatoria_baremable;
        }

        // Setter para el id de la convocatoria
        public function setConvocatoria($convocatoria) {
            $this->convocatoria = $convocatoria;
        }

        // Setter para el id del baremo
        public function setBaremo($baremo) {
            $this->baremo = $baremo;
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
        public function getConvocatoria() {
            return $this->convocatoria;
        }

        // Getter para el id del baremo
        public function getBaremo() {
            return $this->baremo;
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

        public function getAportaAlumno() {
            return $this->aportaalumno;
        }

        public function setAportaAlumno($aportaalumno) {
            $this->minimo = $aportaalumno;
        }
    }


?>