<?php

header('Content-Type: application/json');

try {
    // Verificar y obtener los datos del formulario
    $id_pub = $_POST['textoInsercion1'] ?? null;
    $titulo = $_POST['textoInsercion2'] ?? null;
    $fecha = $_POST['textoInsercion3'] ?? null;
    $id_usu = $_POST['textoInsercion3'] ?? null;
    $contenido = $_POST['textoInsercion3'] ?? null;
    $num_respuestas = $_POST['textoInsercion3'] ?? null;

    if (!$id_pub || !$titulo || !$fecha || !$id_usu || !$contenido || !$num_respuestas) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Incluir el modelo y crear una instancia
    require_once "../Models/InsercionConsulta2PublicacionModel.php";
    $obj1 = new Datos();

    // Paso 1: Insertar el nuevo registro
    $sqlInsert = "INSERT INTO publicacion (id_pub, titulo, fecha, id_usu, contenido, num_respuestas) VALUES (?, ?, ?, ?, ?, ?)";
    $typeParametersInsert = "ssssss"; // String String Integer

    $insertResult = $obj1->insertData($sqlInsert, $typeParametersInsert, $id_pub, $titulo, $fecha, $id_usu, $contenido, $num_respuestas);

    if ($insertResult['status'] !== "success") {
        echo json_encode($insertResult);
        exit;
    }

    // Paso 2: Consultar todos los registros después de la inserción
    $sqlSelect = "SELECT id_pub, titulo, fecha, id_usu, contenido, num_respuestas FROM publicacion ORDER BY id_pub, titulo, fecha, id_usu, contenido, num_respuestas";
    $data = $obj1->getData1($sqlSelect, "", ""); // Sin parámetros adicionales en la consulta

    // Devolver todos los registros en formato JSON
    echo json_encode(["status" => "success", "data" => $data]);

} catch (Exception $e) {
    // Manejo de errores
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>