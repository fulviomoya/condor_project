<?php
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "RegistroEstudiantes";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta para todas las solicitudes
$sql = "SELECT id_acta_nacimiento as id, nombre, apellido, segundo_apellido, 
        sector, localidad, estado, nombre_padres, direccion_actual as direccion, 
        escuela_anterior, fecha_nacimiento, ocupacion_padres, tipo_familia, 
        telefono_padres as telefono, correo_electronico as correo, 
        acta_nacimiento_pdf, record_calificaciones
        FROM datos_estudiantes 
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
