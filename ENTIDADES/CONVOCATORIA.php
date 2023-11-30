<?php
    class CONVOCATORIA{
        private $id_convocatoria;
        private $num_movilidades;
        private $tipo;
        private $fecha_inicio;
        private $fecha_fin;
        private $fechaInicioPruebas;
        private $fechaFinPruebas;
        private $fechaListadoProvisional;
        private $fechaListadoDefinitivo;
        private $Proyecto;
        private $pais_destino;

        // Constructor
        public function __construct(
            $id_convocatoria,
            $num_movilidades,
            $tipo,
            $fecha_inicio,
            $fecha_fin,
            $fechaInicioPruebas,
            $fechaFinPruebas,
            $fechaListadoProvisional,
            $fechaListadoDefinitivo,
            $Proyecto,
            $pais_destino
            ) {
            $this->id_convocatoria=$id_convocatoria;
            $this->num_movilidades = $num_movilidades;
            $this->tipo = $tipo;
            $this->fecha_inicio = $fecha_inicio;
            $this->fecha_fin = $fecha_fin;
            $this->fechaInicioPruebas = $fechaInicioPruebas;
            $this->fechaFinPruebas = $fechaFinPruebas;
            $this->fechaListadoProvisional = $fechaListadoProvisional;
            $this->fechaListadoDefinitivo=$fechaListadoDefinitivo;
            $this->Proyecto = $Proyecto;
            $this->pais_destino=$pais_destino;
        }

        public function getPais(){
            return $this->pais_destino;
        }

        public function setPais($pais_destino){
            $this->pais_destino=$pais_destino;
        }

        public function setID($id){
            $this->id_convocatoria=$id;
        }

        // Setter para el número de movilidades
        public function setNumMovilidades($num_movilidades) {
            $this->num_movilidades = $num_movilidades;
        }

        // Setter para el tipo de convocatoria
        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        // Setter para la fecha de inicio
        public function setFechaInicio($fecha_inicio) {
            $this->fecha_inicio = $fecha_inicio;
        }

        // Setter para la fecha de fin
        public function setFechaFin($fecha_fin) {
            $this->fecha_fin = $fecha_fin;
        }

        // Setter para la fecha de inicio de baremación
        public function setFechaInicioPruebas($fechaInicioPruebas) {
            $this->fechaInicioPruebas = $fechaInicioPruebas;
        }

        // Setter para la fecha de fin de baremación
        public function setFechaFinPruebas($fechaFinPruebas) {
            $this->fechaFinPruebas = $fechaFinPruebas;
        }

        // Setter para la fecha de fin de listado provisional
        public function setFechaListadoProvisional($fechaListadoProvisional) {
            $this->fechaListadoProvisional = $fechaListadoProvisional;
        }

        // Setter para la fecha de inicio de listado definitivo
        public function setFechaInicioListadoDefinitivo($fechaListadoDefinitivo) {
            $this->fechaListadoDefinitivo = $fechaListadoDefinitivo;
        }

        // Setter para el código de proyecto
        public function setCodigoProyecto($Proyecto) {
            $this->Proyecto = $Proyecto;
        }

        // Getter para el ID de la convocatoria
        public function getIdConvocatoria() {
            return $this->id_convocatoria;
        }

        // Getter para el número de movilidades
        public function getNumMovilidades() {
            return $this->num_movilidades;
        }

        // Getter para el tipo de convocatoria
        public function getTipo() {
            return $this->tipo;
        }

        // Getter para la fecha de inicio
        public function getFechaInicio() {
            return $this->fecha_inicio;
        }

        // Getter para la fecha de fin
        public function getFechaFin() {
            return $this->fecha_fin;
        }

        // Getter para la fecha de inicio de baremación
        public function getFechaInicioPruebas() {
            return $this->fechaInicioPruebas;
        }

        // Getter para la fecha de fin de baremación
        public function getFechaFinPruebas() {
            return $this->fechaFinPruebas;
        }

        // Getter para la fecha de inicio de listado provisional
        public function getFechaListadoProvisional() {
            return $this->fechaListadoProvisional;
        }

        // Getter para la fecha de inicio de listado definitivo
        public function getFechaListadoDefinitivo() {
            return $this->fechaListadoDefinitivo;
        }

        // Getter para el código de proyecto
        public function getProyecto() {
            return $this->Proyecto;
        }
    }
?>