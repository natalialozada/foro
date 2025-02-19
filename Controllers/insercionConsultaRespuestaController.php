<?php
session_start();
header('Content-Type: application/json');

try {
    if (!isset($_SESSION['id_usu'])) {
        throw new Exception("Error: Debes iniciar sesión para responder.");
    }

    $id_usu = $_SESSION['id_usu'];
    $id_pub = $_POST['id_pub'] ?? null;
    $autor = $_POST['textoInsercionAutor'] ?? null;
    $mensaje = $_POST['textoInsercionMensaje'] ?? null;

    if (!$id_pub) {
        echo json_encode(["status" => "error", "message" => "Falta el ID de la publicación."]);
        exit;
    }

    if (!$autor || !$mensaje) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    require_once "../Models/insercionConsultaRespuestaModel.php";
    $obj1 = new Datos();

    $sqlCheckPub = "SELECT COUNT(*) FROM publicaciones WHERE id_pub = ?";
    $result = $obj1->getData1($sqlCheckPub, "i", $id_pub);

    if ($result[0]['COUNT(*)'] == 0) {
        throw new Exception("La publicación no existe.");
    }

    $fecha_actual = date('Y-m-d H:i:s');
    $sqlInsert = "INSERT INTO respuestas (id_usu, id_pub, autor, contenido, fecha) VALUES (?, ?, ?, ?, ?)";
    $typeParametersInsert = "iisss";

    $insertResult = $obj1->insertData($sqlInsert, $typeParametersInsert, $id_usu, $id_pub, $autor, $mensaje, $fecha_actual);

    if ($insertResult['status'] !== "success") {
        echo json_encode($insertResult);
        exit;
    }

    $sqlSelect = "SELECT r.id_res, u.nombre AS autor, r.contenido AS mensaje, r.fecha
                  FROM respuestas r
                  JOIN usuarios u ON r.id_usu = u.id_usu
                  WHERE r.id_pub = ?
                  ORDER BY r.fecha DESC";
    $data = $obj1->getData1($sqlSelect, "i", $id_pub);

    echo json_encode(["status" => "success", "data" => $data]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>