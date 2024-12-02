<?php
header('Content-Type: application/json');  // Configura la respuesta como JSON

$servername = "mysql-escmilq.alwaysdata.net";
$username = "escmilq";
$password = "admin1234!";
$dbname = "escmilq_bd"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

ini_set('display_errors', 1);
error_reporting(E_ALL);


// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]));
}

// Verificar si los datos han sido enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar datos
    $materia = trim($_POST['materia']);
    $id_profesor = intval($_POST['id_profesor']);  // Convierte a entero para evitar inyección

    // Validar que no estén vacíos
    if (empty($materia) || empty($id_profesor)) {
        echo json_encode(["status" => "error", "message" => "Faltan datos requeridos."]);
        exit;
    }

    // Fecha actual
    $fecha = date("Y-m-d");

    // Usar consulta preparada para insertar los datos
    $stmt = $conn->prepare("INSERT INTO faltas (id, nom_materia, fecha) VALUES (?, ?, ?)");

    if (!$stmt) {
        // Mostrar el error de la consulta
        echo json_encode(['status' => 'error', 'message' => 'Error en la consulta SQL: ' . $conn->error]);
        exit; // Detiene la ejecución
    }
    
    $stmt->bind_param("iss", $id_profesor, $materia, $fecha);

    // Ejecutar consulta y enviar respuesta
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Falta registrada correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar la falta: " . $stmt->error]);
    }

    // Cerrar consulta
    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Método de solicitud no válido."]);
}

// Cerrar conexión
$conn->close();
?>
