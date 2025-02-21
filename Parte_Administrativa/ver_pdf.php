<?php
require_once 'verificar_sesion.php';
verificarSesion();

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "RegistroEstudiantes";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (!isset($_GET['tipo']) || !isset($_GET['id'])) {
    die("Parámetros incorrectos");
}

$tipo = $_GET['tipo'];
$id = $_GET['id'];

// Seleccionar la columna correcta según el tipo de documento
$columna = ($tipo === 'acta') ? 'acta_nacimiento_pdf' : 'record_calificaciones';

// Preparar la consulta usando id_acta_nacimiento
$stmt = $conexion->prepare("SELECT $columna FROM datos_estudiantes WHERE id_acta_nacimiento = ?");

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("s", $id);

if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {
    // Modificar la construcción de la ruta para apuntar a Parte_Usuario
    $ruta_archivo = "../Parte_Usuario/" . $fila[$columna];

    // Agregar log para depuración
    error_log("Intentando acceder al archivo: " . $ruta_archivo);

    if (file_exists($ruta_archivo)) {
        // Verificar que el archivo sea un PDF
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $ruta_archivo);
        finfo_close($finfo);

        if ($mime_type === 'application/pdf') {
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($ruta_archivo) . '"');
            readfile($ruta_archivo);
            exit;
        } else {
            die("El archivo no es un PDF válido");
        }
    } else {
        die("El archivo no existe en el servidor. Ruta: " . $ruta_archivo .
            "\nRuta absoluta: " . realpath($ruta_archivo));
    }
}
$stmt->close();
$conexion->close();
