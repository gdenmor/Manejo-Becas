<header>
    <nav>
        <a>VER SOLICITUDES</a>
    </nav>
</header>

<main>
    <section>
        <?php
            $ConvocatoriasDisponibles=BD_CONVOCATORIA::BuscaConvocatoriasActivas();
            if ($ConvocatoriasDisponibles!=null){
                for ($i=0;count($ConvocatoriasDisponibles);$i++){
                    echo "<p>".$ConvocatoriasDisponibles[$i]->getFechaInicio();
                }
            }else{
                echo "No existen solicitudes";
            }
        ?>
    </section>






</main>