<?php
class Datos
{

    // Devuelve Datos (select)
    public function getData1($sql, $typeParameters, $p1)
    {
        // Conexión
        $mysqli = Conex1::con1();
        // Protección frente a SQL inyectado (mysql_real_escape_string)
        $p1 = $mysqli->real_escape_string($p1);
        // Sentencia
        $statement = $mysqli->prepare($sql);
        // Parámetros (ejemplo: si = string integer)
        $statement->bind_param($typeParameters, $p1);
        // Ejecución de la sentencia
        $statement->execute();
        // Obtención del resultado
        $result = $statement->get_result();
        // Obtención del numero de registros devueltos
        $data = [];

        if($result->num_rows >= 1) {
            // Obtención de los datos
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'id_res' => $row['id_res'],
                    'id_pub' => $row['id_pub'],
                    'fecha' => $row['fecha'],
                    'autor' => $row['autor'],  // Ahora muestra el nombre del usuario
                    'contenido' => $row['contenido'],
                ];
            }
        }

        // Liberación del conjunto de resultados
        $result->free();
        // Cierre de la declaración
        $statement->close();
        // Cierre de la conexión
        $mysqli->close();

        // Devolución del resultado
        return $data;
    }
    
}
?>