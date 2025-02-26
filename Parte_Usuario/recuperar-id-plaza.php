<?php
include_once '../Parte_Administrativa/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idActa = $_POST['idActa'];

    // Validar que el ID de acta sea un número y no exceda 19 caracteres
    if (!is_numeric($idActa) || strlen($idActa) > 19) {
        echo json_encode(["success" => false, "message" => "ID de acta inválido"]);
        exit();
    }

    // Usar prepared statements para prevenir SQL injection
    $sql = "SELECT nombre, apellido, id_plaza FROM datos_estudiantes WHERE id_acta_nacimiento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $idActa); // Cambiado de "sss" a "s"
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            "success" => true,
            "idSolicitud" => $row['id_plaza'],
            "nombreCompleto" => $row['nombre'] . ' ' . $row['apellido']
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "No se encontró ninguna solicitud con el Id de acta de nacimiento proporcionado."]);
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imagen/Copy_of_02it-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="css/recuperar-id-form.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Politécnico ITLA | Recuperar Id de Plaza</title>
</head>

<body>
    <!-- Contenedor para alertas -->
    <div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 11"></div>

    <div class="main-container">
        <div class="logo-container">
            <img src="IMG/logo1.png" alt="logo" class="logo">
        </div>
        <div class="form-container">
            <div class="recuperar-id-form-container">
                <form action="recuperar-id-plaza.php" class="recuperar-formulario" id="formRecuperar">
                    <div class="recuperar-title-container">

                        <h2>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-key">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14.52 2c1.029 0 2.015 .409 2.742 1.136l3.602 3.602a3.877 3.877 0 0 1 0 5.483l-2.643 2.643a3.88 3.88 0 0 1 -4.941 .452l-.105 -.078l-5.882 5.883a3 3 0 0 1 -1.68 .843l-.22 .027l-.221 .009h-1.172c-1.014 0 -1.867 -.759 -1.991 -1.823l-.009 -.177v-1.172c0 -.704 .248 -1.386 .73 -1.96l.149 -.161l.414 -.414a1 1 0 0 1 .707 -.293h1v-1a1 1 0 0 1 .883 -.993l.117 -.007h1v-1a1 1 0 0 1 .206 -.608l.087 -.1l1.468 -1.469l-.076 -.103a3.9 3.9 0 0 1 -.678 -1.963l-.007 -.236c0 -1.029 .409 -2.015 1.136 -2.742l2.643 -2.643a3.88 3.88 0 0 1 2.741 -1.136m.495 5h-.02a2 2 0 1 0 0 4h.02a2 2 0 1 0 0 -4" />
                            </svg>

                            Recuperar Código de Solicitud
                        </h2>
                        <div class="recuperar-desc">
                            <small>Al ingresar el Id de acta de nacimiento de su hijo se consultará en nuestros sistemas para recuperar el código de la solicitud correspondiente.</small>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="primera-fila">
                            <div class="campo-id-acta">
                                <label for="">Id de acta de nacimiento</label>
                                <input type="text" name="idActa" id="idActa" placeholder="ID de acta de nacimiento" maxlength="19">
                                <div id="resultadoBusqueda" class="mt-2 text-success" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="boton-container">
                        <button type="submit" class="boton-enviar">Comprobar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="form-image-container">
            <img src="IMG/Img_form2.jpeg" alt="imagen" class="form-image">
        </div>
    </div>

    <!-- Agregar Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="../Parte_Usuario\js\recover-id.js"></script>
</body>

</html>