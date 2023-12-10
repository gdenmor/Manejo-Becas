<div id="contenedor-barema">
    <form method="post">
        <div>
            <h1 id="titulo-con">SOLICITUDES A EVALUAR</h1>
            <table id="tablabaremar">
                <thead>
                    <th>ID CONVOCATORIA</th>
                    <th>NOMBRE</th>
                    <th>PROYECTO</th>
                    <th>ACCEDER A BAREMOS</th>
                </thead>
                <tbody>
                    <?php
                    $convocatorias = BD_CONVOCATORIA::MostrarConvocatoriasPasadasFechAportacion();
                    if ($convocatorias != null) {
                        for ($i = 0; $i < count($convocatorias); $i++) {
                            echo "<tr>";
                            echo "<td>" . $convocatorias[$i]->getIdConvocatoria() . '</td>';
                            echo '<td>' . $convocatorias[$i]->getNombre() . '</td>';
                            echo '<td>' . $convocatorias[$i]->getProyecto()->getNombre() . '</td>';
                            echo '<td><input class="acceder" type="button" value="ACCEDER"></td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "No existen convocatorias";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </form>
</div>