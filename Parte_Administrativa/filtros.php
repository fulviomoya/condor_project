<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug
    error_log("POST data recibida: " . print_r($_POST, true));

    $id = trim($_POST['id'] ?? '');
    $estado = $_POST['estado'] ?? '';
    $razon = $_POST['razon'] ?? null;

    if (empty($id) || empty($estado)) {
        echo json_encode(['success' => false, 'message' => 'Faltan parámetros requeridos']);
        exit;
    }

    $conn = new mysqli("localhost", "root", "qwerty", "registroestudiantes");

    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Error de conexión: ' . $conn->connect_error]);
        exit;
    }

    // Debug
    error_log("Buscando registro con ID: $id");

    $sql = "UPDATE datos_estudiantes SET estado = ?, motivo_denegacion = ? WHERE id_plaza = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $estado, $razon, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } else {
            error_log("No se actualizó ningún registro. ID: $id, Estado: $estado");
            echo json_encode(['success' => false, 'message' => 'No se encontró el registro o no hubo cambios']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
