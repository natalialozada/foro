<?php

header('Content-Type: application/json');

try {
    // Verificar y obtener los datos del formulario
    $textoInsercionAutor = $_POST['textoInsercionAutor'] ?? null;
    $textoInsercionMensaje = $_POST['textoInsercionMensaje'] ?? null;
  


    if (!$textoInsercionAutor || !$textoInsercionMensaje) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once '../../MODELS/consultas/insercionConsultaRespuestaModel.php';
    $obj1 = new Datos();

    // Paso 1: Insertar el nuevo registro
    $sqlInsert = "INSERT INTO respuestas (id_res, id_pub, fecha, id_usu, contenido) VALUES (?, ?, ?, ?, ?)";
    $typeParametersInsert = "sssss"; // String String Integer

    $insertResult = $obj1->insertData($sqlInsert, $typeParametersInsert, $id_res, $id_pub, $id_usu, $contenido);

    if ($insertResult['status'] !== "success") {
        echo json_encode($insertResult);
        exit;
    }

    // Paso 2: Consultar todos los registros después de la inserción
    $sql1 = "SELECT id_res, fecha, id_usu, contenido FROM respuestas WHERE id_res LIKE ? OR fecha LIKE ? OR id_usu LIKE ? OR contenido LIKE ? ORDER BY id_res, fecha, id_usu, contenido";
    $data = $obj1->getData1($sql1, "", ""); // Sin parámetros adicionales en la consulta

    // Devolver todos los registros en formato JSON
    echo json_encode(["status" => "success", "data" => $data]);

} catch (Exception $e) {
    // Manejo de errores
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>