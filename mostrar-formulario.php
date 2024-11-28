<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Ingresados del Usuario</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Datos Ingresados del Usuario</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Asunto</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>

        <?php
        // Datos de conexión a la base de datos
        $servername = "mysql-escmilq.alwaysdata.net";   // Cambia esto si es necesario
        $username = "escmilq";          // Nombre de usuario de MySQL
        $password = "admin1234!";              // Contraseña de MySQL
        $dbname = "escmilq_db";      // Nombre de la base de datos

        try {
            // Conexión a la base de datos usando PDO
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para obtener todos los mensajes de la tabla
            $sql = "SELECT nombre, email, asunto, mensaje, fecha FROM mensajes ORDER BY id ASC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            // Obtener todos los resultados de la consulta
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Mostrar los datos en la tabla si hay resultados
            if ($resultados) {
                foreach ($resultados as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row["nombre"]) . "</td>
                            <td>" . htmlspecialchars($row["email"]) . "</td>
                            <td>" . htmlspecialchars($row["asunto"]) . "</td>
                            <td>" . htmlspecialchars($row["mensaje"]) . "</td>
                            <td>" . htmlspecialchars($row["fecha"]) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay mensajes para mostrar</td></tr>";
            }

        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }

        // Cerrar la conexión
        $conn = null;
        ?>
    </table>
</body>
</html>