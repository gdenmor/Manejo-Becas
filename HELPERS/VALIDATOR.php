<?php
    class VALIDATOR{
        public function validaDNI($DNI){
            $formato=preg_match('/[0-9]{8}[a-zA-Z]$/i',$DNI);
            if ($formato==true){
                $numeros=substr($DNI,0,8);
                $letra=substr($DNI,8,1);
                $letra_correcta = substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1);
                if ($letra==$letra_correcta){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function validaCorreo($correo){
            if (filter_var($correo,FILTER_VALIDATE_EMAIL)){
                return true;
            }else{
                return false;
            }
        }

        public function validaNombre($nombre,$longitud_max,$longitud_min){
            if (strlen($nombre)>$longitud_min&&strlen($nombre)<=$longitud_max){
                return true;
            }else{
                return false;
            }
        }

        public function validaApellido($apellido,$longitud_max,$longitud_min){
            if (strlen($apellido)>$longitud_min&&strlen($apellido)<=$longitud_max){
                return true;
            }else{
                return false;
            }
        }

        public function validaDomicilio($domicilio,$longitud_max,$longitud_min){
            if (strlen($domicilio)>$longitud_min&&strlen($domicilio)<=$longitud_max){
                return true;
            }else{
                return false;
            }
        }

        //su formato será el siguiente: 1 mayúscula,1 número,1 caracter especial y mínimo 8 caracteres
        //(?=.*[A-Z]) ?=: que coincida, .*: que se repita cualquier caracter,[A-Z]: el carácter
        public function validaContraseña($contraseña){
            $formato=preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&_])(?=.*\d)(?=.*).{8,}$/',$contraseña);
            if ($formato){
                return true;
            }else{
                return false;
            }
        }

        public function validaFecha($fecha){
            $fechaactual=new DateTime();
            $fechas=new DateTime($fecha);
            if ($fechaactual<=$fechas){
                return true;
            }else{
                return false;
            }
        }


    }



?>