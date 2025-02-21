<?php
// Conexión a la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "RegistroEstudiantes";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conexion->connect_error]));
}

// Establecer codificación UTF-8

// Consulta sin JOIN, ya que ahora los datos de los padres están en datos_estudiantes
$sql = "SELECT 
            id, 
            nombre, 
            apellido, 
            segundo_apellido, 
            localidad, 
            sector, 
            direccion_actual AS direccion, 
            escuela_anterior, 
            fecha_nacimiento, 
            id_acta_nacimiento AS acta_nacimiento, 
            record_calificaciones AS record_notas, 
            correo_electronico AS correo,
            grado_solicitado,
            nombre_padres, 
            ocupacion_padres, 
            tipo_familia, 
            telefono_padres AS telefono, 
            direccion_padres
        FROM datos_estudiantes
        ORDER BY id DESC";

$resultado = $conexion->query($sql);


if (!$resultado) {
    echo json_encode([
        "error" => "Error en la consulta: " . $conexion->error,
        "sql" => $sql
    ]);
    $conexion->close();
    exit;
}

$usuarios = [];

while ($fila = $resultado->fetch_assoc()) {
    $usuarios[] = $fila;
}

// Configurar cabecera JSON y devolver datos
header('Content-Type: application/json; charset=utf-8');
echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);

$conexion->close();
?>