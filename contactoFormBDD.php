<?php

$host = 'mysql-escmilq.alwaysdata.net';
$dbnombre = 'escmilq_db';
$usuario = 'escmilq';
$password = 'admin1234!';


   
    $pdo = new PDO("mysql:host=$host;dbname=$dbnombre", $usuario, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];

    
    $sql = "INSERT INTO mensajes (nombre, email, mensaje, asunto) VALUES (:nombre, :email, :mensaje, :asunto)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nombre' => $nombre,
        ':email' => $email,
        ':asunto' => $asunto,
        ':mensaje' => $mensaje
    ]);
    

    echo "<h2>Gracias, $nombre</h2>";


?>