<main id="mainalumno">
    <section id="section">
        <h1>CONVOCATORIAS DISPONIBLES</h1>
        <?php
            SESSION::CreaSesion();
            $user=SESSION::leer_session('USER');
            echo '<input id="dni" type="hidden" value="'.$user->getDNI().'">';
            $ConvocatoriasDisponibles=BD_CONVOCATORIA::BuscaConvocatoriasActivas($user->getDNI());
            if ($ConvocatoriasDisponibles!=null){
                for ($i=0;$i<count($ConvocatoriasDisponibles);$i++){
                    echo '<div id="div">';
                    echo '<input class="id" type="hidden" value="' . $ConvocatoriasDisponibles[$i]->getIdConvocatoria() . '">';
                    echo '<div class="info-convocatoria">';
                    echo '<h3>' . $ConvocatoriasDisponibles[$i]->getNombre() . '</h3>';
                    echo '<p><strong>Fecha de inicio:</strong> ' . $ConvocatoriasDisponibles[$i]->getFechaInicio() . '</p>';
                    echo '<p><strong>Fecha de fin:</strong> ' . $ConvocatoriasDisponibles[$i]->getFechaFin() . '</p>';
                    echo '</div>';
                    echo '<div class="acciones-convocatoria">';
                    $DNI=$user->getDNI();
                    $solicitudesAlumno=BD_CANDIDATOS_CONVOCATORIA::CompruebaHaSolicitado($DNI,$ConvocatoriasDisponibles[$i]->getIdConvocatoria());
                    if ($solicitudesAlumno>0){
                        echo '<input type="button" class="solicitar-beca enlaces" value="SOLICITADO" disabled>';
                    }else{
                        echo '<input type="button" class="solicitar-beca enlaces" value="SOLICITAR">';
                    }
                    $fechaActual=new DateTime();
                    $provisional=new DateTime($ConvocatoriasDisponibles[$i]->getFechaListadoProvisional());
                    $definitiva=new DateTime($ConvocatoriasDisponibles[$i]->getFechaListadoDefinitivo());
                    $fechafin=new DateTime($ConvocatoriasDisponibles[$i]->getFechaFin());
                    if ($fechaActual>=$provisional&&$fechaActual<$definitiva){
                        echo '<input class="p" type="button" value="VER LISTADO PROVISIONAL">';
                    }else if ($fechaActual>=$definitiva&&$fechaActual<$fechafin){
                        echo '<input class="f" type="button" value="VER LISTADO DEFINITIVO">';
                    }
                    echo '</div>';
                    echo '</div>';  
                }
            }else{
                echo '<span class="error" style="margin-left:30%;">No existen convocatorias</span>';
            }
        ?>
    </section>






</main>