<?php
if (isset($_GET['menu'])) {
    require_once "../Manejo-Becas/HELPERS/AUTOLOAD.php";
    if ($_GET['menu'] == "inicio") {
        require_once "../Manejo-Becas/FORMULARIOS/LOGIN.php";
    }else if ($_GET['menu']=="olvida_contraseña"){
        require_once "../Manejo-Becas/FORMULARIOS/OLVIDA_CONTRASEÑA.php";
    }else if ($_GET['menu']=="registro"){
        require_once "../Manejo-Becas/FORMULARIOS/REGISTRO.php";
    }else if ($_GET['menu']=="alumno"){
        require_once "../Manejo-Becas/FORMULARIOS/CONVOCATORIA_ALUMNO.php";
    }else if ($_GET['menu']=="admin"){
        require_once "../Manejo-Becas/FORMULARIOS/CRUD_CONVOCATORIA.php";
    }else if ($_GET['menu']=="solicitud"){
        require_once "../Manejo-Becas/FORMULARIOS/FORMULARIO_SOLICITUD.php";
    }else if ($_GET['menu']=="mostrarConvocatorias"){
        require_once "../Manejo-Becas/FORMULARIOS/MUESTRACONVOCATORIAS.php";
    }else{
        SESSION::Cerrar_Sesion();
    }


}else{
    require_once '../Manejo-Becas/FORMULARIOS/LANDINPAGE.php';
}

    

    
