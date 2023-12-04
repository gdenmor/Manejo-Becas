<?php
    use Dompdf\Dompdf;
    require_once "../HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $cuerpo=file_get_contents("php://input");
        $barema = json_decode($cuerpo);
        $candidato_DNI = $barema->convocatoria->DNI;
        $candidato_fecha_nacimiento = $barema->convocatoria->fecha_nacimiento;
        $candidato_tutor_legal = $barema->convocatoria->tutor_legal;
        $candidato_apellido1 = $barema->convocatoria->apellido1;
            $candidato_apellido2 = $barema->convocatoria->apellido2;
            $candidato_nombre = $barema->convocatoria->nombre;
            $candidato_contrasena = $barema->convocatoria->contrasena;
            $candidato_curso = $barema->convocatoria->curso;
            $candidato_tlf = $barema->convocatoria->tlf;
            $candidato_correo = $barema->convocatoria->correo;
            $candidato_domicilio = $barema->convocatoria->domicilio;
            $candidato_rol = $barema->convocatoria->rol;
        $html='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <div>
                <strong><p style="text-align: center;"> SOLICITUD DE INSCRIPCIÓN EN EL PROYECTO ERASMUS+</p></strong>
                <div style="border: 1px solid black; width: 40%; margin-left: 29%;">
                    El/La solicitante, D./Dª'.$candidato_nombre.',
                    con DNI '.$candidato_DNI.', domiciliado en '.$candidato_domicilio.',
                    teléfono de contacto'. $candidato_tlf.',correo 
                    electrónico' . $candidato_correo.'.
                    En caso de ser menor de edad,
                    D.____________________________________________, 
                    representante legal, con DNI'.$candidato_tutor_legal.', 
                    domiciliado en ______________________________________
                    y teléfono de contacto __________________________.
                </div>
                <h2 style="text-align: center;">EXPONE/N:</h2>
                <div style="margin-left: 29%; width: 40%; ">Que está matriculado/a en el IES Las Fuentezuelas en 2º del ciclo formativo de
                    Grado Medio de__________________________________________________________,
                    que son ciertos los datos que figuran en esta instancia, que cumple los requisitos para
                    obtener la condición de beneficiario establecidos en las bases de la convocatoria del
                    programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas del curso
                    académico 2021/22 y que la documentación presentada es copia fiel del original.
                    </div>
                <p style="margin-left: 34%;"> Por lo expuesto,</p>
                <h3 style="text-align: center;">SOLICITA/N</h3>
                <div style="margin-left: 29%; width: 40%;">Participar en la selección de alumnado de ciclos formativos de Grado Medio en el
                    programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas,
                    con número de proyecto: 2023-1-ES01-KA121-VET-000118437, y que le sea concedida
                    una ayuda para la realización de prácticas en empresas de otros países de la Unión
                    Europea.
                </div>
                <p style="margin-left: 32%;">En Jaén, a ________ de _____________________ de __________</p>
                <div style="display: flex; justify-content: center; margin-top: 5%">
                    <div>FDO. El solicitante</div>
                    <div style="margin-left: 10%;">FDO.:RLegal</div>
                    <div style="margin-left: 10%;"><i>Si es menor de edad</i></div>
                </div>
                <div style="margin-left: 28.7%;">
                    <p>Documentación que se adjunta</p>
                    <ul style="list-style-type: none;">
                        <li>Fotocopia del DNI del solicitante y de los padres si es menor de edad.</li>
                        <li>El certificado de idiomas, en caso de poseerlo</li>
                        <li>El documento de autorización de representación si es menor.</li>
                    </ul>
                </div>
                <p style="text-align: center; font-size: large;">SRA.DIRECTORA DEL IES LAS FUENTEZUELAS</p>
                <div style="display: flex; margin-left: 30%;">
                    <div style="border: 1px solid black; width: 8%;">Destino del documento</div>
                    <div style="border: 1px solid black; width: 53%;">Entregar en Secretaria</div>
                </div>
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

    }
?>