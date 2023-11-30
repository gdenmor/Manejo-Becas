<header>
    <nav>
        <a>VER SOLICITUDES</a>
    </nav>
</header>

<main>
    <section id="section">
        <?php
            SESSION::CreaSesion();
            $user=SESSION::leer_session('USER');
            echo '<input id="dni" type="hidden" value="'.$user->getDNI().'">';
            $ConvocatoriasDisponibles=BD_CONVOCATORIA::BuscaConvocatoriasActivas();
            if ($ConvocatoriasDisponibles!=null){
                for ($i=0;$i<count($ConvocatoriasDisponibles);$i++){
                    echo '<input class="id" type="hidden" value="'.$ConvocatoriasDisponibles[$i]->getIdConvocatoria().'">';
                    echo '<div id="div"><a>'.$ConvocatoriasDisponibles[$i]->getNombre().'</a><img id="imagen" src="../Manejo-Becas/IMAGENES/PDF_file_icon.png"><input type="button" class="enlaces" value="SOLICITAR"></div>';
                }
            }else{
                echo "No existen convocatorias";
            }
        ?>
    </section>






</main>