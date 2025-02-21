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

// Modificar la consulta para usar id_acta_nacimiento
$sql = "SELECT id_acta_nacimiento as id, nombre, apellido, segundo_apellido, 
        sector, localidad, estado, 
        acta_nacimiento_pdf as acta_nacimiento
        FROM datos_estudiantes 
        WHERE estado = 'Denegado' 
        ORDER BY id_acta_nacimiento DESC";
$resultado = $conexion->query($sql);

$usuarios = [];
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
}

header('Content-Type: application/json');
echo json_encode($usuarios);

$conexion->close();
