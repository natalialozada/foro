<?php

// Tratamiento del ID de la publicación
$id_pub = empty($_POST['id_pub']) ? '' : $_POST['id_pub'];
if (empty($id_pub)) {
    echo json_encode(['status' => 'error', 'message' => 'ID de publicación no proporcionado']);
    exit();
}

// Si no se proporciona un ID de publicación, devolver un error
if (empty($id_pub)) {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'ID de publicación no proporcionado']);
    exit();
}

// Llamada a la conexión
require_once '../Db/Con1Db.php';
// Llamada al modelo
require_once '../Models/insercionConsultaRespuesta1Model.php';

// Instanciación del objeto
$obj1 = new Datos;
// Definición de la instrucción

$sql1 = "SELECT
    r.id_res,
    p.id_pub, 
    r.fecha,
    u.nombre AS autor, 
    r.contenido 
    FROM respuestas r
    JOIN publicacion p ON p.id_pub = r.id_pub
    JOIN usuarios u ON r.id_usu = u.id_usu
    WHERE r.id_pub = ?";

$typeParameters = "i"; // Tipo de parámetro (integer)
// Llamada al método
$data1 = $obj1->getData1($sql1, $typeParameters, $id_pub);

// Devolución de datos en formato JSON
header('Content-Type: application/json');
echo json_encode($data1);
?>