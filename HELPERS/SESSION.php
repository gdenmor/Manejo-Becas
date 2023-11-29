<?php
    require_once "AUTOLOAD.php";
    AUTOLOAD::AutoLoad();
    class SESSION{

        public static function leer_session($clave) {
            $valor=$_SESSION[$clave];
            return $valor;
        }
    
        public static function Cerrar_Sesion() {
            session_destroy();
            header("Location: ?menu=inicio");
        }
    
        public static function iniciaSesion($clave,$valor,$redireccion){
            SESSION::CreaSesion();
            $_SESSION[$clave]=$valor;
            header("Location: $redireccion");
        }

        public static function estaLogueado($clave) {
            return isset($_SESSION[$clave]) === true;
        }
    
        public static function CreaSesion(){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }

    }
    

    



?>