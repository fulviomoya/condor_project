<?php
// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "registroestudiantes";

try {
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die(json_encode(["success" => false, "message" => "Error de conexión: " . $conn->connect_error]));
    }

    $conn->set_charset("utf8");
} catch (Exception $e) {
    die(json_encode(["success" => false, "message" => "Error de conexión: " . $e->getMessage()]));
}
