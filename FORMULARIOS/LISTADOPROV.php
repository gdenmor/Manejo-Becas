<main id="mainsolss">
    <section id="sols">
        <?php
            require_once "../Manejo-Becas/vendor/autoload.php";
            use Dompdf\Dompdf;
            $id=(int)$_GET['idConv'];
            $lista=BD_CONVOCATORIA::FindByID($id);
            if ($lista!=null){
                $pdfprovisional=new Dompdf();
                $html=$lista->getProvisional();
                $pdfprovisional->getOptions()->setChroot("../Manejo-Becas/CSS/listado.css");
                $pdfprovisional->setPaper("A4", "portrait");
                # Cargamos el contenido HTML.
                $pdfprovisional->loadHtml($html);

                # Renderizamos el documento PDF.
                $pdfprovisional->render();

                # Creamos un fichero
                $pdf = $pdfprovisional->output();
                $filename = "../Manejo-Becas/LISTADOS/ListadoProvisional".$id.".pdf";
                file_put_contents($filename, $pdf);

                $archivo=basename($filename);
                echo '<iframe src="../Manejo-Becas/LISTADOS/'.$archivo.'"><iframe>';
            }
        ?>
    </section>
</main>