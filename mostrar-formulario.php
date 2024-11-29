<!DOCTYPE html>
<html lang="es">
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal - Escuela de MInas</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
    
    <div class="container mt-5">
        <h2>Datos Ingresados del Usuario</h2>
    <table class="table table-striped table-hover table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Asunto</th>
            <th>Mensaje</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
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
    </tbody>
    </table>
    </div>
    <footer class="bg-dark text-white text-center py-3">
    <p>&copy; 2024 Escuela de Minas. Todos los derechos reservados.</p>
  </footer>
</body>
</html>