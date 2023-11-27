<?php
    class CONVOCATORIAS{
        private $id_convocatoria;
        private $num_movilidades;
        private $tipo;
        private $fecha_inicio;
        private $fecha_fin;
        private $fechaInicioBaremacion;
        private $fechaFinBaremacion;
        private $fechaInicioListadoProvisional;
        private $fechaFinListadoProvisional;
        private $fechaInicioListadoDefinitivo;
        private $fechaFinListadoDefinitivo;
        private $codigo_proyecto;

        // Constructor
        public function __construct(
            $num_movilidades,
            $tipo,
            $fecha_inicio,
            $fecha_fin,
            $fechaInicioBaremacion,
            $fechaFinBaremacion,
            $fechaInicioListadoProvisional,
            $fechaFinListadoProvisional,
            $fechaInicioListadoDefinitivo,
            $fechaFinListadoDefinitivo,
            $codigo_proyecto
            ) {
            $this->num_movilidades = $num_movilidades;
            $this->tipo = $tipo;
            $this->fecha_inicio = $fecha_inicio;
            $this->fecha_fin = $fecha_fin;
            $this->fechaInicioBaremacion = $fechaInicioBaremacion;
            $this->fechaFinBaremacion = $fechaFinBaremacion;
            $this->fechaInicioListadoProvisional = $fechaInicioListadoProvisional;
            $this->fechaFinListadoProvisional = $fechaFinListadoProvisional;
            $this->fechaInicioListadoDefinitivo = $fechaInicioListadoDefinitivo;
            $this->fechaFinListadoDefinitivo = $fechaFinListadoDefinitivo;
            $this->codigo_proyecto = $codigo_proyecto;
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
        public function setFechaInicioBaremacion($fechaInicioBaremacion) {
            $this->fechaInicioBaremacion = $fechaInicioBaremacion;
        }

        // Setter para la fecha de fin de baremación
        public function setFechaFinBaremacion($fechaFinBaremacion) {
            $this->fechaFinBaremacion = $fechaFinBaremacion;
        }

        // Setter para la fecha de inicio de listado provisional
        public function setFechaInicioListadoProvisional($fechaInicioListadoProvisional) {
            $this->fechaInicioListadoProvisional = $fechaInicioListadoProvisional;
        }

        // Setter para la fecha de fin de listado provisional
        public function setFechaFinListadoProvisional($fechaFinListadoProvisional) {
            $this->fechaFinListadoProvisional = $fechaFinListadoProvisional;
        }

        // Setter para la fecha de inicio de listado definitivo
        public function setFechaInicioListadoDefinitivo($fechaInicioListadoDefinitivo) {
            $this->fechaInicioListadoDefinitivo = $fechaInicioListadoDefinitivo;
        }

        // Setter para la fecha de fin de listado definitivo
        public function setFechaFinListadoDefinitivo($fechaFinListadoDefinitivo) {
            $this->fechaFinListadoDefinitivo = $fechaFinListadoDefinitivo;
        }

        // Setter para el código de proyecto
        public function setCodigoProyecto($codigo_proyecto) {
            $this->codigo_proyecto = $codigo_proyecto;
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
        public function getFechaInicioBaremacion() {
            return $this->fechaInicioBaremacion;
        }

        // Getter para la fecha de fin de baremación
        public function getFechaFinBaremacion() {
            return $this->fechaFinBaremacion;
        }

        // Getter para la fecha de inicio de listado provisional
        public function getFechaInicioListadoProvisional() {
            return $this->fechaInicioListadoProvisional;
        }

        // Getter para la fecha de fin de listado provisional
        public function getFechaFinListadoProvisional() {
            return $this->fechaFinListadoProvisional;
        }

        // Getter para la fecha de inicio de listado definitivo
        public function getFechaInicioListadoDefinitivo() {
            return $this->fechaInicioListadoDefinitivo;
        }

        // Getter para la fecha de fin de listado definitivo
        public function getFechaFinListadoDefinitivo() {
            return $this->fechaFinListadoDefinitivo;
        }

        // Getter para el código de proyecto
        public function getCodigoProyecto() {
            return $this->codigo_proyecto;
        }
    }
?>