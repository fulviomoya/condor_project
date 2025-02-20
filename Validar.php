<?php
// validar.php
session_start();

// Credenciales predeterminadas
define('USUARIO_CORRECTO', 'admin');
define('PASS_CORRECTA', '&&6I+7q7Oh-3');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === USUARIO_CORRECTO && $password === PASS_CORRECTA) {
        // Login exitoso
        $_SESSION['usuario_autenticado'] = true;
        $_SESSION['nombre_usuario'] = $username;
        header('Location: Parte_Administrativa/Dashboard(tabla).php ');
        exit;
    } else {
        // Login fallido
        header('Location: login.html?error=1');
        exit;
    }
}
?>