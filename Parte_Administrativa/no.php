<?php
require_once 'verificar_sesion.php';
verificarSesion();

$host = "localhost";
$usuario = "root";
$contrasena = "qwerty";
$base_datos = "registroestudiantes";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Modificar la consulta para usar id de plaza
$sql = "SELECT id_plaza, nombre, apellido, segundo_apellido,
         sector, nacionalidad, grado_solicitado, localidad, estado, nombre_padres, direccion_actual as direccion,
         escuela_anterior, fecha_nacimiento, ocupacion_padres, tipo_familia,
         telefono_padres as telefono, correo_electronico as correo,
         acta_nacimiento_pdf, record_calificaciones,
         motivo_denegacion
        FROM datos_estudiantes 
        WHERE estado = 'Denegado' 
        ORDER BY id_plaza DESC";
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
