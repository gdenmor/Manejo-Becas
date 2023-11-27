<?php
    class CONEXION{
        private static $conexion=null;

        public static function AbreConexion(){
            if (CONEXION::$conexion==null){
                CONEXION::$conexion=new PDO("mysql:host=localhost;dbname=becas","root","Root");
            }

            return CONEXION::$conexion;
        }

    }



?>