<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Estudiante</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="IMG/SUKA2.png">
  <link rel="stylesheet" href="css/Form_11.css">
</head>

<body>

  <div class="container1">
    <div class="form-cont">
      <div class="izquierda">
        <div class="cont_izquierda">
          <div class="tittle_form_cont">
            <h2 class="tittle_form">Datos personales del estudiante y Padre</h2>
          </div>

          <div class="circulos">
            <div class="num">1</div>
            <div class="line"></div>
            <div class="num">2</div>
            <div class="line" style=></div>
            <div class="num">3</div>
            <div class="line" style=></div>
            <div class="num">4</div>
            <div class="line"></div>
            <div class="num">5</div>
            <div class="line"></div>
            <div class="num">6</div>

          </div>
          <form action="datos.php" method="post" enctype="multipart/form-data" id="form">
            <!-- first section -->
            <div class="first_section">
              <div>
                <label for="nombre">Nombre del estudiante:</label>
                <input id="nombre" name="nombre" type="text" placeholder="Nombre" required>
              </div>

              <div>
                <label for="apellido">Primer apellido del estudiante:</label>
                <input id="apellido" name="apellido" type="text" placeholder="Apellido" required>
              </div>

              <div>
                <label for="segundo_apellido">Segundo apellido del estudiante:</label>
                <input id="segundo_apellido" name="segundo_apellido" type="text" placeholder="Segundo apellido"
                  required>
              </div>

              <div>
                <label for="edad">Edad del estudiante:</label>
                <input id="edad" name="edad" type="number" min="5" max="25" placeholder="Edad" required>
              </div>

              <button>Siguiente</button>
            </div>

            <!-- second sectionn -->
            <div class="second_section">
              <div class="acta">
                <label for="id_acta_nacimiento">ID de acta de nacimiento:</label>

                <div class="Adjuntar_acta">
                  <input id="id_acta_nacimiento" name="id_acta_nacimiento" type="number"
                    placeholder="ID de acta de nacimiento" maxlength="19" required>

                  <label for="Acta_de_nacimiento" class="label_acta">
                    Adjuntar Acta de nacimiento
                    <input type="file" id="Acta_de_nacimiento" name="acta_nacimiento" class="acta_input" accept=".pdf,.jpg,.jpeg,.png,.gif"
                      required>
                  </label>
                </div>
              </div>

              <div>
                <label for="RecordDeNotas">Boletín de calificaciones</label>
                <label class="label_Notas">
                  Adjuntar boletín de calificaciones
                  <input type="file" id="record_notas" name="record_notas" class="Notas_input" accept=".pdf,.jpg,.jpeg,.png,.gif" required>
                </label>
              </div>

              <div>
                <label for="escuela_anterior">Escuela Anterior</label>
                <input id="escuela_anterior" name="escuela_anterior" type="text" placeholder="Escuela anterior"
                  required>
              </div>



              <button>Siguiente</button>
            </div>
            <!-- third section -->
            <div class="third_section">
              <div>
                <label for="sector">Sector</label>
                <input id="sector" name="sector" type="text" placeholder="Sector" required>
              </div>

              <div>
                <label for="localidad">Localidad</label>
                <select id="localidad" name="localidad" required>
                  <option value="" disabled selected>Seleccione una opción</option>
                  <option value="Santo Domingo Este">Santo Domingo Este</option>
                  <option value="Distrito Nacional">Distrito Nacional</option>
                  <option value="Santo Domingo Oeste">Santo Domingo Oeste</option>
                  <option value="Santo Domingo Norte">Santo Domingo Norte</option>
                </select>
              </div>

              <div>
                <label for="direccion_actual">Dirección Actual del estudiante</label>
                <input id="direccion_actual" name="direccion_actual" type="text" placeholder="Dirección actual"
                  required>
              </div>
              <div>
                <div class="field">
                  <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                  <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" required>
                </div>
              </div>

              <button>Siguiente</button>
            </div>

            <!-- Fourth section -->
            <div class="fourth_section">
              <div>
                <label for="lugar_nacimiento">Lugar de Nacimiento</label>
                <input id="lugar_nacimiento" name="lugar_nacimiento" type="text" placeholder="Lugar de Nacimiento"
                  required>
              </div>

              <div>
                <label for="nacionalidad_select">Nacionalidad:</label>
                <select id="nacionalidad_select" name="nacionalidad" required>
                  <option value="" disabled selected>Seleccione su nacionalidad</option>
                  <option value="dominicana">Dominicana</option>
                  <option value="otro">Otra</option>
                </select>
              </div>

              <div id="otra_nacionalidad_div" style="display: none;">
                <label for="otra_nacionalidad">Especifique su nacionalidad:</label>
                <input type="text" id="otra_nacionalidad" name="otra_nacionalidad" placeholder="Ingrese su nacionalidad">
              </div>
              <div>
                <label for="correo_electronico">Correo Electronico</label>
                <input id="correo_electronico" name="correo_electronico" type="email"
                  placeholder="Correo Electrónico" required>
              </div>

              <div>
                <label for="grado_solicitado">Grado Solicitado</label>
                <select id="grado_solicitado" name="grado_solicitado" required>
                  <option value="" disabled selected>Seleccione un Grado</option>
                  <option value="Primero">Primero (Antiguo Septimo)</option>
                  <option value="Segundo">Segundo (Antiguo Octavo)</option>
                  <option value="Tercero">Tercero (Antiguo Primero de Bachiller)</option>
                </select>
              </div>

              <button>Enviar</button>
            </div>
            <div class="fifth_section">
              <div>
                <label for="nombre_padres">Nombre del padre o tutor:</label>
                <input id="nombre_padres" name="nombre_padres" type="text" placeholder="Nombre completo" required>
              </div>

              <div>
                <label for="tipo_familia">Tipo de familia:</label>
                <select id="tipo_familia" name="tipo_familia" required>
                  <option value="" disabled selected>Seleccione tipo de familia</option>
                  <option value="biparental">Biparental</option>
                  <option value="monoparental">Monoparental</option>
                </select>
              </div>

              <div>
                <label for="ocupacion">Ocupación:</label>
                <select id="ocupacion" name="ocupacion_padres" required>
                  <option value="" disabled selected>Seleccione ocupación</option>
                  <option value="publica">Empleado público</option>
                  <option value="privada">Empleado privado</option>
                  <option value="independiente">Trabajador independiente</option>
                </select>
              </div>

              <button>Siguiente</button>
            </div>

            <!-- Sixth section (Segunda sección de padres) -->
            <div class="sixth_section">
              <div>
                <label for="telefono">Teléfono:</label>
                <input id="telefono" name="telefono_padres" type="tel" placeholder="telefono" required>
              </div>

              <div>
                <label for="correo_padres">Correo electrónico:</label>
                <input id="correo_padres" name="correo_padres" placeholder="correo del padre" type="email" required>
              </div>

              <div>
                <label for="direccion_padres">Dirección:</label>
                <input id="direccion_padres" name="direccion_padres" type="text" placeholder="direccion actual" required>
              </div>

              <button>Finalizar</button>
            </div>

          </form>

          <!-- Contenedor para alertas -->
          <div id="alertContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 11"></div>

        </div>
      </div>
      <div class="derecha">

      </div>
    </div>

  </div>
  <!-- Agregar Bootstrap JS y Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../Parte_Usuario\js\request-form.js"></script>

  <script>
        function verificarHorario() {
            const ahora = new Date();
            const hora = ahora.getHours();
            const minutos = ahora.getMinutes();

            // Si son las 4:00 PM (16:00) o más tarde
            if (hora >= 16) {
                window.location.href = 'mensaje.html';
            }
        }

        // Verificar cada minuto
        setInterval(verificarHorario, 60000);

        // Verificar inmediatamente al cargar la página
        verificarHorario();
        
        document.addEventListener('DOMContentLoaded', function() {
            // Verificar si hay datos del formulario en sessionStorage
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

</body>

</html>