<?php
// Añadir al principio de Form1.php e index.php
session_start();
header("Location: Parte_Usuario/recuperar-id-plaza.php");
exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Parte_Administrativa/IMG/SUKA.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Manual de usuario</title>
</head>

<body>
    <!-- contenido principal primera pagina -->
    <div class="prin">
        <div class="container">
            <div class="header">
                <img src="Parte_Administrativa\IMG\LOGO.png" alt="">
                <h1>¡Bienvenido al <span>Politécnico ITLA!</span></h1>
                <a href="Login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-linecap="round" stroke-linejoin="round" width="36" height="36" stroke-width="1.55">
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                    </svg>
                </a>
            </div>


            <div class="instructions">
                Para evitar inconvenientes, por favor, leer detenidamente todas las <span href="#">instrucciones</span>
                antes
                de
                llenar el formulario.
            </div>

            <div id="page1" class="page active">
                <h2 class="manual-title">Formulario de los Alumnos</h2>
                <ul class="field-list">
                    <li>
                        <span class="field-name">Nombre y Apellido:</span>
                        <span class="field-description">Asegúrate de completar estos campos tal y como están escritos en
                            el acta
                            de nacimiento del alumno.</span>
                    </li>
                    <li>
                        <span class="field-name">Cédula:</span>
                        <span class="field-description"> Ingresa el número de identificación del acta de nacimiento del
                            alumno (O también llamada cédula) sin espacios ni guiones. </span>
                    </li>
                    <li>
                        <span class="field-name">Acta de Nacimiento:</span>
                        <span class="field-description">
                            Adjuntar un documento o foto del acta de nacimiento del estudiante.
                            <span class="ejemplo" onclick="openModal()">Ejemplo</span>
                        </span>
                        <!-- Modal -->
                        <div id="myModal" class="modal">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2>Ejemplo de Acta de Nacimiento</h2>
                                    <button class="close-button" onclick="closeModal()"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="Parte_Usuario/IMG/Captura.JPG" alt="Ejemplo de Acta de Nacimiento">
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <span class="field-name">Boletín de calificaciones:</span>
                        <span class="field-description">
                            Adjuntar un documento o foto del boletín de calificaciones del curso anterior del estudiante.
                        </span>
                    </li>
                    <li>
                        <span class="field-name">Escuela Anterior:</span>
                        <span class="field-description">Nombre del recinto donde el alumno está cursando
                            actualmente.</span>
                    </li>
                    <li>
                        <span class="field-name">Dirección Actual:</span>
                        <span class="field-description">Completar este campo con tu domicilio actual, no
                            necesariamente el
                            que contiene la cédula de identidad del padre o tutor.</span>
                    </li>
                    <li>
                        <span class="field-name">Sector:</span>
                        <span class="field-description">Indica el sector en el que resides actualmente.</span>
                    </li>
                    <li>
                        <span class="field-name">Localidad:</span>
                        <span class="field-description">Selecciona la localidad a la que pertenece su sector dentro de
                            las
                            opciones disponibles.</span>
                    </li>
                    <li>
                        <span class="field-name">Fecha de Nacimiento:</span>
                        <span class="field-description">Fecha de nacimiento del alumno.</span>
                    </li>
                    <li>
                        <span class="field-name">Lugar de Nacimiento:</span>
                        <span class="field-description">Provincia de nacimiento del alumno.</span>
                    </li>
                    <li>
                        <span class="field-name">Grado que Solicita:</span>
                        <span class="field-description">Curso al que será promovido el alumno.</span>
                    </li>
                    <li>
                        <span class="field-name">Nacionalidad:</span>
                        <span class="field-description">País de nacimiento del alumno.</span>
                    </li>
                </ul>
                <div class="nota">
                    <span style="font-weight: bold; color: red;">NOTA:</span>
                    <ol>
                        <li>Al finalizar el formulario el ID
                            suministrado sera utilizado
                            para notificar si el alumno fue admitido. (Recordar ID de manera obligatoria).</li>

                        <li>
                            <span> Recomendamos realizar el
                                proceso desde un
                                computador. En caso de utilizar dispositivos móviles se recomiendan navegadores como
                                Safari (en IOS) y Chrome (en Android).
                        </li>
                    </ol>
                </div>
                <button onclick="nextPage()" class="btn btn-next">Siguiente</button>
            </div>

            <!-- segunda pagina -->

            <div id="page2" class="page">
                <h2 class="manual-title">Formulario Representante</h2>
                <ul class="field-list">
                    <li>
                        <span class="field-name">Ocupación:</span>
                        <span class="field-description">Selecciona a lo que te dedicas.</span>
                    </li>
                    <li>
                        <span class="field-name">Teléfono:</span>
                        <span class="field-description">Teléfono para contactar en caso de que el alumno sea
                            admitido.</span>
                    </li>
                    <li>
                        <span class="field-name">Correo Electrónico:</span>
                        <span class="field-description">Campo obligatorio. Por aquí te estaremos suministrando
                            informaciones
                            importantes sobre el proceso de admisión. Asegúrate de ingresar un correo activo.</span>
                    </li>
                    <li>
                        <span class="field-name">Nombre:</span>
                        <span class="field-description">Nombre de ambos padres del alumno.</span>
                    </li>
                    <li>
                        <span class="field-name">Familia:</span>
                        <span class="field-description">Selecciona el tipo de familia.</span>
                    </li>
                    <li>
                        <span class="field-name">Dirección:</span>
                        <span class="field-description">Debes completar este campo con tu domicilio actual, no
                            necesariamente el
                            que contiene la cédula de identidad.</span>
                    </li>
                </ul>

                <!-- <div class="nota">
                    <span class="nota-label">Nota:</span> Cliquea el botón "Siguiente" para completar el formulario.
                </div> -->
                <div class="nota">
                    <span style="font-weight: bold; color: red;">NOTA:</span>

                    Es imprecindible que los documentos enviados sean los solicitados para que se complete de manera
                    exitosa
                    el
                    proceso de admisión.
                    </span>


                </div>

                <div class="button-container">
                    <button onclick="previousPage()" class="btn btn-back">Volver</button>
                    <a href="Parte_Usuario/recuperar-id-plaza.php">Recuperar ID de Plaza</a>
                </div>
            </div>

            <div class="page-indicator">
                <span id="pageNumber">1</span> de 2
            </div>
        </div>
    </div>

    <!-- Agregar Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- Modal de éxito -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Politécnico ITLA</h5>
                    <a href="https://politecnicoitla.edu.do/">
                        <button type="button" class="btn-close"></button>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h4>Datos de su solicitud</h4>
                    </div>
                    <div class="info-container">
                        <p><strong>ID de Plaza:</strong> <span id="modalIdPlaza"></span></p>
                        <p><strong>Nombre Completo:</strong> <span id="modalNombre"></span></p>
                    </div>
                    <div class="alert alert-warning mt-3">
                        <small>*Por favor, guarde estos datos para futuras referencias*</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="https://politecnicoitla.edu.do/">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Entendido</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function verificarHorario() {
            // Redirigir directamente a la página de recuperación de ID
            window.location.href = 'Parte_Usuario/recuperar-id-plaza.php';
        }

        // Verificar inmediatamente al cargar la página
        verificarHorario();

        document.addEventListener('DOMContentLoaded', function() {
             //Verificar si hay datos del formulario en sessionStorage
            const formularioData = sessionStorage.getItem('formularioData');
            if (formularioData) {
                const data = JSON.parse(formularioData);

                // Llenar el modal con los datos
                document.getElementById('modalIdPlaza').textContent = data.idPlaza;
                document.getElementById('modalNombre').textContent = data.nombreCompleto;

                // Mostrar el modal
                const modal = new bootstrap.Modal(document.getElementById('successModal'));
                modal.show();

                // Limpiar sessionStorage
                sessionStorage.removeItem('formularioData');
            }
        });
    </script>

    <script src="js.js"></script>
    <script src="js_ventana.js"></script>

</body>

</html>