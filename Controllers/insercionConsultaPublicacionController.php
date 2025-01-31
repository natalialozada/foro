<?php

    // Tratamiento input type='text'
    $bus = empty($_POST['textoConsulta1']) ? '' : $_POST['textoConsulta1'];

    // Preparación para el uso de LIKE
    $bus = "%" . $bus . "%";

    // Llamada a la conexión
    require_once '../Db/Con1Db.php';
    // Llamada al modelo
    require_once '../Models/insercionConsultaPublicacionModel.php';    

    // Instanciación del objeto
    $obj1 = new Datos;
    // Definición de la instrucción
   
    $sql1 = "SELECT 
    p.id_pub, 
    p.titulo, 
    p.fecha, 
    u.nombre AS autor,  -- Trae el nombre en vez del ID
    p.contenido, 
    p.num_respuestas, 
    p.imagen
    FROM publicacion p
    JOIN usuarios u ON p.id_usu = u.id_usu
    WHERE p.id_pub LIKE ? 
    OR p.titulo LIKE ? 
    OR p.fecha LIKE ? 
    OR u.nombre LIKE ? 
    OR p.contenido LIKE ? 
    OR p.num_respuestas LIKE ?
    OR p.imagen LIKE ?";


    // Definición del tipo de parámetros
    $typeParameters = "sssssss"; // String String String 
    // Llamada al método
    $data1 = $obj1->getData1($sql1, $typeParameters, $bus);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1);

?>