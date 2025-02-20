<?php
// aceptadas.php - Maneja la visualización de solicitudes aceptadas
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "RegistroEstudiantes";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener todas las columnas necesarias para solicitudes aceptadas
$sql = "SELECT id, nombre, apellido, segundo_apellido, sector, localidad, estado 
        FROM datos_estudiantes 
        WHERE estado = 'Aprobado' 
        ORDER BY id DESC";
$resultado = $conexion->query($sql);

$usuarios = [];
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
}

// Devolver los resultados como JSON
header('Content-Type: application/json');
echo json_encode($usuarios);

$conexion->close();
?>