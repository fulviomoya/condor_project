<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "registroestudiantes";

try {
    $conn = new mysqli($servername, $username, $password, $database);

    
    if ($conn->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    } else {
        echo "✅ Conectado a la base de datos correctamente.";
    }
    $conn->set_charset("utf8");

} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>