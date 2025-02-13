<?php

    class Datos
    {

        private $mysqli;
        private $data;

        public function __construct()
        {
            $this->mysqli=Conex1::con1();
            $this->data=array();
        }

        public function uploadFile($inputFile1, $nameFile1, $urlFile1)
        {
            
            $extensionFichero = pathinfo($_FILES[$inputFile1]['name'], PATHINFO_EXTENSION);
            $rutaNombrefichero1 = $urlFile1 . $nameFile1 . '.' . $extensionFichero;
            $rutaNombreficheroBaseDeDatos1 = $urlFile1 . $nameFile1 . '.' . $extensionFichero;
        
            // Subida del fichero
            if (move_uploaded_file($_FILES[$inputFile1]['tmp_name'], $rutaNombrefichero1))
            {
                echo "Fichero subido correctamente (servidor).";
                /* INICIO - Captura de los datos extras enviados junto con el fichero */
                /* echo $_POST['descripcion1']; */
                /* echo $_POST['InformacionAdicional1']; */
                /* FIN - Captura de los datos extras enviados junto con el fichero */
                return $rutaNombreficheroBaseDeDatos1;
            }
            else
            {
                switch ($_FILES['ficheroInsercion1']['error'])
                {
                    case UPLOAD_ERR_OK: /* UPLOAD_ERR_OK: Archivo subido correctamente */
                    break;
                    case UPLOAD_ERR_INI_SIZE:
                    echo 'El fichero subido excede la directiva upload_max_filesize de php.ini.';
                    break;
                    case UPLOAD_ERR_FORM_SIZE:
                    echo 'El fichero subido excede la directiva upload_max_filesize de php.ini.';
                    break;		
                    case UPLOAD_ERR_PARTIAL:
                    echo 'El fichero fue sólo parcialmente subido.';
                    break;
                    case UPLOAD_ERR_NO_FILE:
                    echo 'No se subió ningún fichero.';
                    break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                    echo 'Falta la carpeta temporal.';
                    break;
                    case UPLOAD_ERR_CANT_WRITE:
                    echo 'No se pudo escribir el fichero en el disco.';
                    break;
                    case UPLOAD_ERR_EXTENSION:
                    echo 'Una extensión de PHP detuvo la subida de ficheros.';
                    break;			
                    default:
                    echo 'El archivo no se ha enviado.';
                    break;
                }
            }
        }

        // No devuelve datos de la BD (insert, update, delete con consultas preparadas)
        public function getUserIdByName($usuario)
    {
        $sql = "SELECT id_usu FROM usuarios WHERE nombre = ?";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_usu);
        $stmt->fetch();

        return $id_usu;
    }

    public function setDataPreparedStatements1($sql, $par1, $par2, $par3, $par4, $par5)
    {
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("sssss", $par1, $par2, $par3, $par4, $par5);

        if (!$stmt->execute()) {
            $result = "La operación no se ha podido realizar. ";
        } else {
            $result = "Operación realizada con éxito. ";
        }

        $this->mysqli->close();
        return $result;
    }
    }
?>
