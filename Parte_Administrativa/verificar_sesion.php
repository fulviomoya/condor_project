<?php
function verificarSesion()
{
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../Login.php");
        exit();
    }
}
