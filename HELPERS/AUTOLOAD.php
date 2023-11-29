<?php
    class AUTOLOAD{
        public static function AutoLoad() {
            spl_autoload_register('autocargador');
        }

    }

    function autocargador($Clase){
        if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/ENTIDADES" . "/" . $Clase .".php")) {
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/ENTIDADES" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/APIS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/APIS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/CSS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/CSS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/FORMULARIOS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/FORMULARIOS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/HELPERS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/HELPERS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/IMAGENES" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/IMAGENES" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/JS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/JS" . "/" . $Clase .".php";
        } else if (file_exists($_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/REPOSITORIOS" . "/" . $Clase .".php")){
            require_once $_SERVER["DOCUMENT_ROOT"]."/Manejo-Becas/REPOSITORIOS" . "/" . $Clase .".php";
        }
    }

    AUTOLOAD::AutoLoad();


    
?>