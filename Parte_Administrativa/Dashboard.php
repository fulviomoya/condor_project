<?php
require_once 'verificar_sesion.php';
verificarSesion();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Admisiones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="IMG/SUKA.png">
    <link rel="stylesheet" href="Dashboard.css">
</head>

<body>
    <div class="d-flex">
        <div class="sidebar p-4 vh-100">
            <h4 class="text-center"> <img src="IMG/LOGO.png" alt="Logo" class="img-fluid"> </h4>
            <ul class="nav flex-column">

                <div class="advance">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="Dashboard.php">
                            <i class="fa-solid fa-home"></i>Inicio
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-dark d-flex justify-content-between align-items-center" href="#"
                            data-bs-toggle="collapse" data-bs-target="#solicitudesSubmenu">
                            <span>
                                <i class="fa-solid fa-user"></i>Solicitudes
                            </span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="solicitudesSubmenu">
                            <ul class="nav flex-column ms-3 mt-2">
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="Dashboard(tabla).php">
                                        <i class="fa-solid fa-list"></i> Ver todas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="aceptadas.php">
                                        <i class="fa-solid fa-check"></i> Aprobadas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="denegadas.php">
                                        <i class="fa-regular fa-circle-xmark"></i> Denegadas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="Dashboard(tabla).php    ">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Pendientes
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="fa-solid fa-clipboard"></i>Reporte de datos
                        </a>
                    </li>
                </div>

                <div class="basic">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#">
                            <i class="fa-solid fa-gear"></i> Configuración
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="cerrar_sesion.php">
                            <i class="fa-sharp-duotone fa-solid fa-right-from-bracket"></i> Cerrar sesión
                        </a>
                    </li>
                </div>
            </ul>
        </div>

        <div class="container-fluid p-5">
            <div class="card p-4 mb-4 text-center">
                <h3 class="text-bienvenido">¡Bienvenido al panel de control del sistema de admisiones del Politécnico
                    ITLA!</h3>
                <p>Aquí encontrarás una herramienta amigable y eficiente para gestionar y visualizar los datos de los
                    aspirantes.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card p-4 text-center stat-card">
                        <h5>Solicitudes de admisión:</h5>
                        <h3 class="text-cantidad" id="totalSolicitudes">300</h3>
                        <i class="fa-sharp-duotone fa-regular fa-envelope fa-2x"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 text-center stat-card">
                        <h5>Solicitudes aprobadas:</h5>
                        <h3 class="text-cantidad" id="solicitudesAprobadas">150</h3>
                        <i class="fa-sharp-duotone fa-regular fa-circle-check fa-2x"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 text-center stat-card">
                        <h5>Solicitudes denegadas:</h5>
                        <h3 class="text-cantidad" id="solicitudesDenegadas">100</h3>
                        <i class="fa-solid fa-ban fa-2x"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card p-4 text-center stat-card">
                        <h5>Solicitudes en revisión:</h5>
                        <h3 class="text-cantidad" id="solicitudesRevision">50</h3>
                        <i class="fa-regular fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>

            <h3 class="text-access">Accesos:</h3>

            <div class="mt-4 text-center">
                <button class="btn btn-custom me-3">Ver reportes</button>
                <a href="Dashboard(tabla).php"><button class="btn btn-custom2">Ver solicitudes</button></a>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        actualizarEstadisticas();
    });

    function actualizarEstadisticas() {
        fetch("dash2.php")
            .then(response => response.json())
            .then(data => {
                document.getElementById("totalSolicitudes").innerText = data.total;
                document.getElementById("solicitudesAprobadas").innerText = data.aprobadas;
                document.getElementById("solicitudesDenegadas").innerText = data.denegadas;
                document.getElementById("solicitudesRevision").innerText = data.pendientes;
            })
            .catch(error => console.error("Error obteniendo estadísticas:", error));
    }
</script>

</html>