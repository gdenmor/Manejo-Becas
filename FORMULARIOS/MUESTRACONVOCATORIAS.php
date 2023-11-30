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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
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
                        <td><input value="BORRAR" type="submit" name="borrar'.$i.'"</td>
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