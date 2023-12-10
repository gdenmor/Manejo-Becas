<?php
    use Dompdf\Dompdf;
    require_once "../vendor/autoload.php";
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        ob_clean();
        $cuerpo=file_get_contents("php://input");
        $candidato_convocatoria = json_decode($cuerpo);
        $candidato_DNI = $candidato_convocatoria->DNI;
        $candidato_fecha_nacimiento = "(No tiene ninguna introducida)";
        if ($candidato_fecha_nacimiento!=="(No tiene ninguna introducida"){
            $candidato_fecha_nacimiento=$candidato_convocatoria->fecha_nacimiento;
        }
        $candidato_tutor_legal = "(No tiene tutor legal)";
        if ($candidato_tutor_legal!=="(No tiene tutor legal"){
            $candidato_tutor_legal=$candidato_convocatoria->tutor_legal;
        }
        $candidato_apellido1 = $candidato_convocatoria->apellido1;
        $candidato_apellido2 = $candidato_convocatoria->apellido2;
        $candidato_nombre = $candidato_convocatoria->nombre;
        $candidato_curso = $candidato_convocatoria->curso;
        $candidato_tlf = $candidato_convocatoria->tlf;
        $candidato_correo = $candidato_convocatoria->correo;
        $candidato_domicilio = $candidato_convocatoria->domicilio;
        $fechaActual=new DateTime();
        $html='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="../Manejo-Becas/CSS/pdfsolicitud.css"
        </head>
        <body>
            <div>
                <strong><p id="titulo"> SOLICITUD DE INSCRIPCIÓN EN EL PROYECTO ERASMUS+</p></strong>
                <div id="solicitante">
                    El/La solicitante, D./Dª '.$candidato_nombre.',
                    con DNI '.$candidato_DNI.', domiciliado en '.$candidato_domicilio.',
                    teléfono de contacto '. $candidato_tlf.',correo 
                    electrónico ' . $candidato_correo.'.
                    En caso de ser menor de edad,
                    D.___________________________, 
                    representante legal, con DNI '.$candidato_tutor_legal.', 
                    domiciliado en _________________________
                    y teléfono de contacto ________________.
                </div>
                <h2 id="titexpone">EXPONE/N:</h2>
                <div id="texexpone">Que está matriculado/a en el IES Las Fuentezuelas en 2º del ciclo formativo de
                    Grado Medio de_________________________,
                    que son ciertos los datos que figuran en esta instancia, que cumple los requisitos para
                    obtener la condición de beneficiario establecidos en las bases de la convocatoria del
                    programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas del curso
                    académico 2021/22 y que la documentación presentada es copia fiel del original.
                    </div>
                <p id="expuestotit"> Por lo expuesto,</p>
                <h3 id="titsolicita">SOLICITA/N</h3>
                <div id="txtSolicita">Participar en la selección de alumnado de ciclos formativos de Grado Medio en el
                    programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas,
                    con número de proyecto: 2023-1-ES01-KA121-VET-000118437, y que le sea concedida
                    una ayuda para la realización de prácticas en empresas de otros países de la Unión
                    Europea.
                </div>
                <p id="fecha">En Jaén, a '.date("d", $fechaactual) .' de '.date("m", $fechaactual).' de '.date("y", $fechaactual).'</p>
                <div id="firma">
                    <div>FDO. El solicitante</div>
                    <div id="rLegal">FDO.:RLegal</div>
                    <div id="menor"><i>Si es menor de edad</i></div>
                </div>
                <footer id="footer">
                <div id="divfooter">
                    <p>Documentación que se adjunta</p>
                    <ul id="lista">
                        <li>Fotocopia del DNI del solicitante y de los padres si es menor de edad.</li>
                        <li>El certificado de idiomas, en caso de poseerlo</li>
                        <li>El documento de autorización de representación si es menor.</li>
                    </ul>
                </div>
                
                <p id="direc">SRA.DIRECTORA DEL IES LAS FUENTEZUELAS</p>
                <div id="prop">
                    <div id="destino">Destino del documento</div>
                    <div id="secretaria">Entregar en Secretaria</div>
                </div>
                </footer>
            </div>
        </body>
        </html>';
        $mipdf=new Dompdf();
            
            $mipdf ->setPaper("A4", "portrait");
            //$mipdf->getOptions()->setChroot("autoescuela.jpg");
            # Cargamos el contenido HTML.
            $mipdf ->loadHtml($html);

            # Renderizamos el documento PDF.
            $mipdf ->render();

            # Creamos un fichero
            $pdf = $mipdf->output();
            $filename = '../SOLICITUDES/Solicitud'.$candidato_nombre.'.pdf';
            file_put_contents($filename, $pdf);

            # Enviamos el fichero PDF al navegador.
            $mipdf->stream($filename);
            
            $proyecto=new PROYECTO($candidato_convocatoria->convocatoria->proyecto->codigo_proyecto,
            $candidato_convocatoria->convocatoria->proyecto->nombre,$candidato_convocatoria->convocatoria->proyecto->fecha_inicio,
            $candidato_convocatoria->convocatoria->proyecto->fecha_fin);
            $convocatoria=new CONVOCATORIA($candidato_convocatoria->convocatoria->id_convocatoria,$candidato_convocatoria->convocatoria->num_movilidades,
            $candidato_convocatoria->convocatoria->tipo,$candidato_convocatoria->convocatoria->fecha_inicio,$candidato_convocatoria->convocatoria->fecha_fin,$candidato_convocatoria->convocatoria->fechainicioPruebas,
            $candidato_convocatoria->convocatoria->fechafinPruebas,$candidato_convocatoria->convocatoria->fechaListadoProvisional,$candidato_convocatoria->convocatoria->fechaListadoDefinitivo,$proyecto,$candidato_convocatoria->convocatoria->pais_destino,$candidato_convocatoria->convocatoria->nombre,null,null);
            $can_conv=new CANDIDATOS_CONVOCATORIA($candidato_convocatoria->id_candidato_convocatoria,$convocatoria,$candidato_convocatoria->DNI,$candidato_convocatoria->fecha_nacimiento,
            $candidato_convocatoria->tutor_legal,$candidato_convocatoria->apellido1,$candidato_convocatoria->apellido2,$candidato_convocatoria->nombre,$candidato_convocatoria->contrasena,
            $candidato_convocatoria->curso->codigo_grupo,$candidato_convocatoria->tlf,$candidato_convocatoria->correo,$candidato_convocatoria->domicilio,$candidato_convocatoria->rol,$filename);
            http_response_code(200);

            BD_CANDIDATOS_CONVOCATORIA::UpdateByID($can_conv->getID_Candidatos_Convocatoria(),$can_conv);

    }
?>