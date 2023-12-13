<h1 style="margin-left: 50%;">VER MIS SOLICITUDES</h1>
<section id="divcont">
    <?php
        SESSION::CreaSesion();
        $user=SESSION::leer_session('USER');
        $solicitudes=BD_CANDIDATOS_CONVOCATORIA::SolicitudesDeUnAlumno($user->getDNI());
        if ($solicitudes!=null){
        for ($i=0;$i<count($solicitudes);$i++){
            echo '<div id="div">';
                echo '<input class="ids" type="hidden" value="' . $solicitudes[$i]->getID_Candidatos_Convocatoria() . '">';
                echo '<div>';
                    echo '<h3>' . $solicitudes[$i]->getConvocatoria()->getNombre() . '</h3>';
                    echo '<p><strong>Fecha de inicio:</strong> ' . $solicitudes[$i]->getConvocatoria()->getFechaInicio() . '</p>';
                    echo '<p><strong>Fecha de fin:</strong> ' . $solicitudes[$i]->getConvocatoria()->getFechaFin() . '</p>';
                echo '</div>';
                echo '<input class="solalumno" type="button" value="VER SOLICITUD">';
            echo '</div>';
        }
    }else{
        echo '<span class="error" style="margin-left: 35%;">No hay solicitudes</span>';
    }
    ?>
</section>