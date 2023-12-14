<?php
require_once "../Manejo-Becas/vendor/autoload.php";

use Dompdf\Dompdf;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listadoDefinitivo = isset($_POST['definitivo']) ? $_POST['definitivo'] : "";
    $listadoProvisional = isset($_POST['provisional']) ? $_POST['provisional'] : "";

    if ($listadoDefinitivo) {
        ob_clean();
        $pdfdefinitivo = new Dompdf();
        $id_convocatoria=(int)$_GET['idConvocatoria'];
        $baremacion=BD_BAREMACION::ListadoAdmitidos($id_convocatoria);
        $html = '
                    <html>
                    <head>
                        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                        <title>Listado Definitivo</title>
                        <link rel="stylesheet" href="../Manejo-Becas/CSS/listado.css">
                    </head>
                    <body>
                        <h1 style="text-align:center;">ADMITIDOS
                        <table id="def">
                            <thead>
                                <tr>
                                    <th> DNI </th>
                                    <th> NOTA </th>
                                </tr>
                            </thead>
                            <tbody>';
                            for ($i = 0; $i < count($baremacion); $i++) {
                                $html .= '<tr>';
                                $html .= '<td>' . $baremacion[$i][0] . '</td>';
                                $html .= '<td>' . $baremacion[$i][1] . '</td>';
                                $html .= '</tr>';
                            }

                            $html .= '
                </tbody>
            </table>
        </body>
        </html>';

        $pdfdefinitivo->getOptions()->setChroot("../Manejo-Becas/CSS/listado.css");


        $pdfdefinitivo->setPaper("A4", "portrait");
        # Cargamos el contenido HTML.
        $pdfdefinitivo->loadHtml($html);

        # Renderizamos el documento PDF.
        $pdfdefinitivo->render();

        # Creamos un fichero
        $pdf = $pdfdefinitivo->output();
        $filename = "../Manejo-Becas/LISTADOS/ListadoDefinitivo".$id_convocatoria.".pdf";
        file_put_contents($filename, $pdf);
        $conv=BD_CONVOCATORIA::FindByID($id_convocatoria);
        $conv->setDefinitivo($html);

        BD_CONVOCATORIA::UpdateByID($id_convocatoria,$conv);
        # Enviamos el fichero PDF al navegador.
        $pdfdefinitivo->stream($filename);
    }

    if ($listadoProvisional) {
        ob_clean();
        $pdfprovisional = new Dompdf();
        $id_convocatoria=(int)$_GET['idConvocatoria'];
        $baremacion=BD_BAREMACION::ListadoAdmitidos($id_convocatoria);

        $html = '
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Listado Provisional</title>
            <link rel="stylesheet" href="../Manejo-Becas/CSS/listado.css">
        </head>
        <body>
            <h1 style="text-align:center;">ADMITIDOS
            <table id="def">
                <thead>
                    <tr>
                        <th> DNI </th>
                        <th> NOTA </th>
                    </tr>
                </thead>
                <tbody>';
                for ($i = 0; $i < count($baremacion); $i++) {
                    $html .= '<tr>';
                    // Agrega aquí las celdas específicas del bucle, por ejemplo:
                    $html .= '<td>' . $baremacion[$i][0] . '</td>';
                    $html .= '<td>' . $baremacion[$i][1] . '</td>';
                    $html .= '</tr>';
                }

                $html .= '
                </tbody>
            </table>
        </body>
        </html>';
                
        $pdfprovisional->getOptions()->setChroot("../Manejo-Becas/CSS/listado.css");
        $pdfprovisional->setPaper("A4", "portrait");
        # Cargamos el contenido HTML.
        $pdfprovisional->loadHtml($html);

        # Renderizamos el documento PDF.
        $pdfprovisional->render();

        # Creamos un fichero
        $pdf = $pdfprovisional->output();
        $filename = "../Manejo-Becas/LISTADOS/ListadoProvisional".$id_convocatoria.".pdf";
        file_put_contents($filename, $pdf);

        $conv=BD_CONVOCATORIA::FindByID($id_convocatoria);
        $conv->setProvisional($html);

        BD_CONVOCATORIA::UpdateByID($id_convocatoria,$conv);

        # Enviamos el fichero PDF al navegador.
        $pdfprovisional->stream($filename);
        
    }
}

?>
<form method="post">
<div>
    <h1 id="titulo-ev">SOLICITUDES A EVALUAR</h1>
    <table id="solicitudes-tabla">
        <thead>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>APELLIDO 1</th>
            <th>APELLIDO 2</th>
            <th>VER SOLICITUD</th>
        </thead>
        <tbody id="solicitudes">
            <?php
                $id=(int)$_GET['idConvocatoria'];
                $solicitudes=BD_CANDIDATOS_CONVOCATORIA::VerSolicitudesConvocatoria($id);
                if ($solicitudes!=null){
                    for ($i=0;$i<count($solicitudes);$i++){
                        echo "<tr>";
                        echo "<td>".$solicitudes[$i]->getID_Candidatos_Convocatoria()."</td>";
                        echo "<td>".$solicitudes[$i]->getNombre()."</td>";
                        echo "<td>".$solicitudes[$i]->getApellido1()."</td>";
                        echo "<td>".$solicitudes[$i]->getApellido2()."</td>";
                        echo '<td><input class="verSolicitud" type="button" value="VER SOLICITUD"</td>';
                        echo "</tr>";
                    }
                }else{
                    echo '<p id="errorSolicitudes" style="margin-top: 5%; position:absolute;">No existen solicitudes en esta convocatoria</p>';
                }
            ?>
        </tbody>
    </table>
    <?php
            $convocatorias = BD_CONVOCATORIA::MostrarConvocatoriasPasadasFechAportacion();
            if ($convocatorias != null) {
                for ($i = 0; $i < count($convocatorias); $i++) {
                    $fechaActual = new DateTime();
                    $fechaProvisional=new DateTime($convocatorias[$i]->getFechaListadoProvisional());
                    $fechafinPruebas=new DateTime($convocatorias[$i]->getFechaFinPruebas());
                    $fechaDefinitivo=new DateTime($convocatorias[$i]->getFechaListadoDefinitivo());
                    if ($fechafinPruebas < $fechaActual && $fechaActual <=$fechaProvisional ) {
                        echo '<input id="de" name="provisional" type="submit" value="GENERAR LISTADO PROVISIONAL">';
                    } else if ($fechaProvisional < $fechaActual && $fechaActual < $fechaDefinitivo) {
                        echo '<input id="fi" name="definitivo" type="submit" value="GENERAR LISTADO DEFINITIVO">';
                    }
                }
            }
    ?>
</div>
</form>