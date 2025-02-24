<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar que se recibieron los parámetros necesarios
if (!isset($_GET['tipo']) || !isset($_GET['id'])) {
    die('Parámetros incorrectos');
}

// Incluir archivo de conexión a la base de datos
require_once('../config.php');
$conn = new mysqli("localhost", "root", "", "registroestudiantes");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el tipo de documento y el ID
$tipo = $_GET['tipo'];
$id = $_GET['id'];

// Preparar la consulta según el tipo de documento
if ($tipo === 'acta') {
    $sql = "SELECT acta_nacimiento_pdf as ruta FROM datos_estudiantes WHERE id_plaza = ?";
} else if ($tipo === 'record') {
    $sql = "SELECT record_calificaciones as ruta FROM datos_estudiantes WHERE id_plaza = ?";
} else {
    die('Tipo de documento no válido');
}

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $ruta_archivo = $row['ruta'];

    // Construir la ruta completa correcta
    $ruta_completa = dirname(__DIR__) . "/Parte_Usuario/" . $ruta_archivo;

    // Verificar que el archivo existe
    if (!file_exists($ruta_completa)) {
        die('El archivo no existe en la ruta: ' . $ruta_completa);
    }

    // Obtener el tamaño del archivo
    $filesize = filesize($ruta_completa);
    if ($filesize === 0) {
        die('El archivo está vacío (0 bytes)');
    }

    // Limpiar cualquier salida previa
    ob_clean();

    // Configurar headers para mostrar el PDF
    header('Content-Type: application/pdf');
    header('Content-Length: ' . $filesize);
    header('Content-Disposition: inline; filename="' . basename($ruta_archivo) . '"');
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');

    // Leer y mostrar el archivo
    readfile($ruta_completa);
    exit;
} else {
    die('Archivo no encontrado en la base de datos');
}

$stmt->close();
$conn->close();
