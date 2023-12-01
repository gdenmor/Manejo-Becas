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
            }

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
            for ($i = 0; $i < count($baremos); $i++) {
                if (isset($_POST['boton_baremo'.$i])){
                    $maximas[] = isset($_POST['maxima'.$i]) ? $_POST['maxima'.$i] : 0;
                    $requisitos[] = isset($_POST['requisito'.$i]) && $_POST['requisito'.$i] == 'Sí';
                    $minimas[] = isset($_POST['minima'.$i]) ? $_POST['minima'.$i] : 0;
                    $aportas[] = isset($_POST['aporta'.$i]) && $_POST['aporta'.$i] == 'Sí';
                    $bar=$baremos[$i];
                    $baremo[]=$bar;
                }
            }
            
            if ($baremo!=null){
                for ($i=0;$i<count($maximas);$i++){
                    if ($maximas[$i]>1){
    
                    }else{
                        $num_errores++;
                    }
                }
    
                for ($i=0;$i<count($requisitos);$i++){
                    if ($requisitos[$i]!==null){
    
                    }else{
                        $num_errores++;
                    }
                }
    
                for ($i=0;$i<count($minimas);$i++){
                    if ($minimas[$i]>0){
                        
                    }else{
                        $num_errores++;
                    }
                }
    
                for ($i=0;$i<count($aportas);$i++){
                    if ($aportas[$i]>0){
    
                    }else{
                        $num_errores++;
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
                
                $convocatoria=new CONVOCATORIA(null,$movilidades,$tipo,$fechainicio,$fechafin,$fechainicioPruebas,$fechafinPruebas,$fechalistadoprovisional,$fechalistadodefinitivo,$Proyecto,$destino,$nombre);
                BD_CONVOCATORIA::Insert($convocatoria);

                $id=BD_CONVOCATORIA::sacarID();

                $convocatoria->setID($id);
                
                for ($i=0;$i<count($baremo);$i++){
                    $baremoelegido=$baremo[$i];
                    if ($baremoelegido->getNombre()!=="Idioma"){
                        $convocatoria_baremable=new CONVOCATORIA_BAREMABLE(null,$convocatoria,$baremoelegido,$maximas[$i],$requisitos[$i],$minimas[$i],$aportas[$i]);
                        BD_CONVOCATORIA_BAREMABLE::Insert($convocatoria_baremable);
                    }else{
                        $idiomas = BD_IDIOMA::FindAll();
                        $notas = [];

                        for ($j = 0; $j < count($idiomas); $j++) {
                            $idioma = $idiomas[$j];
                            $nota = isset($_POST['maximaidioma' . $j]) ? $_POST['maximaidioma' . $j] : 0;
                            $notas[] = $nota;

                            // Puedes validar la nota aquí según tus requisitos
                            // ...

                            // Guardar la nota en la base de datos
                            $convocatoria_baremable_idioma = new CONVOCATORIA_BAREMABLE_IDIOMA(null, $convocatoria, $idioma, $baremoelegido, $nota);
                            BD_CONVOCATORIA_BAREMABLE_IDIOMA::Insert($convocatoria_baremable_idioma);
                        }
                    }

                }

                for ($i=0;$i<count($desti);$i++){
                    $destielegido=$desti[$i];
                    $destinatario_conv=new DESTINATARIO_CONVOCATORIA(null,$convocatoria,$destinatario);
                    BD_DESTINATARIOS_CONVOCATORIAS::Insert($destinatario_conv);
                }
            }else{
                echo $num_errores;
            }

        }

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
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <h1 id="titulo">CREACIÓN CONVOCATORIA</h1>
        <h2>Si desea actualizar los baremos no serán actualizables</h2>
        <section id="section-general">
            <form method="post">
                <span id="span-nombre">NOMBRE</span>
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
                <span id="span-baremo">BAREMOS:</span><br>
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
                                    if ($baremo->getNombre()!="Idioma"){
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
                                    <td><input name="maximaidioma'.$i.'" type="number step="any""></td>
                                </tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <input name="logout" type="submit" value="CERRAR SESIÓN" id="logout">
                <section id="botones">
                    <input id="crea" type="submit" value="CREAR CONVOCATORIA" name="crea">
                    <input id="actualiza" type="submit" value="ACTUALIZAR CONVOCATORIA" name="actualiza">
                    <a href="http://localhost/Manejo-Becas/index.php?menu=mostrarConvocatorias"><input id="mostrar" type="button" value="MOSTRAR CONVOCATORIAS"></a>
                </section>
            </form>
        </section>
    </main>
</body>

</html>