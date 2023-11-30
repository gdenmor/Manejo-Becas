<?php
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $num_errores=0;
        $crea=isset($_POST['crea'])?$_POST['crea']:"";
        $actualiza=isset($_POST['actualiza'])?$_POST['actualiza']:"";
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

            $maxima=$_POST['maxima'];
            if ($maxima>1){

            }else{
                $num_errores++;
            }

            $requisito=$_POST['requisito'];
            $minimo=$_POST['minima'];
            $aporta=$_POST['aporta'];

            if ($minimo>0){

            }else{
                $num_errores++;
            }

            $req="";
            if ($requisito=="Sí"){
                $req=true;
            }else{
                $req=false;
            }

            $apor="";
            if ($aporta=="Sí"){
                $apor=true;
            }else{
                $apor=false;
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
                
                $convocatoria=new CONVOCATORIA(null,$movilidades,$tipo,$fechainicio,$fechafin,$fechainicioPruebas,$fechafinPruebas,$fechalistadoprovisional,$fechalistadodefinitivo,$Proyecto,$destino);
                BD_CONVOCATORIA::Insert($convocatoria);

                $id=BD_CONVOCATORIA::sacarID();

                $convocatoria->setID($id);
                
                for ($i=0;$i<count($baremo);$i++){
                    $baremoelegido=$baremo[$i];
                    if ($baremoelegido->getNombre()!=="Idioma"){
                        $convocatoria_baremable=new CONVOCATORIA_BAREMABLE(null,$convocatoria,$baremoelegido,$maxima,$req,$minimo,$apor);
                        BD_CONVOCATORIA_BAREMABLE::Insert($convocatoria_baremable);
                    }else{

                    }
                }

                for ($i=0;$i<count($desti);$i++){
                    $destielegido=$desti[$i];
                    $destinatario_conv=new DESTINATARIO_CONVOCATORIA(null,$convocatoria,$destinatario);
                    BD_DESTINATARIOS_CONVOCATORIAS::Insert($destinatario_conv);
                }
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

            $maxima=$_POST['maxima'];
            if ($maxima>1){

            }else{
                $num_errores++;
            }

            $requisito=$_POST['requisito'];
            $minimo=$_POST['minima'];
            $aporta=$_POST['aporta'];

            if ($minimo>0){

            }else{
                $num_errores++;
            }

            $req="";
            if ($requisito=="Sí"){
                $req=true;
            }else{
                $req=false;
            }

            $apor="";
            if ($aporta=="Sí"){
                $apor=true;
            }else{
                $apor=false;
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
                
                $convocatoria=new CONVOCATORIA(null,$movilidades,$tipo,$fechainicio,$fechafin,$fechainicioPruebas,$fechafinPruebas,$fechalistadoprovisional,$fechalistadodefinitivo,$Proyecto,$destino);
                BD_CONVOCATORIA::UpdateByID($id,$convocatoria);
                
                /*for ($i=0;$i<count($baremo);$i++){
                    $baremoelegido=$baremo[$i];
                    if ($baremoelegido->getNombre()!=="Idioma"){
                        $convocatoria_baremable=new CONVOCATORIA_BAREMABLE(null,$convocatoria,$baremoelegido,$maxima,$req,$minimo,$apor);
                        BD_CONVOCATORIA_BAREMABLE::Insert($convocatoria_baremable);
                    }else{

                    }
                }

                for ($i=0;$i<count($desti);$i++){
                    $destielegido=$desti[$i];
                    $destinatario_conv=new DESTINATARIO_CONVOCATORIA(null,$convocatoria,$destinatario);
                    BD_DESTINATARIOS_CONVOCATORIAS::Insert($destinatario_conv);
                }*/
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
        <h1>CREACIÓN CONVOCATORIA</h1>
        <h2>Si desea actualizar los baremos no serán actualizables</h2>
        <section>
            <form method="post">
                <span>ID:</span>
                <input type="number" text="id" name="id">
                <span>Proyecto:</span>
                <select name="proyecto" id="select">
                    <?php
                    require_once "../HELPERS/AUTOLOAD.php";
                    AUTOLOAD::AutoLoad();
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
                <span>Destinatario:</span>
                <table border="1">
                    <thead>
                        <th>NOMBRE</th>
                        <th>MARCADO</th>
                    </thead>
                    <tbody>
                        <?php
                        require_once "../HELPERS/AUTOLOAD.php";
                        AUTOLOAD::AutoLoad();
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
                <span>Movilidades</span>
                <input name="movilidades" type="number"><br>
                <span>País de destino:</span>
                <input name="destino" type="text"><br>
                <span>Fecha de inicio:</span>
                <input name="fechainicio" type="datetime-local"><br>
                <span>Fecha de fin:</span>
                <input name="fechafin" type="datetime-local"><br>
                <span>Fecha Inicio de Pruebas:</span>
                <input name="fechainicioPruebas" type="datetime-local"><br>
                <span>Fecha Fin de Pruebas:</span>
                <input name="fechafinPruebas" type="datetime-local"><br>
                <span>Fecha Listado Provisional:</span>
                <input name="fechalistadoprovisional" type="datetime-local"><br>
                <span>Fecha Listado Definitivo:</span>
                <input name="fechalistadodefinitivo" type="datetime-local"><br>
                <span>BAREMOS:</span><br>
                <table>
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
                        require_once "../HELPERS/AUTOLOAD.php";
                        AUTOLOAD::AutoLoad();
                        $baremos = BD_ITEMBAREMABLE::FindAll();
                        if ($baremos != null) {
                            for ($i = 0; $i < count($baremos); $i++) {
                                $baremo = $baremos[$i];
                                echo '<tr>
                                    <td>  <input type="checkbox" name="boton_baremo'.$i.'"> </td>
                                    <td>' . $baremo->getNombre() . '</td>
                                    <td><input name="maxima" type="number"></td>
                                    <td><select name="requisito"><option>Sí</option><option>No</option></select></td>
                                    <td><input name="minima" type="number"></td>
                                    <td><select name="aporta"><option>Sí</option><option>No</option></select></td>
                                </tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <input type="submit" value="CREAR CONVOCATORIA" name="crea">
                <input type="submit" value="ACTUALIZAR CONVOCATORIA" name="actualiza">
            </form>
        </section>
    </main>
</body>

</html>