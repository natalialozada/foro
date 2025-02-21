<?php
// Obtener el ID de la publicación a eliminar
$id_pub = isset($_POST['id_pub']) ? $_POST['id_pub'] : '';

// Validar si el ID de la publicación está vacío
if (empty($id_pub)) {
    echo json_encode(['status' => 'error', 'message' => 'El ID de la publicación no es válido.']);
    exit();
}

// Conectar a la base de datos
require_once '../Db/Con1Db.php';

// Crear la conexión a la base de datos usando el método con1
$mysqli = Conex1::con1();

// Consulta SQL para eliminar la publicación
$sql = "DELETE FROM publicacion WHERE id_pub = ?";

// Preparar la sentencia
$stmt = $mysqli->prepare($sql);  
if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta: ' . $mysqli->error]);
    exit();
}

// Vincular el parámetro con la consulta
$stmt->bind_param("i", $id_pub);  // 'i' para un entero (id_pub)

// Ejecutar la consulta
$stmt->execute();

// Verificar si se ha eliminado correctamente
if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success', 'message' => 'Publicación eliminada con éxito.']);
} 

// Cerrar la conexión
$stmt->close();
$mysqli->close();
?>
