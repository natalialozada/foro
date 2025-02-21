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
    u.nombre AS autor,  
    p.contenido, 
    COALESCE(COUNT(r.id_res), 0) AS num_respuestas, -- Si no hay respuestas, devuelve 0
    p.imagen
    FROM publicacion p
    JOIN usuarios u ON p.id_usu = u.id_usu
    LEFT JOIN respuestas r ON p.id_pub = r.id_pub  
    WHERE p.id_pub LIKE ? 
    OR p.titulo LIKE ? 
    OR p.fecha LIKE ? 
    OR u.nombre LIKE ? 
    OR p.contenido LIKE ? 
    OR p.imagen LIKE ?
    GROUP BY p.id_pub, p.titulo, p.fecha, u.nombre, p.contenido, p.imagen";



    // Definición del tipo de parámetros
    $typeParameters = "ssssss"; // String String String 
    // Llamada al método
    $data1 = $obj1->getData1($sql1, $typeParameters, $bus);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1);

?>