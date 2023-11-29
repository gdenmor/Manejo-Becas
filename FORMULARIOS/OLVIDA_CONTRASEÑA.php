<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $cambia_contraseña=isset($_POST['cambia_contraseña'])?$_POST['cambia_contraseña']:"";
        $num_errores=0;

        if ($cambia_contraseña){
            $DNI=$_POST['DNI'];
            $password=$_POST['password'];
            $password_repeat=$_POST['password-repeat'];

            $existe = false;
            $User = null;
            $Usuarios = BD_CANDIDATO::FindAll();

            if (is_array($Usuarios) && count($Usuarios) > 0) {

                $validador=new VALIDATOR();

                if (!$validador->validaDNI($DNI)){
                    $num_errores++;
                }

                if (!$validador->validaContraseña($password)) {
                    $num_errores++;
                }

                if (!$validador->validaContraseña($password_repeat)){
                    $num_errores++;
                }


                if ($num_errores==0){
                    if ($password==$password_repeat){
                    foreach ($Usuarios as $usuario) {
                        if ($usuario->getDNI() == $DNI) {
                            $existe = true;
                        }

                        if ($existe){
                            $candidato = BD_CANDIDATO::FindByID($DNI);
                            $cifrada = password_hash($password_repeat, PASSWORD_DEFAULT);
                            $candidato->setContraseña($cifrada);
                            BD_CANDIDATO::UpdateByID($DNI, $candidato);
                            //header("Location: http://localhost/Manejo-Becas/index.php?menu=inicio");
                        }
                    }
                    }
                }else{
                    echo $num_errores;
                }
            } else {
                $mensajeError = "El usuario no existe";
            }
        }
    }
?>
<main id="contenedor-cambia-contraseña">
    <form method="post">
        <section id="volver-cambia-contraseña">
            <img src="../Manejo-Becas/IMAGENES/volver.png">
        </section>
        <section id="contenido-cambia-contraseña">
            <section id="contenedor-dni-cambia-contraseña">
                <article id="lblDNI-cambia-contraseña">
                    <label>DNI</label>
                </article>
                <article id="txtDNI-cambia-contraseña">
                    <input type="text" name="DNI">
                </article>
            </section>
            <section id="contenedor-contraseña-cambia-contraseña">
                <article id="lblContraseña-cambia-contraseña">
                    <label>CONTRASEÑA</label>
                </article>
                <article id="txtContraseña-cambia-contraseña">
                    <input type="text" name="password" placeholder="Introduzca la contraseña nueva...">
                </article>
            </section>
            <section id="contenedor-contraseña-cambia-contraseña">
                <article id="lblContraseña-cambia-contraseña">
                    <label> REPITE CONTRASEÑA</label>
                </article>
                <article id="txtContraseña-cambia-contraseña">
                    <input type="text" name="password-repeat" placeholder="Repita la contraseña nueva...">
                </article>
            </section>
        </section>
        <section id="btns-cambia-contraseña">
            <input type="submit" value="CAMBIAR CONTRASEÑA" name="cambia_contraseña">
        </section>
    </form>
</main>