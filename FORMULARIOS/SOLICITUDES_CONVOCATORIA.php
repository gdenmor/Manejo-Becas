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
                $solicitudes=BD_CANDIDATOS_CONVOCATORIA::VerSolicitudesConvocatoria($_GET['idConvocatoria']);
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
                    echo '<p id="errorSolicitudes">No existen solicitudes en esta convocatoria</p>';
                }
            ?>
        </tbody>
    </table>
</div>