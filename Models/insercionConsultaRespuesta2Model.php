<?php

require_once "../Db/Con1DB.php";

class Datos
{
    // Método para la inserción de datos
    public function insertData($sql, $typeParameters, ...$params)
    {
        try {
            $mysqli = Conex1::con1();
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
            }

            $stmt->bind_param($typeParameters, ...$params);
            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }

            $result = ["status" => "success", "message" => "Registro insertado con éxito."];
        } catch (Exception $e) {
            $result = ["status" => "error", "message" => $e->getMessage()];
        } finally {
            if ($stmt) $stmt->close();
            $mysqli->close();
        }

        return $result;
    }

    // Método para obtener todos los registros
    public function getData1($sql, $typeParameters = "s", ...$params)
    {
        $mysqli = Conex1::con1();
        $statement = $mysqli->prepare($sql);
        if ($typeParameters) {
            $statement->bind_param($typeParameters, ...$params);
        }
        $statement->execute();
        $result = $statement->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $result->free();
        $statement->close();
        $mysqli->close();

        return $data;
    }
}
?>