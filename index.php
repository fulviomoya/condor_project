<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Parte_Administrativa/IMG/SUKA.png">
    <link rel="stylesheet" href="style.css">
    <title>Inicio</title>
</head>

<body>
    <!-- contenido principal primera pagina -->
    <div class="prin">
        <div class="container">
            <div class="header">
                <img src="Parte_Administrativa\IMG\LOGO.png" alt="">
                <h1>¡Bienvenido al <span>Politecnico ITLA</span>!</h1>
                <a href="Login.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-circle">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                    </svg>
                </a>
            </div>


            <div class="instructions">
                Para evitar inconvenientes, por favor, leer detenidamente todas las <a href="#">instrucciones</a> antes
                de
                llenar el formulario.
            </div>

            <div id="page1" class="page active">
                <h2>Formulario de los Alumno</h2>
                <ul class="field-list">
                    <li>
                        <span class="field-name">Nombre y Apellido:</span>
                        <span class="field-description">Asegúrate de completar estos campos tal y como están escritos en
                            el acta
                            de nacimiento del alumno.</span>
                    </li>
                    <li>
                        <span class="field-name">Cédula:</span>
                        <span class="field-description">Ver imagen de referencia para llenar este campo.</span>
                    </li>
                    <li>
                        <span class="field-name">Escuela Anterior:</span>
                        <span class="field-description">Nombre del recinto donde el alumno está cursando
                            actualmente.</span>
                    </li>
                    <li>
                        <span class="field-name">Dirección Actual:</span>
                        <span class="field-description">Debes completar este campo con tu domicilio actual, no
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
                    <span class="nota-label">Nota:</span> Al finalizar el formulario el ID suministrado sera utilizado
                    para dar la información si el alumno fue admitido. (Recordar ID de manera obligatoria)
                </div>
                <button onclick="nextPage()" class="btn btn-next">Siguiente</button>
            </div>

            <!-- segunda pagina -->

            <div id="page2" class="page">
                <h2>Formulario Representante</h2>
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
                        <span class="field-description">Selecciona el tipo de familia que es.</span>
                    </li>
                    <li>
                        <span class="field-name">Dirección:</span>
                        <span class="field-description">Debes completar este campo con tu domicilio actual, no
                            necesariamente el
                            que contiene la cédula de identidad.</span>
                    </li>
                </ul>

                <div class="nota">
                    <span class="nota-label">Nota:</span> Clickea el botón "Siguiente" para completar el formulario.
                </div>

                <div class="button-container">
                    <button onclick="previousPage()" class="btn btn-back">Volver</button>
                    <a href="Parte_Usuario/Form1.php" class="btn btn-form">Ir al formulario</a>
                </div>
            </div>

            <div class="page-indicator">
                <span id="pageNumber">1</span> de 2
            </div>
        </div>
    </div>


    <script src="js.js"></script>

</body>

</html>