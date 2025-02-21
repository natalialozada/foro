<?php


    // Tratamiento input type='text'
    $bus = empty($_POST['textoConsulta1']) ? '' : $_POST['textoConsulta1'];

    // Preparación para el uso de LIKE
    $bus = "%" . $bus . "%";

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
    WHERE r.id_res LIKE ? 
    OR p.id_pub LIKE ? 
    OR r.fecha LIKE ? 
    OR u.nombre LIKE ? 
    OR r.contenido LIKE ?";


    // Definición del tipo de parámetros
    $typeParameters = "sssss"; // String String String 
    // Llamada al método
    $data1 = $obj1->getData1($sql1, $typeParameters, $bus);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1);

?>
