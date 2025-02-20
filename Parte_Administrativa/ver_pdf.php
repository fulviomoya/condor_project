<?php
// Archivo: ver_pdf.php
session_start();
include("../config.php");
include("conexion.php");

// Habilita errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica si se pasó el ID y el tipo de documento
if (!isset($_GET['id']) || !isset($_GET['tipo'])) {
    die("Acceso no válido.");
}

$id = intval($_GET['id']); // Convierte el ID a número entero para evitar inyección SQL
$tipo = $_GET['tipo'];

// CONSULTA A LA BASE DE DATOS PARA OBTENER LA RUTA DIRECTA DEL ARCHIVO
if ($tipo === "acta") {
    $query = "SELECT acta_nacimiento_pdf, nombre, apellido FROM datos_estudiantes WHERE id = ?";
} elseif ($tipo === "record") {
    $query = "SELECT record_calificaciones, nombre, apellido FROM datos_estudiantes WHERE id = ?";
} else {
    die("Tipo de documento no válido.");
}

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("No se encontró el usuario con ID: $id");
}

$row = $result->fetch_assoc();

// Determinar la ruta del archivo según el tipo
if ($tipo === "acta") {
    $archivo = $row['acta_nacimiento_pdf'];
} else { // record
    $archivo = $row['record_calificaciones'];
}

// Si la ruta no existe en la DB, intenta construirla
if (empty($archivo)) {
    $nombre_usuario = $row['nombre'] . "_" . $row['apellido'];
    $nombre_usuario = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombre_usuario);

    if ($tipo === "acta") {
        $archivo = "uploads/" . $nombre_usuario . "/acta.pdf";
    } else {
        $archivo = "uploads/" . $nombre_usuario . "/record.pdf";
    }
}

// Verificar si la ruta es relativa y añadir la ruta base si es necesario
if (strpos($archivo, '/') !== 0 && strpos($archivo, ':') === false) {
    // Si la ruta comienza con "uploads/"
    if (strpos($archivo, 'uploads/') === 0) {
        $archivo = "../Parte_Usuario/" . $archivo;
    }
}

// Imprime la ruta para depuración (puedes comentar esta línea en producción)
// echo "Ruta generada: $archivo<br>";

// Verifica si el archivo existe
if (!file_exists($archivo)) {
    die("El archivo no existe en la ruta: $archivo");
}

if (!is_readable($archivo)) {
    die("El archivo existe pero no es accesible (permisos).");
}

// Determinar el tipo de contenido
$extension = pathinfo($archivo, PATHINFO_EXTENSION);
if (strtolower($extension) == 'pdf') {
    $tipo_contenido = 'application/pdf';
} else {
    die("Tipo de archivo no soportado");
}

// Enviar el archivo PDF al navegador
header('Content-Type: ' . $tipo_contenido);
header('Content-Disposition: inline; filename="' . basename($archivo) . '"');
header('Content-Length: ' . filesize($archivo));
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

// Limpia el buffer y envía el archivo
ob_clean();
flush();
readfile($archivo);
exit;
?>