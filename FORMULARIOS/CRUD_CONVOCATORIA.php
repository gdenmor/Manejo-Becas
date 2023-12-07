<?php
    SESSION::CreaSesion();
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
                echo "Nombre no válido";
            }

            if ($validador->validaNombre($proyecto,100,1)){

            }else{
                $num_errores++;
                echo "Proyecto no válido";
            }

            if ($movilidades>0){

            }else{
                $num_errores++;
                echo "Movilidades no válidas";
            }

            if ($validador->validaNombre($destino,100,1)){

            }else{
                $num_errores++;
                echo "Destino no válido";
            }

            if ($validador->validaFecha($fechainicio)){

            }else{
                $num_errores++;
                echo "Fcha inicio no válida";
            }

            if ($validador->validaFecha($fechafin)&&$fechafin>$fechainicio){

            }else{
                $num_errores++;
                echo "Fecha fin no válida";
            }

            if ($validador->validaFecha($fechainicioPruebas)&&$fechainicioPruebas >= $fechainicio&&$fechainicioPruebas<=$fechafin){

            }else{
                $num_errores++;
                echo "Fecha inicio pruebas no válida";
            }

            if ($validador->validaFecha($fechafinPruebas)&&$fechainicioPruebas<$fechafinPruebas){

            }else{
                $num_errores++;
                echo "Fecha fin pruebas no válida";
            }

            if ($validador->validaFecha($fechalistadoprovisional)&&$fechalistadoprovisional>$fechafinPruebas){

            }else{
                $num_errores++;
                echo "Fecha listado provisional no válida";
            }

            if ($validador->validaFecha($fechalistadodefinitivo)&&$fechalistadodefinitivo>$fechalistadoprovisional){

            }else{
                $num_errores++;
                echo "Fecha listado definitivo no válido";
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
                echo "No existen desinatarios";
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
                        echo "Nota máxima no válida";
                    }
                }
    
                for ($i=0;$i<count($requisitos);$i++){
                    if ($requisitos[$i]!==null){
    
                    }else{
                        $num_errores++;
                        echo "Requisito no válido";
                    }
                }
    
                for ($i=0;$i<count($minimas);$i++){
                    if ($minimas[$i]>0){
                        
                    }else{
                        $num_errores++;
                        echo "Nota mínima no válida";
                    }
                }
    
                for ($i=0;$i<count($aportas);$i++){
                    if ($aportas[$i]>0){
    
                    }else{
                        $num_errores++;
                        echo "No has puesto si lo aporta o no";
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
                echo '<p style="margin-left: 50%; z-index: 199;">'.$num_errores.'</p>';
            }

        }

        /*if ($actualiza){
            $id=$_POST['id'];
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

            if ($validador->validaNombre($nombre,100,1)){

            }else{
                $num_errores++;
            }

            $validador=new VALIDATOR();

            if ($validador->validaNombre($proyecto,100,1)){

            }else{
                $num_errores++;
            }

            if ($movilidades>0){

            }else{
                $num_errores++;
            }

            if ($validador->validaNombre($destino,100,1)){

            }else{
                $num_errores++;
            }

            if ($validador->validaFecha($fechainicio)){

            }else{
                $num_errores++;
            }

            if ($validador->validaFecha($fechafin)&&$fechafin>$fechainicio){

            }else{
                $num_errores++;
            }

            if ($validador->validaFecha($fechainicioPruebas)&&$fechainicioPruebas >= $fechainicio&&$fechainicioPruebas<=$fechafin){

            }else{
                $num_errores++;
            }

            if ($validador->validaFecha($fechafinPruebas)&&$fechainicioPruebas<$fechafinPruebas){

            }else{
                $num_errores++;
            }

            if ($validador->validaFecha($fechalistadoprovisional)&&$fechalistadoprovisional>$fechafinPruebas){

            }else{
                $num_errores++;
            }

            if ($validador->validaFecha($fechalistadodefinitivo)&&$fechalistadodefinitivo>$fechalistadoprovisional){

            }else{
                $num_errores++;
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
            }

            $baremo=[];
            $baremos=BD_ITEMBAREMABLE::FindAll();
            for ($i = 0; $i<count($baremos); $i++) {
                if (isset($_POST['boton_baremo' . $i])) {
                    $bar=$baremos[$i];
                    $baremo[]=$bar;
                }
            }

            if ($baremo!=null){
                
            }else{
                $num_errores++;
            }


            if ($num_errores==0){
                $Proyecto=BD_PROYECTO::FindByNombre($proyecto);
                $tipo="";
                $fechaini=new DateTime($fechainicio);
                $fechaf=new DateTime($fechafin);
                $diff=$fechaf->diff($fechaini);
                $dias=$diff->days;
                if ($dias>=90){
                    $tipo="Larga";
                }else{
                    $tipo="Corta";
                }
                
                $convocatoria=new CONVOCATORIA(null,$movilidades,$tipo,$fechainicio,$fechafin,$fechainicioPruebas,$fechafinPruebas,$fechalistadoprovisional,$fechalistadodefinitivo,$Proyecto,$destino,$nombre);
                BD_CONVOCATORIA::UpdateByID($id,$convocatoria);
            }
        }*/
    }
?>

    <main id="crud">
        <h1 id="titulo">CREACIÓN CONVOCATORIA</h1>
        <h2 id="subt">Si desea actualizar los baremos no serán actualizables</h2>
        <section id="section-general">
            <form method="post">
                <span id="span-nombre">Nombre:</span>
                <input id="txtNombre" type="text" name="nombre">
                <span id="span-id">ID:</span>
                <input id="txt-id" type="number" text="id" name="id">
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
                <span id="span-destinatario">Destinatario:</span>
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
                <span id="span-pais">País de destino:</span>
                <input id="txt-pais" name="destino" type="text"><br>
                <span id="span-fecha-inicio">Fecha de inicio:</span>
                <input id="fecha-inicio" name="fechainicio" type="datetime-local"><br>
                <span id="span-fecha-fin">Fecha de fin:</span>
                <input id="fecha-fin" name="fechafin" type="datetime-local"><br>
                <span id="span-fecha-inicio-pruebas">Fecha Inicio de Pruebas:</span>
                <input id="fecha-inicio-pruebas" name="fechainicioPruebas" type="datetime-local"><br>
                <span id="span-fecha-fin-pruebas">Fecha Fin de Pruebas:</span>
                <input id="fecha-fin-pruebas" name="fechafinPruebas" type="datetime-local"><br>
                <span id="span-fecha-provisional">Fecha Listado Provisional:</span>
                <input id="fecha-provisional" name="fechalistadoprovisional" type="datetime-local"><br>
                <span id="span-definitivo">Fecha Listado Definitivo:</span>
                <input id="fecha-definitivo" name="fechalistadodefinitivo" type="datetime-local"><br>
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
                                    <td>' . $baremo->getNombre() . '</td>
                                    <td><input name="maxima'.$i.'" type="number"></td>';
                                    if ($baremo->getNombre()!=="Idioma"){
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
                    <input id="actualiza" type="submit" value="ACTUALIZAR CONVOCATORIA" name="actualiza">
                    <a href="http://localhost/Manejo-Becas/index.php?menu=mostrarConvocatorias"><input id="mostrar" type="button" value="MOSTRAR CONVOCATORIAS"></a>
        </section>
        </form>
    </main>