<?php
    SESSION::CreaSesion();
    $mensajeErrorNombre="";
    $mensajeErrorProyecto="";
    $mensajeErrorMovilidades="";
    $mensajeErrorDestino="";
    $mensajeErrorFechaInicio="";
    $mensajeErrorFechaFin="";
    $mensajeErrorFechaInicioPruebas="";
    $mensajeErrorFechaFinPruebas="";
    $mensajeErrorFechaListadoProvisional="";
    $mensajeErrorFechaListadoDefinitivo="";
    $mensajeErrorDestinatarios="";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $num_errores=0;
        $crea=isset($_POST['crea'])?$_POST['crea']:"";
        $logout=isset($_POST['logout'])?$_POST['logout']:"";
        $actualiza=isset($_POST['actualiza'])?$_POST['actualiza']:"";
        if ($logout){
            SESSION::Cerrar_Sesion();
        }
        if ($crea){
            $proyecto=$_POST['proyecto'];
            $movilidades=$_POST['movilidades'];
            $destino=$_POST['destino'];
            $fechainicio=$_POST['fechainicio'];
            $fechafin=$_POST['fechafin'];
            $fechainicioPruebas=$_POST['fechainicioPruebas'];
            $fechafinPruebas=$_POST['fechafinPruebas'];
            $fechalistadoprovisional=$_POST['fechalistadoprovisional'];
            $fechalistadodefinitivo=$_POST['fechalistadodefinitivo'];
            $nombre=$_POST['nombre'];

            $validador=new VALIDATOR();

            if ($validador->validaNombre($nombre,100,1)){

            }else{
                $num_errores++;
                $mensajeErrorNombre="Nombre no válido";
            }

            if ($validador->validaNombre($proyecto,100,1)){

            }else{
                $num_errores++;
                $mensajeErrorProyecto="Proyecto no válido";
            }

            if ($movilidades>0){

            }else{
                $num_errores++;
                $mensajeErrorMovilidades="Movilidades no válidas";
            }

            if ($validador->validaNombre($destino,100,1)){

            }else{
                $num_errores++;
                $mensajeErrorDestino="Destino no válido";
            }

            if ($validador->validaFecha($fechainicio)){

            }else{
                $num_errores++;
                $mensajeErrorFechaInicio="Fecha inicio no válida";
            }

            if ($validador->validaFecha($fechafin)&&$fechafin>$fechainicio){

            }else{
                $num_errores++;
                $mensajeErrorFechaFin="Fecha fin no válida";
            }

            if ($validador->validaFecha($fechainicioPruebas)&&$fechainicioPruebas >= $fechainicio&&$fechainicioPruebas<=$fechafin){

            }else{
                $num_errores++;
                $mensajeErrorFechaInicioPruebas="Fecha inicio pruebas no válida";
            }

            if ($validador->validaFecha($fechafinPruebas)&&$fechainicioPruebas<$fechafinPruebas){

            }else{
                $num_errores++;
                $mensajeErrorFechaFinPruebas="Fecha fin pruebas no válida";
            }

            if ($validador->validaFecha($fechalistadoprovisional)&&$fechalistadoprovisional>$fechafinPruebas){

            }else{
                $num_errores++;
                $mensajeErrorFechaListadoProvisional="Fecha listado provisional no válida";
            }

            if ($validador->validaFecha($fechalistadodefinitivo)&&$fechalistadodefinitivo>$fechalistadoprovisional){

            }else{
                $num_errores++;
                $mensajeErrorFechaListadoDefinitivo="Fecha listado definitivo no válido";
            }

            $destinatarios=BD_DESTINATARIOS::FindAll();
            $desti=[];
            for ($i = 0; $i<count($destinatarios); $i++) {
                if (isset($_POST['boton' . $i])) {
                    $destinatario=$destinatarios[$i];
                    $desti[]=$destinatario;
                }
            }

            if ($desti!=null){

            }else{
                $num_errores++;
                $mensajeErrorDestinatarios="No existen desinatarios";
            }
            
            $maximas = [];
            $requisitos = [];
            $minimas = [];
            $aportas = [];
            $baremo=[];
            $baremos=BD_ITEMBAREMABLE::FindAll();
            $idioma=null;
            for ($i = 0; $i < count($baremos); $i++) {
                if (isset($_POST['boton_baremo'.$i])){
                    if ($baremos[$i]->getNombre()!=="Idioma"){
                        $bar=$baremos[$i];
                        $maximas[] = $_POST['maxima'.$i];
                        $requisitos[] = $_POST['requisito'.$i];
                        $minimas[] = $_POST['minima'.$i];
                        $aportas[] = $_POST['aporta'.$i];
                        $baremo[]=$bar;
                    }else{
                        $idioma=$baremos[$i];
                    }
                }
            }
            
            if ($baremo!=null){
                for ($i=0;$i<count($maximas);$i++){
                    if ($maximas[$i]>1){
    
                    }else{
                        $num_errores++;
                        $mensajeErrorNotaMaxima="Nota máxima no válida";
                    }
                }
    
                for ($i=0;$i<count($requisitos);$i++){
                    if ($requisitos[$i]!==null){
    
                    }else{
                        $num_errores++;
                        $mensajeErrorRequisito="Requisito no válido";
                    }
                }
    
                for ($i=0;$i<count($minimas);$i++){
                    if ($minimas[$i]>0){
                        
                    }else{
                        $num_errores++;
                        $mensajeErrorNotaMinima="Nota mínima no válida";
                    }
                }
    
                for ($i=0;$i<count($aportas);$i++){
                    if ($aportas[$i]>0){
    
                    }else{
                        $num_errores++;
                        $mensajeErrorAporta="No has puesto si lo aporta o no";
                    }
                }
            }else{
                $num_errores++;
            }

            if ($num_errores==0){
                BD_CONVOCATORIA::Transaccion($proyecto,$fechainicio,$fechafin,$movilidades,$fechainicioPruebas,
                $fechafinPruebas,$fechalistadoprovisional,$fechalistadodefinitivo,$destino,$nombre,$baremo,$desti,$maximas,
                $requisitos,$minimas,$aportas,$idioma);
            }else{
                
            }

        }
    }
