<?php
    require_once "../HELPERS/AUTOLOAD.php";
    require_once "../vendor/autoload.php";
    use Dompdf\Dompdf;
    SESSION::CreaSesion();
    if ($_SERVER["REQUEST_METHOD"]=="GET"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                $convocatoria=BD_CANDIDATOS_CONVOCATORIA::FindByID($id);
                $conv=$convocatoria->toJSON();
                http_response_code(200);
                echo $conv;
            }else{
                http_response_code(300);
            }
        }else{
            http_response_code(400);
        }
    }

    if ($_SERVER["REQUEST_METHOD"]=="DELETE"){
        $id=$_GET['id'];
        if (isset($id)){
            if ($id!==""){
                BD_CANDIDATOS_CONVOCATORIA::DeleteByID($id);
                http_response_code(200);
            }else{
                http_response_code(300);
            }
        }else{
            http_response_code(400);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"&&SESSION::estaLogueado('USER')) {
        $conexion = CONEXION::AbreConexion();
        $cuerpo = file_get_contents("php://input");
        $datos = json_decode($_POST['json']);
        $archivos=$_FILES['archivo'];
    
        // Datos del candidato y la convocatoria
        $candidato_convocatoria = $datos->candidato_convocatoria;
        $convocatoria = $candidato_convocatoria->convocatoria;
    
        // Validar si el candidato ya ha solicitado la convocatoria
        $num_solicitudes = BD_CANDIDATOS_CONVOCATORIA::CompruebaHaSolicitado($candidato_convocatoria->DNI, $convocatoria->id_convocatoria);
    
        if ($num_solicitudes == 0) {
            try {
                $conexion->beginTransaction();
                $proyecto = new PROYECTO($candidato_convocatoria->convocatoria->proyecto->codigo_proyecto, $candidato_convocatoria->convocatoria->proyecto->nombre, $candidato_convocatoria->convocatoria->proyecto->fecha_inicio, $candidato_convocatoria->convocatoria->proyecto->fecha_fin);
                $convocatoria = new CONVOCATORIA($candidato_convocatoria->convocatoria->id_convocatoria, $candidato_convocatoria->convocatoria->num_movilidades, $candidato_convocatoria->convocatoria->tipo, $candidato_convocatoria->convocatoria->fecha_inicio, $candidato_convocatoria->convocatoria->fecha_fin, $candidato_convocatoria->convocatoria->fechainicioPruebas, $candidato_convocatoria->convocatoria->fechafinPruebas, $candidato_convocatoria->convocatoria->fechaListadoProvisional, $candidato_convocatoria->convocatoria->fechaListadoDefinitivo, $proyecto, $candidato_convocatoria->convocatoria->pais_destino, $candidato_convocatoria->convocatoria->nombre, null, null);
                $can_conv = new CANDIDATOS_CONVOCATORIA(null, $convocatoria, $candidato_convocatoria->DNI, $candidato_convocatoria->fecha_nacimiento, $candidato_convocatoria->tutor_legal, $candidato_convocatoria->apellido1, $candidato_convocatoria->apellido2, $candidato_convocatoria->nombre, $candidato_convocatoria->contrasena, $candidato_convocatoria->curso->codigo_grupo, $candidato_convocatoria->tlf, $candidato_convocatoria->correo, $candidato_convocatoria->domicilio, $candidato_convocatoria->rol, null);
                BD_CANDIDATOS_CONVOCATORIA::Insert($can_conv);
                // Obtener el ID de la última convocatoria insertada
                $id_convocatoria = BD_CONVOCATORIA::sacarID();
                $i=0;
                // Insertar baremación
                foreach ($datos->baremacion as $item_baremacion) {
                    $id_item = $item_baremacion->item->id_item;
                    $nota = $item_baremacion->nota;

                    $temp=$archivos['tmp_name'][$i];
                    $fileName = $archivos['name'][$i];
                    $uploadPath ="../APORTACIONES/" . $fileName;
                    move_uploaded_file($temp, $uploadPath);

                    $url = $uploadPath;
    
                    // Insertar en la tabla de baremación
                    $resultado_baremacion = $conexion->prepare("INSERT INTO BAREMACION(id_candidato_convocatoria, id_item, nota, url) VALUES 
                    (:id_candidato_convocatoria, :id_item, :nota, :url)");
                    $resultado_baremacion->bindParam(":id_candidato_convocatoria", $id_convocatoria, PDO::PARAM_INT);
                    $resultado_baremacion->bindParam(":id_item", $id_item, PDO::PARAM_INT);
                    $resultado_baremacion->bindParam(":nota", $nota, PDO::PARAM_INT);
                    $resultado_baremacion->bindParam(":url", $url, PDO::PARAM_STR);
                    $resultado_baremacion->execute();
                    $i++;
                }

                $candidato_convocatoria = json_decode($cuerpo);
                $candidato_DNI = $can_conv->getDNI();
                $candidato_fecha_nacimiento = "(No tiene ninguna introducida)";
                if ($candidato_fecha_nacimiento!=="(No tiene ninguna introducida"){
                    $candidato_fecha_nacimiento=$can_conv->getFechaNacimiento();
                }
                $candidato_tutor_legal = "(No tiene tutor legal)";
                if ($candidato_tutor_legal!=="(No tiene tutor legal"){
                    $candidato_tutor_legal=$can_conv->getTutorLegal();
                }
                $candidato_apellido1 = $can_conv->getApellido1();
                $candidato_apellido2 = $can_conv->getApellido2();
                $candidato_nombre = $can_conv->getNombre();
                $candidato_curso = $can_conv->getCurso();
                $candidato_tlf = $can_conv->getTlf();
                $candidato_correo = $can_conv->getCorreo();
                $candidato_domicilio = $can_conv->getDomicilio();
                $fechaActual=new DateTime();
                $html='<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <link rel="stylesheet" href="../CSS/pdfsolicitud.css"
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
                            representante legal, con DNI '.$candidato_tutor_legal.', 
                            domiciliado en '. $candidato_domicilio.'
                            y teléfono de contacto '.$candidato_tlf.'
                        </div>
                        <h2 id="titexpone">EXPONE/N:</h2>
                        <div id="texexpone">Que está matriculado/a en el IES Las Fuentezuelas en '.$can_conv->getCurso().',
                            que son ciertos los datos que figuran en esta instancia, que cumple los requisitos para
                            obtener la condición de beneficiario establecidos en las bases de la convocatoria del
                            programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas del curso
                            académico 2021/22 y que la documentación presentada es copia fiel del original.
                            </div>
                        <p id="expuestotit"> Por lo expuesto,</p>
                        <h3 id="titsolicita">SOLICITA/N</h3>
                        <div id="txtSolicita">Participar en la selección de alumnado de ciclos formativos de Grado Medio en el
                            programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas,
                            con número de proyecto: '.$can_conv->getConvocatoria()->getProyecto()->getCodigoProyecto().', y que le sea concedida
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

                $mipdf->getOptions()->setChroot("../CSS/pdfsolicitud.css");
                
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
                
                $can_conv->setSolicitud($filename);

                BD_CANDIDATOS_CONVOCATORIA::UpdateByID($id_convocatoria,$can_conv);

                $conexion->commit();
                http_response_code(200);
            } catch (Exception $e) {
                // Revertir la transacción en caso de error
                $conexion->rollBack();
                http_response_code(500);
                echo json_encode(["error" => $e->getMessage()]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Ya ha realizado una solicitud este usuario"]);
        }
    }
    

    if ($_SERVER["REQUEST_METHOD"]=="PUT"){
        
    }



?>