<main id="mainsolss">
    <section id="sols">
        <?php
            $id=(int)$_GET['idCandConv'];
            $solicitud=BD_CANDIDATOS_CONVOCATORIA::FindByID($id);
            if ($solicitud!==null){
                $ruta=$solicitud->getSolicitud();
                $archivo=basename($ruta);
                echo '<iframe src="../Manejo-Becas/SOLICITUDES/'.$archivo.'"><iframe>';
            }else{
                header("Location: http://localhost/Manejo-Becas/index.php?menu=veralumno");
            }
        ?>
    </section>
</main>