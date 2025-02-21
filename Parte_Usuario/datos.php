<?php
// Archivo: datos1.php - Procesa el primer formulario
session_start();
include("../config.php");
include("conexion.php");

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "RegistroEstudiantes";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $apellido = trim($_POST["apellido"]);
    $segundo_apellido = trim($_POST["segundo_apellido"]);
    $edad = intval(trim($_POST["edad"])); // Nuevo campo de edad
    $id_acta_nacimiento = trim($_POST["id_acta_nacimiento"]);
    $escuela_anterior = trim($_POST["escuela_anterior"]);
    $direccion_actual = trim($_POST["direccion_actual"]);
    $sector = trim($_POST["sector"]);
    $localidad = trim($_POST["localidad"]);
    $fecha_nacimiento = trim($_POST["fecha_nacimiento"]);
    $lugar_nacimiento = trim($_POST["lugar_nacimiento"]);
    $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : (isset($_POST['otra_nacionalidad']) ? $_POST['otra_nacionalidad'] : '');
    $correo_electronico = trim($_POST["correo_electronico"]);
    $grado_solicitado = trim($_POST["grado_solicitado"]);


    // Verificar si el ID ya está registrado (modificado)
    $check_sql = "SELECT id_acta_nacimiento FROM datos_estudiantes WHERE id_acta_nacimiento = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $id_acta_nacimiento);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Error: El ID de acta de nacimiento ya está registrado.");
    }
    $stmt->close();

    // Crear nombre de usuario normalizado
    $nombre_usuario = $nombre . "_" . $apellido;
    $nombre_usuario = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombre_usuario);

    // Crear carpeta con formato: nombre_usuario_idActaNacimiento
    $nombre_carpeta = "uploads/" . $nombre_usuario . "_" . $id_acta_nacimiento . "/";
    if (!is_dir($nombre_carpeta)) {
        mkdir($nombre_carpeta, 0777, true);
    }

    $acta_nacimiento_path = "";
    $record_notas_path = "";

    // Definir límite de tamaño (2MB)
    $max_file_size = 2 * 1024 * 1024; // 2MB

    // Validar acta de nacimientoo
    if (isset($_FILES["acta_nacimiento"]) && $_FILES["acta_nacimiento"]["error"] == 0) {
        if ($_FILES["acta_nacimiento"]["size"] > $max_file_size) {
            die("❌ El archivo del acta de nacimiento es demasiado grande (máx. 2MB).");
        }
    }

    // Validar récord de notas
    if (isset($_FILES["record_notas"]) && $_FILES["record_notas"]["error"] == 0) {
        if ($_FILES["record_notas"]["size"] > $max_file_size) {
            die("❌ El archivo del récord de notas es demasiado grande (máx. 2MB).");
        }
    }
    // Procesar el acta de nacimiento
    if (isset($_FILES["acta_nacimiento"]) && $_FILES["acta_nacimiento"]["error"] == 0) {
        $file_ext = pathinfo($_FILES["acta_nacimiento"]["name"], PATHINFO_EXTENSION);

        if (strtolower($file_ext) == 'pdf') {
            $ruta_acta = $nombre_carpeta . "acta.pdf";
            if (move_uploaded_file($_FILES["acta_nacimiento"]["tmp_name"], $ruta_acta)) {
                $acta_nacimiento_path = $ruta_acta;
                echo "✅ Acta guardada en: $ruta_acta <br>";
            } else {
                echo "❌ Error al guardar el acta de nacimiento.<br>";
            }
        } else {
            echo "❌ El acta de nacimiento debe ser un archivo PDF.<br>";
        }
    } else {
        echo "❌ No se recibió el acta de nacimiento.<br>";
    }

    // Procesar el récord de notas
    if (isset($_FILES["record_notas"]) && $_FILES["record_notas"]["error"] == 0) {
        $file_ext = pathinfo($_FILES["record_notas"]["name"], PATHINFO_EXTENSION);

        if (strtolower($file_ext) == 'pdf') {
            $ruta_record = $nombre_carpeta . "record.pdf";
            if (move_uploaded_file($_FILES["record_notas"]["tmp_name"], $ruta_record)) {
                $record_notas_path = $ruta_record;
                echo "✅ Record guardado en: $ruta_record <br>";
            } else {
                echo "❌ Error al guardar el récord de notas.<br>";
            }
        } else {
            echo "❌ El récord de notas debe ser un archivo PDF.<br>";
        }
    } else {
        echo "❌ No se recibió el récord de notas.<br>";
    }

    // Modificar la consulta INSERT para usar id_acta_nacimiento como clave principal
    $sql_estudiante = "INSERT INTO datos_estudiantes (
        nombre, apellido, segundo_apellido, edad, 
        id_acta_nacimiento, escuela_anterior, direccion_actual,
        sector, localidad, fecha_nacimiento, lugar_nacimiento,
        nacionalidad, correo_electronico, grado_solicitado,
        nombre_padres, ocupacion_padres, telefono_padres,
        correo_padres, tipo_familia, direccion_padres,
        record_calificaciones, acta_nacimiento_pdf
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
        COALESCE(?, 'No registrado'), 
        COALESCE(?, 'No registrado'), 
        COALESCE(?, 'No registrado'),
        COALESCE(?, 'No registrado'),
        COALESCE(?, 'No registrado'),
        COALESCE(?, 'No registrado'),
        ?, ?
    )";


    if (!$stmt) {
        die("Error en la consulta: " . $conn->error);
    }

    $resultado = $conn->query("SELECT COUNT(*) AS total FROM datos_estudiantes");
    $fila = $resultado->fetch_assoc();

    if ($fila['total'] >= 300) {
        die("No se pueden agregar más estudiantes, el límite de 300 ha sido alcanzado.");
    }

    // Modificar el orden de los parámetros en bind_param
    // Preparar y ejecutar la consulta con todos los datos
    $stmt = $conn->prepare($sql_estudiante);
    $stmt->bind_param(
        "sssissssssssssssssssss", // Añadir dos 's' más para los archivos
        $nombre,
        $apellido,
        $segundo_apellido,
        $edad,
        $id_acta_nacimiento,
        $escuela_anterior,
        $direccion_actual,
        $sector,
        $localidad,
        $fecha_nacimiento,
        $lugar_nacimiento,
        $nacionalidad,
        $correo_electronico,
        $grado_solicitado,
        $_POST['nombre_padres'],
        $_POST['ocupacion_padres'],
        $_POST['telefono_padres'],
        $_POST['correo_padres'],
        $_POST['tipo_familia'],
        $_POST['direccion_padres'],
        $record_notas_path,    // Agregar ruta del record
        $acta_nacimiento_path  // Agregar ruta del acta
    );

    // Ejecutar la consulta y manejar errores
    if ($stmt->execute()) {
        header("Location: Form1.php");
        echo "Registro completado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
