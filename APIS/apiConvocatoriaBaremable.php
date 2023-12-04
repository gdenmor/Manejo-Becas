<?php
require_once "../HELPERS/AUTOLOAD.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($id!="") {
            $convocatoria = BD_CONVOCATORIA_BAREMABLE::FindByID($id);
            if ($convocatoria) {
                $conv = $convocatoria->toJSON();
                http_response_code(200);
                echo $conv;
            } else {
                http_response_code(404); // Recurso no encontrado
            }
        } else {
            http_response_code(400); // Solicitud incorrecta
        }
    } elseif (isset($_GET['convocatoria'])) {
        $id_convocatoria = $_GET['convocatoria'];
        $baremos = BD_CONVOCATORIA_BAREMABLE::BaremosDeConvocatoria($id_convocatoria);
        if ($baremos) {
            http_response_code(200);
            echo json_encode($baremos);
        } else {
            http_response_code(404); // Recurso no encontrado
        }
    } else {
        http_response_code(400); // Solicitud incorrecta
    }
} else {
    http_response_code(405); // Método no permitido
}


if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    if (isset($id)) {
        $id = $_GET['id'];
        if ($id !== "") {
            BD_CONVOCATORIA_BAREMABLE::DeleteByID($id);
            http_response_code(200);
        } else {
            http_response_code(300);
        }
    } else {
        $id_convocatoria = $_GET['convocatoria'];
        if ($id_convocatoria != null) {
            BD_CONVOCATORIA_BAREMABLE::DeleteByID($id_convocatoria);
        } else {
            http_response_code(400);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cuerpo = file_get_contents("php://input");
}

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
}

?>
