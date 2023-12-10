<?php
    $mensajeErrorDNI="";
    $mensajeErrorEmail="";
    $mensajeErrorNombre="";
    $mensajeErrorApellido1="";
    $mensajeErrorCorreo="";
    $mensajeErrorDomicilio="";
    $mensajeErrorContraseña="";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $registro=isset($_POST['registro'])?$_POST['registro']:"";
        $num_errores=0;
        if ($registro){
            $DNI=$_POST['DNI'];
            $nombre=$_POST['nombre'];
            $apellido1=$_POST['apellido1'];
            $apellido2=$_POST['apellido2'];
            $contraseña=$_POST['contraseña'];
            $correo=$_POST['correo'];
            $domicilio=$_POST['domicilio'];
            $password="";
            $cursoSeleccionado = isset($_POST['curso']) ? $_POST['curso'] : "";

            if ($cursoSeleccionado==""){
                $num_errores++;
            }

            //llamamos al objeto que se va a encargar de validar los Datos
            $validador=new VALIDATOR();
            if ($validador->validaDNI($DNI)){
               
            }else{
                $mensajeErrorDNI="El DNI no es válido";
                $num_errores++;
            }

            if ($validador->validaNombre($nombre,50,1)){
                
            }else{
                $mensajeErrorNombre="El nombre no puede estar vacío";
                $num_errores++;
            }

            if ($validador->validaApellido($apellido1,100,1)){
                
            }else{
                $mensajeErrorApellido1="El apellido no puede estar vacío";
                $num_errores++;
            }

            if ($validador->validaContraseña($contraseña)){
                
            }else{
                $mensajeErrorContraseña="La contraseña no está en el formato correcto";
                $num_errores++;
            }

            if ($validador->validaCorreo($correo)){
                
            }else{
                $mensajeErrorCorreo="Formato de correo electrónico no válido";
                $num_errores++;
            }

            if ($validador->validaDomicilio($domicilio,500,1)){
                
            }else{
                $mensajeErrorDomicilio="El domicilio no puede estar vacío";
                $num_errores++;
            }

            if ($num_errores==0){
                $curso=BD_DESTINATARIOS::FindByID($cursoSeleccionado);
                $candidato=new CANDIDATO($DNI,null,null,$apellido1,$apellido2,$nombre,$contraseña,$curso,null,$correo,$domicilio,"ALUMNO");
                BD_CANDIDATO::Insert($candidato);
                header("Location: http://localhost/Manejo-Becas/index.php?menu=inicio");
            }   
        }
    }
?>
<main id="contenedor-registro">
    <h1 style="margin-left: 65%;">REGISTRO</h1>
    <form id="form-registro" method="post">
        <section class="section" id="contenido-registro">
            <section class="section" id="contenedor-DNI-registro">
                <article id="lblDNI-registro">
                    <label>DNI</label>
                </article>
                <article id="txtDNI-registro">
                    <input class="inputs" type="text" name="DNI" value="<?php echo isset($_POST['DNI'])?$_POST['DNI']:"";?>">
                </article>
                <article>
                    <?php
                        if ($mensajeErrorDNI!=""){
                            echo '<p class="error">'.$mensajeErrorDNI."</p>";
                        }
                    ?>
                </article>
            </section>
            <section class="section" id="contenedor-nombre-registro">
                <article id="lblNombre-registro">
                    <label>NOMBRE</label>
                </article>
                <article id="txtNombre-registro">
                    <input class="inputs" type="text" name="nombre" value="<?php echo isset($_POST['nombre'])?$_POST['nombre']:"";?>">
                </article>
                <article>
                    <?php
                        if ($mensajeErrorNombre!=""){
                            echo '<p class="error">'.$mensajeErrorNombre."</p>";
                        }
                    ?>
                </article>
            </section>
            <section class="section" id="contenedor-apellido1-registro">
                <article id="lblapellido1-registro">
                    <label>PRIMER APELLIDO</label>
                </article>
                <article id="txtapellido1-registro">
                    <input class="inputs" type="text" name="apellido1" value="<?php echo isset($_POST['apellido1'])?$_POST['apellido1']:"";?>">
                </article>
                <article>
                    <?php
                        if ($mensajeErrorApellido1!=""){
                            echo '<p class="error">'.$mensajeErrorApellido1."</p>";
                        }
                    ?>
                </article>
            </section>
            <section class="section" id="contenedor-apellido2-registro">
                <article id="lblapellido2-registro">
                    <label>SEGUNDO APELLIDO</label>
                </article>
                <article id="txtapellido2-registro">
                    <input class="inputs" type="text" name="apellido2" value="<?php echo isset($_POST['apellido2'])?$_POST['apellido2']:"";?>">
                </article>
            </section>
            <section class="section" id="contenedor-contraseña-registro">
                <article id="lblcontraseña-registro">
                    <label>CONTRASEÑA</label>
                </article>
                <article id="txtcontraseña-registro">
                    <input class="inputs" type="text" name="contraseña" value="<?php echo isset($_POST['contraseña'])?$_POST['contraseña']:"";?>">
                </article>
                <article>
                    <?php
                        if ($mensajeErrorContraseña!=""){
                            echo '<p class="error">'.$mensajeErrorContraseña."</p>";
                        }
                    ?>
                </article>
            </section>
            <section class="section" id="contenedor-correo-registro">
                <article id="lblcorreo-registro">
                    <label>CORREO ELECTRÓNICO</label>
                </article>
                <article id="txtcorreo-registro">
                    <input class="inputs" type="email" name="correo" value="<?php echo isset($_POST['correo'])?$_POST['correo']:"";?>">
                </article>
                <article>
                    <?php
                        if ($mensajeErrorCorreo!=""){
                            echo '<p class="error">'.$mensajeErrorCorreo."</p>";
                        }
                    ?>
                </article>
            </section>
            <section class="section" id="contenedor-domicilio-registro">
                <article id="lbldomicilio-registro">
                    <label>DOMICILIO</label>
                </article>
                <article id="txtdomicilio-registro">
                    <input class="inputs" type="text" name="domicilio" value="<?php echo isset($_POST['domicilio'])?$_POST['domicilio']:"";?>">
                </article>
                <article>
                    <?php
                        if ($mensajeErrorDomicilio!=""){
                            echo '<p class="error">'.$mensajeErrorDomicilio.'</p>';
                        }
                    ?>
                </article>
            </section>
            <section class="section" id="contenedor-curso-registro">
                <article id="lblcurso-registro">
                    <label>DESTINATARIO:</label><br>
                </article>
                <article id="txtcurso-registro">
                    <table>
                        <thead>
                            <th>MARCAR CURSO</th>
                            <th>NOMBRE CURSO</th>
                            <th>CÓDIGO CURSO</th>
                        </thead>
                        <tbody>
                            <?php
                                $cursos=BD_DESTINATARIOS::FindAll();
                                for ($i=0;$i<count($cursos);$i++){
                                    echo '<tr>
                                            <td><input type="radio" name="curso" value="'.$cursos[$i]->getCodigoGrupo().'">
                                            <td>'.$cursos[$i]->getNombre().'</td>
                                            <td>'.$cursos[$i]->getCodigoGrupo().'</td>
                                          </tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </article>
                <article>
                    <?php
                        if ($mensajeErrorDomicilio!=""){
                            echo '<p class="error">'.$mensajeErrorDomicilio.'</p>';
                        }
                    ?>
                </article>
            </section>
        </section>
        <section id="btns-Registro">
            <input type="submit" value="REGISTRARSE" name="registro">
        </section>
    </form>
</main>