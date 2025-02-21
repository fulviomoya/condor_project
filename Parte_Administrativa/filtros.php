<?php
require_once 'verificar_sesion.php';
verificarSesion();


// filtros.php
header('Content-Type: application/json');

$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "RegistroEstudiantes";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die(json_encode(['success' => false, 'message' => "Error de conexión: " . $conexion->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar los datos de entrada
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';

    if ($id <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID inválido']);
        exit;
    }

    if (!in_array($estado, ['Pendiente', 'Aprobado', 'Denegado'])) {
        echo json_encode(['success' => false, 'message' => 'Estado inválido']);
        exit;
    }

    // Preparar y ejecutar la consulta
    $sql = "UPDATE datos_estudiantes SET estado = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta']);
        exit;
    }

    $stmt->bind_param("si", $estado, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Estado actualizado correctamente',
                'id' => $id,
                'estado' => $estado
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'No se encontró el registro o el estado ya estaba actualizado'
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error al actualizar el estado: ' . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Método no permitido'
    ]);
}

$conexion->close();
