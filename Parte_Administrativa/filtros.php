<?php
require_once 'conexion.php'; // Asegúrate de tener un archivo de conexión a la base de datos

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $razon = isset($_POST['razon']) ? $_POST['razon'] : null;

    $query = "UPDATE datos_estudiantes SET estado = ?, motivo_denegacion = ? WHERE id_acta_nacimiento = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('sss', $estado, $razon, $id);

    if ($stmt->execute()) {
        $response['success'] = true;
    } else {
        $response['message'] = 'Error al actualizar el estado';
    }

    $stmt->close();
}

echo json_encode($response);
?>