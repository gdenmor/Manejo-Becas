<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $actualiza=isset($_POST['actualiza'])?$_POST['actualiza']:"";
        if ($actualiza){
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
            $num_errores=0;

            $validador=new VALIDATOR();
    
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
                
                $convocatoria=new CONVOCATORIA(null,$movilidades,$tipo,$fechainicio,$fechafin,$fechainicioPruebas,$fechafinPruebas,$fechalistadoprovisional,$fechalistadodefinitivo,$Proyecto,$destino,$nombre,null,null);
                BD_CONVOCATORIA::UpdateByID($id,$convocatoria);
                $id=BD_CONVOCATORIA::sacarID();
                $convocatoria->setID($id);
                BD_DESTINATARIOS_CONVOCATORIAS::DeleteByConvocatoria($id);
                BD_CONVOCATORIA_BAREMABLE::DeleteByID_Convocatoria($id);
                BD_CONVOCATORIA_BAREMABLE_IDIOMA::DeleteByID($id);
                for ($i = 0; $i < count($desti); $i++) {
                    $destielegido = $desti[$i];
                    $destinatario_conv = new DESTINATARIO_CONVOCATORIA(null, $convocatoria, $destielegido);
                    BD_DESTINATARIOS_CONVOCATORIAS::Insert($destinatario_conv);
                }
                for ($i = 0; $i < count($baremo); $i++) {
                    $baremoelegido = $baremo[$i];
                    if ($baremoelegido->getNombre() !== "Idioma") {
                        $convocatoria_baremable = new CONVOCATORIA_BAREMABLE(null, $convocatoria, $baremoelegido, $maximas[$i], $requisitos[$i], $minimas[$i], $aportas[$i]);
                        BD_CONVOCATORIA_BAREMABLE::Insert($convocatoria_baremable);
                    }
                }

                if ($idioma!=null){
                    $errores=0;
                    $niveles=BD_IDIOMA::FindAll();
                    for ($i=0;$i<count($niveles);$i++){
                        if (isset($_POST['notaidioma'.$i])&&$_POST['notaidioma'.$i]>0){
                            $nota= (int)$_POST['notaidioma'.$i];
                            if ($i==0){
                                $convocatoria_baremo_idioma=new CONVOCATORIA_BAREMABLE_IDIOMA(null,$convocatoria,$niveles[$i],$idioma,$nota);
                                BD_CONVOCATORIA_BAREMABLE_IDIOMA::Insert($convocatoria_baremo_idioma);
                            }else{
                                    $convocatoria_baremo_idioma=new CONVOCATORIA_BAREMABLE_IDIOMA(null,$convocatoria,$niveles[$i],$idioma,$nota);
                                    BD_CONVOCATORIA_BAREMABLE_IDIOMA::Insert($convocatoria_baremo_idioma);
                            }
                        }else{
                            $errores++;
                        }
                    }
    
                    if ($errores!==0){
                        echo "Error en el idioma";
                        $conexion->rollBack();
                    }else{
                        echo '<p id="exito">Convocatoria insertada correctamente</p>';
                        $conexion->commit();
                    }
                }
            }
        }
    }



?>

<main id="crud">
        <h1 id="titulo">ACTUALIZACIÓN CONVOCATORIA</h1>
        <section id="section-actualiza-general">
            <form method="post">
                <span id="span-actualiza-nombre">Nombre:</span>
                <input id="txt-actualizaNombre" type="text" name="nombre">
                <span id="span-actualiza-id">ID:</span>
                <input id="txt-actualiza-id" type="number" text="id" name="id">
                <span id="span-actualiza-proyecto">Proyecto:</span>
                <select id="select-actualiza-proyecto" name="proyecto" id="select">
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
                <span id="span-actualiza-destinatario">Destinatario:</span>
                <table id="tabla-actualiza-destinatario" border="1">
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
                <span id="span-actualiza-movilidades">Movilidades</span>
                <input id="txt-actualiza-movilidades" name="movilidades" type="number"><br>
                <span id="span-actualiza-pais">País de destino:</span>
                <input id="txt-actualiza-pais" name="destino" type="text"><br>
                <span id="span-actualiza-fecha-inicio">Fecha de inicio:</span>
                <input id="actualiza-fecha-inicio" name="fechainicio" type="datetime-local"><br>
                <span id="span-actualizafecha-fin">Fecha de fin:</span>
                <input id="actualiza-fecha-fin" name="fechafin" type="datetime-local"><br>
                <span id="span-actualiza-fecha-inicio-pruebas">Fecha Inicio de Pruebas:</span>
                <input id="fecha-actualiza-inicio-pruebas" name="fechainicioPruebas" type="datetime-local"><br>
                <span id="span-actualiza-fecha-fin-pruebas">Fecha Fin de Pruebas:</span>
                <input id="fecha-actualiza-fin-pruebas" name="fechafinPruebas" type="datetime-local"><br>
                <span id="span-actualiza-fecha-provisional">Fecha Listado Provisional:</span>
                <input id="fecha-actualiza-provisional" name="fechalistadoprovisional" type="datetime-local"><br>
                <span id="span-actualiza-definitivo">Fecha Listado Definitivo:</span>
                <input id="fecha-actualiza-definitivo" name="fechalistadodefinitivo" type="datetime-local"><br>
                <span id="span-actualiza-baremo">Baremos:</span><br>
                <table id="tabla-actualiza-baremo">
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
            <input id="crea" type="submit" value="CREAR CONVOCATORIA" name="actualiza">
        </section>
        </form>
    </main>