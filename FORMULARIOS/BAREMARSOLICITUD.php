<?php
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $num_errores=0;
        $baremos = BD_BAREMACION::SacarSolicitud($_GET['idSolicitud']);
        $baremosSolicitud=[];
        $idioma=null;
        for ($i=0;$i<count($baremos);$i++){
            if (isset($_POST['nota'.$i])&& $_POST['nota' . $i] >= 0){
                $baremos[$i]->setNota($_POST['nota' .$i]);
                $baremosSolicitud[]=$baremos[$i];
            }else{
                $num_errores++;
            }
        }

        if ($num_errores==0){
            $id_convocatoria=$baremos[0]->getCandidatoConvocatoria()->getConvocatoria()->getIdConvocatoria();
            for ($i=0;$i<count($baremosSolicitud);$i++){
                $baremo=$baremosSolicitud[$i];
                $nota=$baremo->getNota();
                BD_BAREMACION::UpdateByID($baremo->getID_Baremacion(),$baremo);
                header('Location: http://localhost/Manejo-Becas/index.php?menu=versolicitudes&idConvocatoria='.$id_convocatoria.'');
            }
        }else{
            echo $num_errores;
        }
    }

?>
<h1 id="sol">SOLICITUD</h1>
<form id="solform" method="post">
    <div id="contenedorsol">
        <div>
            <?php
            $baremar = BD_BAREMACION::SacarSolicitud($_GET['idSolicitud']);

            if ($baremar != null) {
                for ($i = 0; $i < count($baremar); $i++) {
                    $nombre = basename($baremar[$i]->getURL());
                    echo '<div class="soli">';
                    echo "<label>" . $baremar[$i]->getCandidatoConvocatoria()->getDNI() . "</label>";
                    echo '<input name="nota'.$i.'" type="number" value="'.$baremar[$i]->getNota().'">';
                    echo '<iframe src="../Manejo-Becas/APORTACIONES/' . $nombre . '"></iframe>';
                    echo "</div>";
                }
            } else {
                echo "No existe ninguna solicitud aquí";
            }
            ?>
        </div>
    </div>
    <div id="bt">
        <input type="submit" value="GUARDAR NOTAS SOLICITUD">
    </div>
</form>