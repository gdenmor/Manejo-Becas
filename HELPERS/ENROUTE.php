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
    }else if ($_GET['menu']=="quien"){
        require_once "../Manejo-Becas/FORMULARIOS/QUIENES_SOMOS.php";
    }else if ($_GET['menu']=="baremo"){
        require_once "../Manejo-Becas/FORMULARIOS/BAREMAR.php";
    }else if ($_GET['menu']=="versolicitudes"){
        require_once "../Manejo-Becas/FORMULARIOS/SOLICITUDES_CONVOCATORIA.php";
    }else if ($_GET['menu']=="versolicitud"){
        require_once "../Manejo-Becas/FORMULARIOS/BAREMARSOLICITUD.php";
    }else if ($_GET['menu']=="veralumno"){
        require_once "../Manejo-Becas/FORMULARIOS/VER_SOLICITUDES_ALUMNO.php";
    }else if ($_GET['menu']=="actualiza"){
        require_once "../Manejo-Becas/FORMULARIOS/ACTUALIZARCONVOCATORIA.php";
    }else if ($_GET['menu']=="solicitudalu"){
        require_once "../Manejo-Becas/FORMULARIOS/SOL.php";
    }else if ($_GET['menu']=="verlisp"){
        require_once "../Manejo-Becas/FORMULARIOS/LISTADOPROV.php";
    }else if ($_GET['menu']=="verlisf"){
        require_once "../Manejo-Becas/FORMULARIOS/LISTADODEF.php";
    }else if ($_GET['menu']=="actualiza"){
        require_once "../Manejo-Becas/FORMULARIOS/ACTUALIZARCONVOCATORIA.php";
    }else{
        SESSION::Cerrar_Sesion();
    }
}
?>

    

    
