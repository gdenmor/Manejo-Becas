<main>
    <section id="section">
        <h1>CONVOCATORIAS DISPONIBLES</h1>
        <?php
            SESSION::CreaSesion();
            $user=SESSION::leer_session('USER');
            echo '<input id="dni" type="hidden" value="'.$user->getDNI().'">';
            $ConvocatoriasDisponibles=BD_CONVOCATORIA::BuscaConvocatoriasActivas($user->getDNI());
            if ($ConvocatoriasDisponibles!=null){
                for ($i=0;$i<count($ConvocatoriasDisponibles);$i++){
                    echo '<div class="convocatoria">';
                    echo '<input class="id" type="hidden" value="' . $ConvocatoriasDisponibles[$i]->getIdConvocatoria() . '">';
                    echo '<div class="info-convocatoria">';
                    echo '<h3>' . $ConvocatoriasDisponibles[$i]->getNombre() . '</h3>';
                    echo '<p><strong>Fecha de inicio:</strong> ' . $ConvocatoriasDisponibles[$i]->getFechaInicio() . '</p>';
                    echo '<p><strong>Fecha de fin:</strong> ' . $ConvocatoriasDisponibles[$i]->getFechaFin() . '</p>';
                    echo '</div>';
                    echo '<div class="acciones-convocatoria">';
                    echo '<input type="button" class="solicitar-beca enlaces" value="SOLICITAR">';
                    echo '</div>';
                    echo '</div>';  
                }
            }else{
                echo "No existen convocatorias";
            }
        ?>
    </section>






</main>