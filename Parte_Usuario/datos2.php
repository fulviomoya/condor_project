<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['estudiante_id'])) {
        die("Error: No se encontró información del estudiante.");
    }

    $estudiante_id = $_SESSION['estudiante_id'];

    // Recoger datos del formulario de padres
    $ocupacion_padres = trim($_POST["ocupacion"]);
    $telefono_padres = trim($_POST["telefono"]);
    $correo_padres = trim($_POST["correo_electronico"]);
    $nombre_padres = trim($_POST["nombre_padres"]);
    $tipo_familia = trim($_POST["tipo_familia"]);
    $direccion_padres = trim($_POST["direccion_actual"]);

    // Actualizar el registro con los datos de los padres
    $stmt = $conn->prepare("UPDATE datos_estudiantes SET 
        ocupacion_padres = ?, 
        telefono_padres = ?, 
        correo_padres = ?, 
        nombre_padres = ?, 
        tipo_familia = ?, 
        direccion_padres = ? 
        WHERE id_acta_nacimiento = ?");

    $stmt->bind_param(
        "sssssss",
        $ocupacion_padres,
        $telefono_padres,
        $correo_padres,
        $nombre_padres,
        $tipo_familia,
        $direccion_padres,
        $estudiante_id
    );

    if ($stmt->execute()) {
        // Limpiar la sesión después de guardar todo
        session_destroy();
        header("Location: Form1.php?success=true");
        exit();
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
