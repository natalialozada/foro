<?php
session_start();
header('Content-Type: application/json');

try {
    // Obtener el usuario desde la sesión
    $usuario = $_SESSION['usuario'];

    // Obtener `id_pub` desde la URL
    $id_pub = $_POST['id_pub'] ?? null;

    // Obtener los datos del formulario
    $fecha = $_POST['textoInsercionFecha'] ?? null;
    $contenido = $_POST['textoInsercionMensaje'] ?? null;

    if (!$usuario || !$id_pub || !$fecha || !$contenido) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    // Conectar a la base de datos y obtener el id_usu
    require_once '../Db/Con1DB.php';
    $mysqli = Conex1::con1();

    // Obtener el id_usu a partir del nombre del usuario
    $sql_usuario = "SELECT id_usu FROM usuarios WHERE nombre = ?";
    $stmt = $mysqli->prepare($sql_usuario);
    $stmt->bind_param("s", $usuario); // Bind del nombre del usuario
    $stmt->execute();
    $stmt->bind_result($id_usu);
    $stmt->fetch();
    $stmt->close();

    if (!$id_usu) {
        throw new Exception("Usuario no encontrado.");
    }

    // Incluir el modelo y crear una instancia
    require_once '../Models/insercionConsultaRespuesta2Model.php';
    $obj1 = new Datos();

    // Insertar la nueva respuesta con `id_pub` y `id_usu`
    $sqlInsert = "INSERT INTO respuestas (id_pub, id_usu, fecha, contenido) VALUES (?, ?, ?, ?)";
    $typeParametersInsert = "iiss"; // Integer, Integer, String, String

    $insertResult = $obj1->insertData($sqlInsert, $typeParametersInsert, $id_pub, $id_usu, $fecha, $contenido);

    if ($insertResult['status'] !== "success") {
        echo json_encode($insertResult);
        exit;
    }

    // Consultar todas las respuestas después de la inserción
    $sql1 = "SELECT r.fecha, u.nombre AS autor, r.contenido
             FROM respuestas r
             JOIN usuarios u ON r.id_usu = u.id_usu
             WHERE r.id_pub = ?";
    
    $data = $obj1->getData1($sql1, "i", $id_pub); // Pasar `id_pub` como parámetro

    echo json_encode(["status" => "success", "data" => $data]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
