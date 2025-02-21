<?php
// Obtener el título del POST
$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';

// Validar si el título está vacío
if (empty($titulo)) {
    echo json_encode(['status' => 'error', 'message' => 'El título no puede estar vacío.']);
    exit();
}

// Conectar a la base de datos
require_once '../Db/Con1Db.php';

// Crear la conexión a la base de datos usando el método con1
$mysqli = Conex1::con1();

// Consulta SQL para buscar publicaciones por título
$sql = "SELECT 
            p.id_pub, 
            p.titulo, 
            p.fecha, 
            u.nombre AS autor,  
            p.contenido, 
            COALESCE(COUNT(r.id_res), 0) AS num_respuestas, 
            p.imagen
        FROM publicacion p
        JOIN usuarios u ON p.id_usu = u.id_usu
        LEFT JOIN respuestas r ON p.id_pub = r.id_pub  
        WHERE p.titulo LIKE ? 
        GROUP BY p.id_pub, p.titulo, p.fecha, u.nombre, p.contenido, p.imagen";

// Preparar la sentencia
$stmt = $mysqli->prepare($sql);  // Usamos $mysqli en lugar de $conn
if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Error al preparar la consulta: ' . $mysqli->error]);
    exit();
}

// Añadir los comodines para el LIKE
$titulo = "%" . $titulo . "%"; 

// Vincular el parámetro con la consulta
$stmt->bind_param("s", $titulo);

// Ejecutar la consulta
$stmt->execute();

// Obtener los resultados
$result = $stmt->get_result();

// Preparar los datos a devolver
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Cerrar la conexión
$stmt->close();

// Si no se encontraron publicaciones
if (empty($data)) {
    echo json_encode(['status' => 'error', 'message' => 'No se encontraron publicaciones con ese título.']);
} else {
    // Devolver los resultados en formato JSON
    echo json_encode(['status' => 'success', 'data' => $data]);
}

// Cerrar la conexión a la base de datos
$mysqli->close();
?>
