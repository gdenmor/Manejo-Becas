<?php

$mensajeError = "";


$login = isset($_POST['login']) ? $_POST['login'] : "";
$registro = isset($_POST['registro']) ? $_POST['registro'] : "";
$DNI = isset($_POST['DNI']) ? strtoupper(str_replace(" ", "", $_POST['DNI'])) : "";
$password = isset($_POST['password']) ? str_replace(" ", "", $_POST['password']) : "";
$id = null;


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ($login) {
        $existe = false;
        $User = null;
        $Usuarios = BD_CANDIDATO::FindAll();

        if (is_array($Usuarios) && count($Usuarios) > 0) {

            for ($i = 0; $i < count($Usuarios); $i++) {
                if (strtoupper(str_replace(" ", "", $Usuarios[$i]->getDNI())) == $DNI && $Usuarios[$i]->getContraseña()==$password) {
                    $User = $Usuarios[$i];
                    $existe = true;
                    break; // Salir del bucle una vez que se ha encontrado el usuario
                }
            }
            
            if ($existe){
                if ($User!=null){
                    if ($User->getRol()=="ALUMNO"){
                        SESSION::iniciaSesion('USER',$User,"http://localhost/Manejo-Becas/index.php?menu=alumno");
                    }else{
                        SESSION::iniciaSesion('USER',$User,"http://localhost/Manejo-Becas/index.php?menu=admin");
                    }
                }
            }
        } else {
            $mensajeError = "El usuario no existe";
        }
    }
    if ($registro) {
        header("Location: ?menu=registro");
    }
}

if ($mensajeError != "") {
    $mensajeError = '<p id="error">' . $mensajeError . '</p>';
}

?>
<main id="contenedor-login">
    <form method="post">
        <section id="contenido-login">
            <section class="elementos" id="contenedor-dni-login">
                <article id="lblDNI-login">
                    <label>DNI:</label>
                </article>
                <article id="txtDNI-login">
                    <input type="text" name="DNI">
                </article>
            </section>
            <section class="elementos" id="contenedor-contraseña-login">
                <article id="lblContraseña-login">
                    <label>CONTRASEÑA:</label>
                </article>
                <article id="txtContraseña-login">
                    <input type="password" name="password">
                </article>
            </section>
            <section id="linkForgotPassword-login">
                <a href="?menu=olvida_contraseña">¿Has olvidado tu contraseña?</a>
            </section>
            <section id="btns-Login">
                <input type="submit" value="REGISTRARSE" name="registro">
                <input type="submit" value="INICIAR SESIÓN" name="login">
            </section>
        </section>
        <section id="mensaje-error-login">
            <?php
            if ($mensajeError != "") {
                echo $mensajeError;
            }
            ?>
        </section>
    </form>
</main>