<?php
    if ($_SERVER['REQUEST_METHOD']=="POST"){
        $convocatorias=BD_CONVOCATORIA::FindAll();
        $convoelegidaid=null;
        if ($convocatorias!=null){
            for ($i=0;$i<count($convocatorias);$i++){
                if (isset($_POST['borrar'.$i])){
                    $convoelegidaid=$convocatorias[$i]->getIdConvocatoria();
                    $actual=new DateTime();
                    if ($convocatorias[$i]->getFechaInicio()<$actual){
                        BD_CONVOCATORIA::DeleteByID($convoelegidaid);
                        echo "<script>window.location.reload();</script>";
                    }
                }
            }
        }



    }

?>
    <h1 id="tituloconv">MOSTRAR Y BORRAR CONVOCATORIAS</h1>
    <table id="tablaConvocatorias">
        <thead>
            <th>PROYECTO</th>
            <th>TIPO</th>
            <th>FECHA INICIO</th>
            <th>FECHA FIN</th>
            <th>BORRAR</th>
        </thead>
        <tbody>
            <form method="post">
            <?php
                $convocatorias=BD_CONVOCATORIA::FindAll();
                if ($convocatorias!=null){
                    for ($i=0;$i<count($convocatorias);$i++){
                        echo '<tr>
                        <td>'.$convocatorias[$i]->getProyecto()->getNombre().'</td>
                        <td>'.$convocatorias[$i]->getTipo().'</td>
                        <td>'.$convocatorias[$i]->getFechaInicio().'</td>
                        <td>'.$convocatorias[$i]->getFechaFin().'</td>
                        <td><input class="conv" value="BORRAR" type="submit" name="borrar'.$i.'"</td>
                        </tr>';
                    }
                }else{
                    echo "No hay datos";
                }
            ?>
            </form>
        </tbody>
    </table>
</body>
</html>