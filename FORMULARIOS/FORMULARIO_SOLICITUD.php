<main>
    <h1 id="tituloSolicitud">FORMULARIO SOLICITUD</h1>
    <section id="contenedor-contenido">
        <form method="post" enctype="multipart/form-data">
            <section id="contenido-solicitud">
                <section class="section" id="contenedor-DNI-solicitud">
                    <article id="lblDNI-solicitud">
                        <label>DNI</label>
                    </article>
                    <article id="txtDNI-solicitud">
                        <input disabled type="text" name="DNI" value="<?php echo isset($_POST['DNI']) ? $_POST['DNI'] : ""; ?>">
                    </article>
                </section>
                <article id="errorDNI">
                        <span id="mensajeDNI"></span>
                </article>
                <section class="section" id="contenedor-nombre-solicitud">
                    <article id="lblNombre-solicitud">
                        <label>NOMBRE</label>
                    </article>
                    <article id="txtNombre-solicitud">
                        <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ""; ?>">
                    </article>
                </section>
                <article id="errorNombre">
                    <span id="mensajeNombre"></span>
                </article>
                <section class="section" id="contenedor-apellido1-solicitud">
                    <article id="lblapellido1-solicitud">
                        <label>PRIMER APELLIDO</label>
                    </article>
                    <article id="txtapellido1-solicitud">
                        <input type="text" name="apellido1" value="<?php echo isset($_POST['apellido1']) ? $_POST['apellido1'] : ""; ?>">
                    </article>
                </section>
                <article id="errorApellido1">
                    <span id="mensajeApellido1"></span>
                </article>
                <section class="section" id="contenedor-apellido2-solicitud">
                    <article id="lblapellido2-solicitud">
                        <label>SEGUNDO APELLIDO</label>
                    </article>
                    <article id="txtapellido2-solicitud">
                        <input type="text" name="apellido2" value="<?php echo isset($_POST['apellido2']) ? $_POST['apellido2'] : ""; ?>">
                    </article>
                </section>
                <section class="section" id="contenedor-contraseña-solicitud">
                    <article id="lblcontraseña-solicitud">
                        <label>CONTRASEÑA</label>
                    </article>
                    <article id="txtcontraseña-solicitud">
                        <input disabled type="text" name="contraseña" value="<?php echo isset($_POST['contraseña']) ? $_POST['contraseña'] : ""; ?>">
                    </article>
                </section>
                <article id="errorContraseña">
                    <span id="mensajeContraseña"></span>
                </article>
                <section class="section" id="contenedor-correo-solicitud">
                    <article id="lblcorreo-solicitud">
                        <label>CORREO ELECTRÓNICO</label>
                    </article>
                    <article id="txtcorreo-solicitud">
                        <input type="email" name="correo" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : ""; ?>">
                    </article>
                </section>
                <article id="errorCorreo">
                    <span id="mensajeCorreo"></span>
                </article>
                <section class="section" id="contenedor-domicilio-solicitud">
                    <article id="lbldomicilio-solicitud">
                        <label>DOMICILIO</label>
                    </article>
                    <article id="txtdomicilio-solicitud">
                        <input type="text" name="domicilio" value="<?php echo isset($_POST['domicilio']) ? $_POST['domicilio'] : ""; ?>">
                    </article>
                </section>
                <article id="errorDomicilio">
                        <span id="mensajeDomicilio"></span>
                </article>
                <section class="section">
                    <article>
                        <label>Fecha de Nacimiento</label>
                    </article>
                    <article>
                        <input type="datetime-local" name="nacimiento">
                    </article>
                </section>
                <section class="section">
                    <article>
                        <label>Curso</label>
                    </article>
                    <article>
                        <input type="text" name="curso" disabled>
                    </article>
                </section>
                <article id="errorCurso">
                    <span id="mensajeCurso"></span>
                </article>
                <section class="section">
                    <article>
                        <label>Teléfono:</label>
                    </article>
                    <article>
                        <input type="text" name="tlf">
                    </article>
                </section>
                <article id="errorTlf">
                    <span id="mensajetlf"></span>
                </article>
                <section class="section">
                    <article>
                        <label>Rol:</label>
                    </article>
                    <article>
                        <input disabled type="text" name="rol">
                    </article>
                </section>
                <article id="errorRol">
                    <span></span>
                </article>
            </section>
        </form>
    </section>
    <section id="btn">
        <input name="solicita" type="button" value="SOLICITAR">
    </section>
</main>