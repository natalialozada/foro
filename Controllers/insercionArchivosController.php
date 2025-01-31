<?php

    // Tratamiento de los input type='text'
    $autor = empty($_POST['autor']) ? '' : $_POST['autor'];
    $titulo = empty($_POST['titulo']) ? '' : $_POST['titulo'];
    $mensaje = empty($_POST['mensaje']) ? '' : $_POST['mensaje'];
    $fecha = empty($_POST['fecha']) ? '' : $_POST['fecha'];
    // $inputFile1 = empty($_FILES['ficheroInsercion1']) ? '' : $_FILES['ficheroInsercion1'];
    $inputFile1 = 'ficheroInsercion1';

    // Llamada a la conexion
    require_once "../Db/Con1Db.php";
    // Llamada al modelo
    require_once "../Models/insercionArchivosModel.php";

    // Instanciacion del objeto
    $oData = new Datos;



    // Llamada al metodo para subir el archivo (uploadFile)

    // El nombre del fichero es la concetenacion de la marca y el modelo de coche
    $nameFile1 = $titulo;
    // Ruta en la que se guarda el fichero
    $urlFile1 = '../Assets/img/';

    // Llamada al método para subir el fichero que devuelve la ruta completa en la que se ecuentra el fichero (url)
    // Parámetro 1: Nombre del control file que selecciona el fichero
    // Parámetro 2: Nombre del fichero (archivo)que se va a subir
    // Parámetro 3: Ruta en la que se va a almacenar el fichero    
    // uploadFile(nameFile, inputFile, urlFile)
    $urlFileDb1 = $oData->uploadFile($inputFile1, $nameFile1, $urlFile1);

    // Eliminacion de los tres caracteres iniciales "../" en la ruta en la que se encuetra el fichero
    $urlFileDb1 = substr($urlFileDb1, 3);
    // Llamada al metodo para la insertar el registro (setDataPreparedStatements1)
    $sql1 = "insert into publicacion (titulo, contenido, fecha, id_usu, imagen) values (?, ?, ?, ?, ?)";
    $data = $oData->setDataPreparedStatements1($sql1, $titulo, $mensaje, $fecha, $autor, $urlFileDb1);
    
    echo $data;

    // Documentación en:
    // https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php#mysqli.quickstart.prepared-statements

?>