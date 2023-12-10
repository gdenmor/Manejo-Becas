<main id="crud">
        <h1 id="titulo">ACTUALIZACIÓN CONVOCATORIA</h1>
        <section id="section-general">
            <form method="post">
                <span id="span-nombre">Nombre:</span>
                <input id="txtNombre" type="text" name="nombre">
                <span id="span-id">ID:</span>
                <input id="txt-id" type="number" text="id" name="id">
                <span id="span-proyecto">Proyecto:</span>
                <select id="select-proyecto" name="proyecto" id="select">
                    <?php
                    $proyectos = BD_PROYECTO::FindAll();
                    if ($proyectos != null) {
                        for ($i = 0; $i < count($proyectos); $i++) {
                            echo '<option value="' . $proyectos[$i]->getNombre() . '">' . $proyectos[$i]->getNombre() . '</option>';
                        }
                    } else {
                        echo "No existen proyectos";
                    }
                    ?>
                </select><br>
                <span id="span-destinatario">Destinatario:</span>
                <table id="tabla-destinatario" border="1">
                    <thead>
                        <th>NOMBRE:</th>
                        <th>MARCADO</th>
                    </thead>
                    <tbody>
                        <?php
                        $destinatarios = BD_DESTINATARIOS::FindAll();
                        if ($destinatarios != null) {
                            for ($i = 0; $i < count($destinatarios); $i++) {
                                $destinatario = $destinatarios[$i];
                                echo '<tr>
                                    <td> ' . $destinatario->getNombre() . '</td>
                                    <td>  <input type="checkbox" name="boton'.$i.'"> </td>
                                </tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table><br>
                <span id="span-movilidades">Movilidades</span>
                <input id="txt-movilidades" name="movilidades" type="number"><br>
                <span id="span-pais">País de destino:</span>
                <input id="txt-pais" name="destino" type="text"><br>
                <span id="span-fecha-inicio">Fecha de inicio:</span>
                <input id="fecha-inicio" name="fechainicio" type="datetime-local"><br>
                <span id="span-fecha-fin">Fecha de fin:</span>
                <input id="fecha-fin" name="fechafin" type="datetime-local"><br>
                <span id="span-fecha-inicio-pruebas">Fecha Inicio de Pruebas:</span>
                <input id="fecha-inicio-pruebas" name="fechainicioPruebas" type="datetime-local"><br>
                <span id="span-fecha-fin-pruebas">Fecha Fin de Pruebas:</span>
                <input id="fecha-fin-pruebas" name="fechafinPruebas" type="datetime-local"><br>
                <span id="span-fecha-provisional">Fecha Listado Provisional:</span>
                <input id="fecha-provisional" name="fechalistadoprovisional" type="datetime-local"><br>
                <span id="span-definitivo">Fecha Listado Definitivo:</span>
                <input id="fecha-definitivo" name="fechalistadodefinitivo" type="datetime-local"><br>
                <span id="span-baremo">Baremos:</span><br>
                <table id="tabla-baremo">
                    <thead>
                        <th>MARCADO</th>
                        <th>NOMBRE BAREMO</th>
                        <th>NOTA MÁXIMA</th>
                        <th>REQUISITO</th>
                        <th>NOTA MÍNIMA</th>
                        <th>APORTA ALUMNO</th>
                    </thead>
                    <tbody>
                        <?php
                        $baremos = BD_ITEMBAREMABLE::FindAll();
                        if ($baremos != null) {
                            for ($i = 0; $i < count($baremos); $i++) {
                                $baremo = $baremos[$i];
                                echo '<tr>
                                    <td>  <input type="checkbox" name="boton_baremo'.$i.'"> </td>
                                    <td>' . $baremo->getNombre() . '</td>
                                    <td><input name="maxima'.$i.'" type="number"></td>';
                                    if ($baremo->getNombre()!=="Idioma"){
                                        echo '<td><select name="requisito'.$i.'"><option>Sí</option><option>No</option></select></td>';
                                        echo '<td><input name="minima'.$i.'" type="number"></td>';
                                        echo '<td><select name="aporta'.$i.'"><option>Sí</option><option>No</option></select></td>';
                                    }
                                echo '</tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
                <table id="tabla-idioma">
                    <thead>
                        <th>NIVEL</th>
                        <th>NOTA</th>
                    </thead>
                    <tbody>
                        <?php
                        $idiomas = BD_IDIOMA::FindAll();
                        if ($idiomas != null) {
                            for ($i = 0; $i < count($idiomas); $i++) {
                                $idioma = $idiomas[$i];
                                echo '<tr>
                                    <td>' . $idiomas[$i]->getTitulo() . '</td>
                                    <td><input name="notaidioma'.$i.'" type="number step="any""></td>
                                </tr>';
                            }
                        }

                        ?>
                    </tbody>
                </table>
        </section>
        <section id="botones">
            <input id="crea" type="submit" value="CREAR CONVOCATORIA" name="crea">
        </section>
        </form>
    </main>