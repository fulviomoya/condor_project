<?php

$servername = "localhost";
$username = "root"; // Cambia esto si tienes otro usuario
$password = "qwerty"; // Si tienes una contraseña, agrégala aquí
$database = "registroestudiantes"; // Cambia esto por el nombre real

$conn = new mysqli($servername, $username, $password, $database);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Consulta para obtener las estadísticas basadas en el estado
$sql = "SELECT 
            (SELECT COUNT(*) FROM datos_estudiantes) AS total,
            (SELECT COUNT(*) FROM datos_estudiantes WHERE estado = 'Aprobado') AS aprobadas,
            (SELECT COUNT(*) FROM datos_estudiantes WHERE estado = 'Denegado') AS denegadas,
            (SELECT COUNT(*) FROM datos_estudiantes WHERE estado = 'Pendiente') AS pendientes";

$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

$estadisticas = $result->fetch_assoc();

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($estadisticas);

$conn->close();
?>