?>

    <main id="crud">
        <h1 id="titulo">CREACIÓN CONVOCATORIA</h1>
        <section id="section-general">
            <form method="post">
                <span id="span-nombre">Nombre:</span>
                <input id="txtNombre" type="text" name="nombre">
                <?php
                    if ($mensajeErrorNombre!==""){
                        echo '<span class="error">'.$mensajeErrorNombre.'</span>';
                    }
                ?>  
                <span id="span-proyecto">Proyecto:</span>
                <select id="select-proyecto" name="proyecto" id="select">
                    <?php
                    $proyectos = BD_PROYECTO::FindAll();
                    if ($proyectos != null) {
                        for ($i = 0; $i < count($proyectos); $i++) {
                            echo '<option value="' . $proyectos[$i]->getNombre() . '">' . $proyectos[$i]->getNombre() . '</option>';
                        }
                    } else {
                        echo "No existen proyectos";
                    }
                    ?>
                </select><br>
                <?php
                    if ($mensajeErrorProyecto!==""){
                        echo '<span class="error">'.$mensajeErrorMovilidades.'</span>';
                    }
                ?>  
                <span id="span-destinatario">Destinatario:</span><br>
                <?php
                    if ($mensajeErrorDestinatarios!==""){
                        echo '<span class="error">'.$mensajeErrorDestinatarios.'</span>';
                    }
                ?>  
                <table id="tabla-destinatario" border="1">
                    <thead>
                        <th>NOMBRE:</th>
                        <th>MARCADO</th>
                    </thead>
                    <tbody>
                        <?php
                        $destinatarios = BD_DESTINATARIOS::FindAll();
                        if ($destinatarios != null) {
                            for ($i = 0; $i < count($destinatarios); $i++) {
                                $destinatario = $destinatarios[$i];
                                echo '<tr>
                                    <td> ' . $destinatario->getNombre() . '</td>
                                    <td>  <input type="checkbox" name="boton'.$i.'"> </td>
                                </tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table><br>
                <span id="span-movilidades">Movilidades</span>
                <input id="txt-movilidades" name="movilidades" type="number"><br>
                <?php
                    if ($mensajeErrorMovilidades!==""){
                        echo '<span class="error">'.$mensajeErrorMovilidades.'</span>';
                    }
                ?>  
                <span id="span-pais">País de destino:</span>
                <input id="txt-pais" name="destino" type="text"><br>
                <?php
                    if ($mensajeErrorDestino!==""){
                        echo '<span class="error">'.$mensajeErrorDestino.'</span>';
                    }
                ?>  
                <span id="span-fecha-inicio">Fecha de inicio:</span>
                <input id="fecha-inicio" name="fechainicio" type="datetime-local"><br>
                <?php
                    if ($mensajeErrorFechaInicio!==""){
                        echo '<span class="error">'.$mensajeErrorFechaInicio.'</span>';
                    }
                ?>  
                <span id="span-fecha-fin">Fecha de fin:</span>
                <input id="fecha-fin" name="fechafin" type="datetime-local"><br>
                <?php
                    if ($mensajeErrorFechaFin!==""){
                        echo '<span class="error">'.$mensajeErrorFechaFin.'</span>';
                    }
                ?>  
                <span id="span-fecha-inicio-pruebas">Fecha Inicio de Pruebas:</span>
                <input id="fecha-inicio-pruebas" name="fechainicioPruebas" type="datetime-local"><br>
                <?php
                    if ($mensajeErrorFechaInicioPruebas!==""){
                        echo '<span class="error">'.$mensajeErrorFechaInicioPruebas.'</span>';
                    }
                ?>  
                <span id="span-fecha-fin-pruebas">Fecha Fin de Pruebas:</span>
                <input id="fecha-fin-pruebas" name="fechafinPruebas" type="datetime-local"><br>
                <?php
                    if ($mensajeErrorFechaFinPruebas!==""){
                        echo '<span class="error">'.$mensajeErrorFechaFinPruebas.'</span>';
                    }
                ?>
                <span id="span-fecha-provisional">Fecha Listado Provisional:</span>
                <input id="fecha-provisional" name="fechalistadoprovisional" type="datetime-local"><br>
                <?php
                    if ($mensajeErrorFechaListadoProvisional!==""){
                        echo '<span class="error">'.$mensajeErrorFechaListadoProvisional.'</span>';
                    }
                ?>
                <span id="span-definitivo">Fecha Listado Definitivo:</span>
                <input id="fecha-definitivo" name="fechalistadodefinitivo" type="datetime-local"><br>
                <?php
                    if ($mensajeErrorFechaListadoDefinitivo!==""){
                        echo '<span class="error">'.$mensajeErrorFechaListadoDefinitivo.'</span>';
                    }
                ?>
                <span id="span-baremo">Baremos:</span><br>
                <table id="tabla-baremo">
                    <thead>
                        <th>MARCADO</th>
                        <th>NOMBRE BAREMO</th>
                        <th>NOTA MÁXIMA</th>
                        <th>REQUISITO</th>
                        <th>NOTA MÍNIMA</th>
                        <th>APORTA ALUMNO</th>
                    </thead>
                    <tbody>
                        <?php
                        $baremos = BD_ITEMBAREMABLE::FindAll();
                        if ($baremos != null) {
                            for ($i = 0; $i < count($baremos); $i++) {
                                $baremo = $baremos[$i];
                                echo '<tr>
                                    <td>  <input type="checkbox" name="boton_baremo'.$i.'"> </td>
                                    <td>' . $baremo->getNombre() . '</td>';
                                    
                                    if ($baremo->getNombre()!=="Idioma"){
                                        echo '<td><input name="maxima'.$i.'" type="number"></td>';
                                        echo '<td><select name="requisito'.$i.'"><option>Sí</option><option>No</option></select></td>';
                                        echo '<td><input name="minima'.$i.'" type="number"></td>';
                                        echo '<td><select name="aporta'.$i.'"><option>Sí</option><option>No</option></select></td>';
                                    }
                                echo '</tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <table id="tabla-idioma">
                    <thead>
                        <th>NIVEL</th>
                        <th>NOTA</th>
                    </thead>
                    <tbody>
                        <?php
                        $idiomas = BD_IDIOMA::FindAll();
                        if ($idiomas != null) {
                            for ($i = 0; $i < count($idiomas); $i++) {
                                $idioma = $idiomas[$i];
                                echo '<tr>
                                    <td>' . $idiomas[$i]->getTitulo() . '</td>
                                    <td><input name="notaidioma'.$i.'" type="number step="any""></td>
                                </tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
        </section>
        <section id="botones">
            <input id="crea" type="submit" value="CREAR CONVOCATORIA" name="crea">
        </section>
        </form>
    </main>