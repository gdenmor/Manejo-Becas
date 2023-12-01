<h1>FORMULARIO SOLICITUD</h1>
<main id="contenedor-registro">
    <form method="post">
        <section id="contenido-registro">
            <section id="contenedor-DNI-registro">
                <article id="lblDNI-registro">
                    <label>DNI</label>
                </article>
                <article id="txtDNI-registro">
                    <input type="text" name="DNI" value="<?php echo isset($_POST['DNI'])?$_POST['DNI']:"";?>">
                </article>
                <article id="errorDNI">
                    
                </article>
            </section>
            <section id="contenedor-nombre-registro">
                <article id="lblNombre-registro">
                    <label>NOMBRE</label>
                </article>
                <article id="txtNombre-registro">
                    <input type="text" name="nombre" value="<?php echo isset($_POST['nombre'])?$_POST['nombre']:"";?>">
                </article>
                <article id="errorNombre">
                    
                </article>
            </section>
            <section id="contenedor-apellido1-registro">
                <article id="lblapellido1-registro">
                    <label>PRIMER APELLIDO</label>
                </article>
                <article id="txtapellido1-registro">
                    <input type="text" name="apellido1" value="<?php echo isset($_POST['apellido1'])?$_POST['apellido1']:"";?>">
                </article>
                <article id="errorApellido1">
                    
                </article>
            </section>
            <section id="contenedor-apellido2-registro">
                <article id="lblapellido2-registro">
                    <label>SEGUNDO APELLIDO</label>
                </article>
                <article id="txtapellido2-registro">
                    <input type="text" name="apellido2" value="<?php echo isset($_POST['apellido2'])?$_POST['apellido2']:"";?>">
                </article>
            </section>
            <section id="contenedor-contraseña-registro">
                <article id="lblcontraseña-registro">
                    <label>CONTRASEÑA</label>
                </article>
                <article id="txtcontraseña-registro">
                    <input type="text" name="contraseña" value="<?php echo isset($_POST['contraseña'])?$_POST['contraseña']:"";?>">
                </article>
                <article id="errorContraseña">
                    
                </article>
            </section>
            <section id="contenedor-correo-registro">
                <article id="lblcorreo-registro">
                    <label>CORREO ELECTRÓNICO</label>
                </article>
                <article id="txtcorreo-registro">
                    <input type="email" name="correo" value="<?php echo isset($_POST['correo'])?$_POST['correo']:"";?>">
                </article>
                <article id="errorCorreo">
                    
                </article>
            </section>
            <section id="contenedor-domicilio-registro">
                <article id="lbldomicilio-registro">
                    <label>DOMICILIO</label>
                </article>
                <article id="txtdomicilio-registro">
                    <input type="text" name="domicilio" value="<?php echo isset($_POST['domicilio'])?$_POST['domicilio']:"";?>">
                </article>
                <article id="errorDomicilio">
                    
                </article>
            </section>
        </section>
        <section id="btns-Login">
            <input type="submit" value="SOLICITAR" name="solicita">
        </section>
    </form>
</main>