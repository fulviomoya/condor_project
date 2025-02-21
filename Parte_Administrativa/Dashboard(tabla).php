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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="IMG/SUKA.png">
  <link rel="stylesheet" href="Dashboard(tabla).css">
</head>

<body>
  <div class="d-flex">
    <!-- Mantenemos el sidebar exactamente igual -->
    <div class="sidebar p-4 vh-100">
      <h4 class="text-center">
        <img src="IMG/LOGO.png" alt="Logo" class="img-fluid">
      </h4>
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
                  <a class="nav-link text-dark" href="pendientes.php">
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

    <div class="content">
      <div class="top-bar">
        <div class="input-group w-50">
          <span class="input-group-text" id="basic-addon1">
            <i class="fa fa-search"></i>
          </span>
          <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar"
            aria-describedby="basic-addon1">
        </div>
        <button class="btn btn-secondary">
          <i class="fa-solid fa-filter"></i> Filtrar
        </button>
      </div>

      <div class="table-container">
        <div class="table-wrapper">
          <table class="table table-striped table-hover" id="tablaUsuarios">
            <thead>
              <tr>
                <th>ID de plaza</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Segundo Apellido</th>
                <th>Nombre de los padres</th>
                <th>Localidad</th>
                <th>Sector</th>
                <th>Dirección Actual</th>
                <th>Escuela Anterior</th>
                <th>Fecha de nacimiento</th>
                <th>Ocupación de los padres</th>
                <th>Tipo de Familia</th>
                <th>Teléfono de contacto</th>
                <th>Correo Electrónico</th>
                <th>Acta de nacimiento</th>
                <th>Record de notas</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- El contenido se llenará dinámicamente con JavaScript -->
            </tbody>
          </table>
        </div>

        <nav>
          <ul class="pagination justify-content-end">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Siguientes</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <!-- Actualización del modal de confirmación -->
  <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmacionModalLabel">Confirmación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Contenido para Aprobar -->
          <div id="aprobarContent" style="display: none;">
            <p>¿Estás seguro que quieres aprobar esta solicitud?</p>
          </div>

          <!-- Contenido para Denegar -->
          <div id="denegarContent" style="display: none;">
            <p class="mb-3">¿Por qué deniega esta solicitud?</p>
            <select class="form-select" id="razonDenegacion" required>
              <option value="" disabled selected>Seleccione una razón</option>
              <option value="localidad">Por localidad</option>
              <option value="edad">Por edad</option>
              <option value="historial">Por historial académico</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btnConfirmarAccion">Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="Dashboards(tabla).js"></script>


  <script>
    let idSolicitud = null;
    let estadoSolicitud = "";
    let filaSeleccionada = null;

    document.addEventListener("DOMContentLoaded", function() {
      cargarDatos();
    });

    function mostrarModalConfirmacion(id, estado, fila) {
      idSolicitud = id;
      estadoSolicitud = estado;
      filaSeleccionada = fila;

      // Obtener referencias a los contenedores
      const aprobarContent = document.getElementById("aprobarContent");
      const denegarContent = document.getElementById("denegarContent");
      const btnConfirmar = document.getElementById("btnConfirmarAccion");

      // Configurar el modal según la acción
      if (estado === 'Aprobado') {
        aprobarContent.style.display = 'block';
        denegarContent.style.display = 'none';
        btnConfirmar.classList.remove('btn-danger');
        btnConfirmar.classList.add('btn-success');
      } else {
        aprobarContent.style.display = 'none';
        denegarContent.style.display = 'block';
        btnConfirmar.classList.remove('btn-success');
        btnConfirmar.classList.add('btn-danger');

        // Resetear el select
        document.getElementById('razonDenegacion').value = '';
      }

      let modal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
      modal.show();
    }

    document.getElementById("btnConfirmarAccion").addEventListener("click", function() {
      if (estadoSolicitud === 'Denegado') {
        const razonSelect = document.getElementById('razonDenegacion');
        if (!razonSelect.value) {
          // Agregar clase de error al select
          razonSelect.classList.add('is-invalid');
          // Mostrar mensaje de error
          if (!document.getElementById('errorRazon')) {
            const errorDiv = document.createElement('div');
            errorDiv.id = 'errorRazon';
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = 'Por favor, seleccione una razón para denegar';
            razonSelect.parentNode.appendChild(errorDiv);
          }
          return;
        }
      }

      actualizarEstado(idSolicitud, estadoSolicitud, filaSeleccionada);
      let modal = bootstrap.Modal.getInstance(document.getElementById('confirmacionModal'));
      modal.hide();
    });

    // Eliminar la clase de error cuando se selecciona una opción
    document.getElementById('razonDenegacion')?.addEventListener('change', function() {
      this.classList.remove('is-invalid');
      const errorDiv = document.getElementById('errorRazon');
      if (errorDiv) {
        errorDiv.remove();
      }
    });

    function actualizarEstado(id, nuevoEstado, fila) {
      const formData = new FormData();
      formData.append('id', id);
      formData.append('estado', nuevoEstado);

      // Agregar razón de denegación si aplica
      if (nuevoEstado === 'Denegado') {
        formData.append('razon', document.getElementById('razonDenegacion').value);
      }

      fetch('filtros.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const estadoCell = fila.querySelector('.estado');
            const botonesCell = fila.querySelector('td:last-child');

            estadoCell.className = `estado estado-${nuevoEstado.toLowerCase()}`;
            estadoCell.textContent = nuevoEstado;

            // Remover los botones después de la acción
            botonesCell.innerHTML = '';

            // Mostrar notificación de éxito
            mostrarNotificacion(`Solicitud ${nuevoEstado.toLowerCase()} exitosamente`, 'success');
          } else {
            mostrarNotificacion('Error al actualizar el estado: ' + (data.message || 'Error desconocido'), 'danger');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          mostrarNotificacion('Error al actualizar el estado', 'danger');
        });
    }

    // Función para mostrar notificaciones
    function mostrarNotificacion(mensaje, tipo) {
      const notification = document.createElement('div');
      notification.className = `alert alert-${tipo} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
      notification.style.zIndex = '1050';
      notification.innerHTML = `
    ${mensaje}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  `;

      document.body.appendChild(notification);

      // Remover la notificación después de 3 segundos

    }

    function cargarDatos() {
      fetch("dash1.php")
        .then(response => response.json())
        .then(data => {
          let tabla = document.getElementById("tablaUsuarios").getElementsByTagName("tbody")[0];
          tabla.innerHTML = '';

          if (!Array.isArray(data) || data.length === 0) {
            tabla.innerHTML = '<tr><td colspan="18" class="text-center">No hay solicitudes disponibles</td></tr>';
            return;
          }

          data.forEach(usuario => {
            let fila = tabla.insertRow();
            fila.innerHTML = `
             <td>${usuario.id}</td>
            <td>${usuario.nombre}</td>
            <td>${usuario.apellido}</td>
            <td>${usuario.segundo_apellido || ''}</td>
            <td>${usuario.nombre_padres ? usuario.nombre_padres : 'No registrado'}</td>
            <td>${usuario.localidad || ''}</td>
            <td>${usuario.sector || ''}</td>
            <td>${usuario.direccion || ''}</td>
            <td>${usuario.escuela_anterior || ''}</td>
            <td>${usuario.fecha_nacimiento || ''}</td>
            <td>${usuario.ocupacion_padres ? usuario.ocupacion_padres : 'No registrado'}</td>
            <td>${usuario.tipo_familia ? usuario.tipo_familia : 'No registrado'}</td>
            <td>${usuario.telefono ? usuario.telefono : 'No registrado'}</td>
            <td>${usuario.correo ? usuario.correo : 'No registrado'}</td>
            <td>
    ${usuario.acta_nacimiento_pdf ?
    `<a href="ver_pdf.php?tipo=acta&id=${usuario.id}" class="btn btn-sm btn-danger" target="_blank" 
        onclick="return confirm('¿Desea abrir el PDF?')">
        <i class="fas fa-file-pdf"></i> Ver Acta
    </a>`
    : 'No disponible'}
</td>
        <td>
    ${usuario.record_calificaciones ?
    `<a href="ver_pdf.php?tipo=record&id=${usuario.id}" class="btn btn-sm btn-primary" target="_blank" 
        onclick="return confirm('¿Desea abrir el PDF?')">
        <i class="fas fa-file-pdf"></i> Ver Record
    </a>`
    : 'No disponible'}
</td>
           
          

        <td class="estado ${usuario.estado ? 'estado-' + usuario.estado.toLowerCase() : 'estado-pendiente'}">
            ${usuario.estado || 'Pendiente'}
        </td>
        <td class="align-middle">
    <div class="d-flex flex-column gap-2">
        <button class="btn btn-success btn-sm btn-aprobar" data-id="${usuario.id_acta_nacimiento}">Aprobar</button>
        <button class="btn btn-danger btn-sm btn-denegar" data-id="${usuario.id_acta_nacimiento}">Denegar</button>
    </div>
</td>
    `;
          });

          document.querySelectorAll('.btn-aprobar').forEach(btn => {
            btn.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              mostrarModalConfirmacion(id, 'Aprobado', this.closest('tr'));
            });
          });

          document.querySelectorAll('.btn-denegar').forEach(btn => {
            btn.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              mostrarModalConfirmacion(id, 'Denegado', this.closest('tr'));
            });
          });
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
          let tabla = document.getElementById("tablaUsuarios").getElementsByTagName("tbody")[0];
          tabla.innerHTML = '<tr><td colspan="18" class="text-center">Error al cargar los datos</td></tr>';
        });
    }

    function actualizarEstado(id, nuevoEstado, fila) {
      const formData = new FormData();
      formData.append('id', id);
      formData.append('estado', nuevoEstado);

      fetch('filtros.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const estadoCell = fila.querySelector('.estado');
            const botonesCell = fila.querySelector('td:last-child');

            estadoCell.className = `estado estado-${nuevoEstado.toLowerCase()}`;
            estadoCell.textContent = nuevoEstado;

            botonesCell.innerHTML = '';
          } else {
            alert('Error al actualizar el estado: ' + (data.message || 'Error desconocido'));
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('Error al actualizar el estado');
        });
    }
  </script>
</body>

</html>