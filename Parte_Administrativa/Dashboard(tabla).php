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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
          <table class="table table-striped table-hover" id="tablaTodosUsuarios">
            <thead>
              <tr>
                <th>ID de plaza</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Segundo Apellido</th>
                <th>Nombre de los padres</th>
                <th>Localidad</th>
                <th>Sector</th>
                <th>Nacionalidad</th>
                <th>grado_solicitado</th>
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
                <th>Motivo de Negación</th>
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

  <!-- Modal de confirmación actualizado -->
  <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel"
    aria-hidden="true">
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

          <!-- Contenido actualizado para Denegar -->
          <div id="denegarContent" style="display: none;">
            <p class="mb-3">¿Por qué deniega esta solicitud?</p>
            <select class="form-select" id="razonDenegacion" required>
              <option value="" disabled selected>Seleccione una razón</option>
              <option value="localidad">Por la Localidad</option>
              <option value="edad">Por la Edad</option>
              <option value="historial_academico">Por el Historial Academico</option>
              <option value="otro">Otra Razon</option>
            </select>
            <div id="otroMotivoContainer" style="display: none;" class="mt-3">
              <textarea id="otroMotivo" class="form-control" placeholder="Especifique el motivo" rows="3"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btnConfirmarAccion">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>

  <script src="Dashboards(tabla).js"></script>


  <script>
    // Variables globales actualizadas
    let idSolicitud = null;
    let estadoSolicitud = "";
    let filaSeleccionada = null;

    document.addEventListener("DOMContentLoaded", function () {
      cargarTodosLosDatos();

      // Event listener para el cambio de razón
      document.getElementById('razonDenegacion').addEventListener('change', function () {
        const otroMotivoContainer = document.getElementById('otroMotivoContainer');
        if (this.value === 'otro') {
          otroMotivoContainer.style.display = 'block';
        } else {
          otroMotivoContainer.style.display = 'none';
        }
        this.classList.remove('is-invalid');
        const errorDiv = document.getElementById('errorRazon');
        if (errorDiv) errorDiv.remove();
      });
    });

    function mostrarModalConfirmacion(id, estado, fila) {
      idSolicitud = id;
      estadoSolicitud = estado;
      filaSeleccionada = fila;

      const aprobarContent = document.getElementById("aprobarContent");
      const denegarContent = document.getElementById("denegarContent");
      const btnConfirmar = document.getElementById("btnConfirmarAccion");
      const otroMotivoContainer = document.getElementById("otroMotivoContainer");

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
        document.getElementById('razonDenegacion').value = '';
        otroMotivoContainer.style.display = 'none';
        document.getElementById('otroMotivo').value = '';
      }

      let modal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
      modal.show();
    }

    document.getElementById("btnConfirmarAccion").addEventListener("click", function () {
      if (estadoSolicitud === 'Denegado') {
        const razonSelect = document.getElementById('razonDenegacion');
        const otroMotivo = document.getElementById('otroMotivo');

        if (!razonSelect.value) {
          razonSelect.classList.add('is-invalid');
          if (!document.getElementById('errorRazon')) {
            const errorDiv = document.createElement('div');
            errorDiv.id = 'errorRazon';
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = 'Por favor, seleccione una razón para denegar';
            razonSelect.parentNode.appendChild(errorDiv);
          }
          return;
        }

        if (razonSelect.value === 'otro' && !otroMotivo.value.trim()) {
          otroMotivo.classList.add('is-invalid');
          if (!document.getElementById('errorOtroMotivo')) {
            const errorDiv = document.createElement('div');
            errorDiv.id = 'errorOtroMotivo';
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = 'Por favor, especifique el motivo';
            otroMotivo.parentNode.appendChild(errorDiv);
          }
          return;
        }
      }

      actualizarEstado(idSolicitud, estadoSolicitud, filaSeleccionada);
      let modal = bootstrap.Modal.getInstance(document.getElementById('confirmacionModal'));
      modal.hide();
    });

    function actualizarEstado(id, nuevoEstado, fila) {
  const formData = new FormData();
  formData.append('id', id);
  formData.append('estado', nuevoEstado);

  // Agregar razón si es denegado
  if (nuevoEstado === 'Denegado') {
    const razonSelect = document.getElementById('razonDenegacion');
    const otroMotivo = document.getElementById('otroMotivo');
    let razonFinal = razonSelect.value === 'otro' ?
      otroMotivo.value.trim() :
      razonSelect.options[razonSelect.selectedIndex].text;
    formData.append('razon', razonFinal);
  }

  // Debug
  console.log('Enviando datos:', {
    id: id,
    estado: nuevoEstado,
    razon: formData.get('razon')
  });

  fetch('filtros.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Cerrar el modal correctamente
        const modalElement = document.getElementById('confirmacionModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
          modal.hide();
          modalElement.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
              backdrop.remove();
            }
          }, {
            once: true
          });
        }

        // Recargar datos y mostrar notificación
        cargarTodosLosDatos();
        mostrarNotificacion(`Solicitud ${nuevoEstado.toLowerCase()} exitosamente`, 'success');
      } else {
        mostrarNotificacion('Error: ' + (data.message || 'Error desconocido'), 'danger');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      mostrarNotificacion('Error al procesar la solicitud', 'danger');
    });
}

    function mostrarNotificacion(mensaje, tipo) {
      const notification = document.createElement('div');
      notification.className = `alert alert-${tipo} alert-dismissible fade show position-fixed top-0 end-0 m-3`;
      notification.style.zIndex = '1050';
      notification.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      `;

      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 3000);
    }

    function actualizarEstado(id, nuevoEstado, fila) {
      const formData = new FormData();
      formData.append('id', id);
      formData.append('estado', nuevoEstado);

      // Agregar razón si es denegado
      if (nuevoEstado === 'Denegado') {
        const razonSelect = document.getElementById('razonDenegacion');
        const otroMotivo = document.getElementById('otroMotivo');
        let razonFinal = razonSelect.value === 'otro' ?
          otroMotivo.value.trim() :
          razonSelect.options[razonSelect.selectedIndex].text;
        formData.append('razon', razonFinal);
      }

      // Debug
      console.log('Enviando datos:', {
        id: id,
        estado: nuevoEstado,
        razon: formData.get('razon')
      });

      fetch('filtros.php', {
        method: 'POST',
        body: formData
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Cerrar el modal correctamente
            const modalElement = document.getElementById('confirmacionModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            if (modal) {
              modal.hide();
              modalElement.addEventListener('hidden.bs.modal', function () {
                document.body.classList.remove('modal-open');
                document.querySelector('.modal-backdrop').remove();
              }, {
                once: true
              });
            }

            // Recargar datos y mostrar notificación
            cargarTodosLosDatos();
            mostrarNotificacion(`Solicitud ${nuevoEstado.toLowerCase()} exitosamente`, 'success');
          } else {
            mostrarNotificacion('Error: ' + (data.message || 'Error desconocido'), 'danger');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          mostrarNotificacion('Error al procesar la solicitud', 'danger');
        });
    }


    function downloadExcel() {
  // Mostrar un indicador de carga
  mostrarNotificacion('Preparando la exportación de datos...', 'info');
  
  // Obtener todos los datos del servidor
  fetch("todas.php")
    .then(response => response.json())
    .then(data => {
      if (!Array.isArray(data) || data.length === 0) {
        mostrarNotificacion('No hay datos para exportar', 'warning');
        return;
      }
      
      // Definir mapeo de encabezados para Excel
      const headerMapping = {
        'ID de plaza': 'ID de plaza',
        'Nombre': 'Nombre del Estudiante',
        'Apellido': 'Primer Apellido',
        'Segundo Apellido': 'Segundo Apellido',
        'Nombre de los padres': 'Nombre de los Tutores',
        'Localidad': 'Localidad de Residencia',
        'Sector': 'Sector',
        'nacionalidad': 'Nacionalidad',
        'grado_solicitado'  : 'Grado Solicitado',
        'Dirección Actual': 'Domicilio Actual',
        'Escuela Anterior': 'Centro Educativo Anterior',
        'Fecha de nacimiento': 'Fecha de Nacimiento',
        'Ocupación de los padres': 'Ocupación de los Tutores',
        'Tipo de Familia': 'Tipo de familia',
        'Teléfono de contacto': 'Teléfono para Contacto',
        'Correo Electrónico': 'Correo Electrónico de Contacto',
        'Acta de nacimiento': 'Acta de nacimiento',
        'Record de notas': 'Record de Calificaciones',
        'Estado': 'Estado de la Solicitud',
        'Motivo': 'Motivo de Denegación'
      };
      
      // Obtener los encabezados de la tabla
      const table = document.getElementById('tablaTodosUsuarios');
      const originalHeaders = Array.from(table.querySelectorAll('thead th'))
        .slice(0, -1) // Excluir la columna de Acciones
        .map(th => th.textContent.trim());
      
      // Transformar los encabezados usando el mapeo
      const newHeaders = originalHeaders.map(header =>
        headerMapping[header] || header
      );
      
      // Preparar los datos para Excel
      const workbookData = [newHeaders];
      
      // Procesar todos los datos recuperados del servidor
      data.forEach(usuario => {
        const rowData = [];
        
        // Agregar cada valor en el orden correcto
        rowData.push(usuario.id_plaza || '');
        rowData.push(usuario.nombre || '');
        rowData.push(usuario.apellido || '');
        rowData.push(usuario.segundo_apellido || '');
        rowData.push(usuario.nombre_padres || 'No registrado');
        rowData.push(usuario.localidad || '');
        rowData.push(usuario.sector || '');
        rowData.push(usuario.nacionalidad || '');
        rowData.push(usuario.grado_solicitado || '');
        rowData.push(usuario.direccion || '');
        rowData.push(usuario.escuela_anterior || '');
        
        // Formatear fecha si existe
        let fechaNacimiento = usuario.fecha_nacimiento || '';
        if (fechaNacimiento) {
          const date = new Date(fechaNacimiento);
          if (!isNaN(date)) {
            fechaNacimiento = date.toLocaleDateString('es-ES');
          }
        }
        rowData.push(fechaNacimiento);
        
        rowData.push(usuario.ocupacion_padres || 'No registrado');
        rowData.push(usuario.tipo_familia || 'No registrado');
        rowData.push(usuario.telefono || 'No registrado');
        rowData.push(usuario.correo || 'No registrado');
        rowData.push(usuario.acta_nacimiento_pdf ? 'Disponible' : 'No disponible');
        rowData.push(usuario.record_calificaciones ? 'Disponible' : 'No disponible');
        rowData.push(usuario.estado || 'Pendiente');
        rowData.push(usuario.motivo_denegacion || '');
        
        workbookData.push(rowData);
      });
      
      // Crear hoja de trabajo
      const ws = XLSX.utils.aoa_to_sheet(workbookData);
      
      // Establecer anchos de columna
      const columnWidths = newHeaders.map(header => ({
        wch: Math.max(header.length, 15)
      }));
      ws['!cols'] = columnWidths;
      
      // Dar formato a las celdas
      for (let i = 0; i < workbookData.length; i++) {
        for (let j = 0; j < workbookData[i].length; j++) {
          const cellRef = XLSX.utils.encode_cell({ r: i, c: j });
          
          // Crear el objeto de celda si no existe
          if (!ws[cellRef]) {
            ws[cellRef] = { v: workbookData[i][j] };
          }
          
          // Formato para encabezados
          if (i === 0) {
            ws[cellRef].s = {
              font: { bold: true, color: { rgb: "FFFFFF" } },
              fill: { fgColor: { rgb: "4472C4" } },
              alignment: { horizontal: "center", vertical: "center" }
            };
          }
          
          // Formato para estado
          if (j === 16 && i > 0) { // Columna de Estado
            const estado = (workbookData[i][j] || '').toLowerCase();
            let fillColor = "FFFFFF";
            
            if (estado === 'aprobado') fillColor = "C6EFCE";
            else if (estado === 'denegado') fillColor = "FFC7CE";
            else if (estado === 'pendiente') fillColor = "FFEB9C";
            
            ws[cellRef].s = {
              fill: { fgColor: { rgb: fillColor } }
            };
          }
        }
      }
      
      // Crear libro y agregar la hoja
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Solicitudes");
      
      // Generar el archivo
      const timestamp = new Date().toISOString().replace(/[-:.]/g, "");
      const fileName = `Reporte_Admisiones_Completo_${timestamp}.xlsx`;
      
      XLSX.writeFile(wb, fileName);
      mostrarNotificacion('Exportación completada con éxito', 'success');
    })
    .catch(error => {
      console.error('Error al exportar datos:', error);
      mostrarNotificacion('Error al exportar datos', 'danger');
    });
}
    // Código para agregar el botón de Excel
    document.addEventListener('DOMContentLoaded', function () {
      // Buscar el elemento "Reporte de datos" de manera más precisa
      const reporteLink = document.querySelector('a.nav-link i.fa-solid.fa-clipboard').closest('.nav-item');

      // Crear el nuevo elemento para el botón de Excel
      const excelButton = document.createElement('li');
      excelButton.className = 'nav-item';
      excelButton.innerHTML = `
        <a class="nav-link text-dark" href="#" onclick="downloadExcel(); return false;">
            <i class="fas fa-file-excel" style="color: #217346;"></i> Exportar Excel
        </a>
    `;

      // Insertar el botón después del elemento "Reporte de datos"
      if (reporteLink) {
        reporteLink.parentNode.insertBefore(excelButton, reporteLink.nextSibling);
      }
    });



    // Variables globales
let datosCompletos = []; // Para almacenar todos los datos recuperados del servidor
let datosFiltrados = []; // Para almacenar resultados de búsqueda
let paginaActual = 1;
let registrosPorPagina = 50;

document.addEventListener("DOMContentLoaded", function () {
  cargarDatosCompletos();
  
  // Configurar el evento de búsqueda
  const searchInput = document.querySelector('.form-control[placeholder="Buscar"]');
  searchInput.addEventListener('input', function() {
    paginaActual = 1; // Resetear a la primera página al buscar
    buscarRegistros(this.value);
  });
  
  // Event listener para el cambio de razón
  document.getElementById('razonDenegacion').addEventListener('change', function () {
    const otroMotivoContainer = document.getElementById('otroMotivoContainer');
    if (this.value === 'otro') {
      otroMotivoContainer.style.display = 'block';
    } else {
      otroMotivoContainer.style.display = 'none';
    }
    this.classList.remove('is-invalid');
    const errorDiv = document.getElementById('errorRazon');
    if (errorDiv) errorDiv.remove();
  });
});

// Función para cargar todos los datos
function cargarDatosCompletos() {
  mostrarNotificacion('Cargando datos...', 'info');
  
  fetch("todas.php")
    .then(response => {
      if (!response.ok) {
        throw new Error('Error en la respuesta del servidor: ' + response.status);
      }
      return response.json();
    })
    .then(data => {
      datosCompletos = data;
      datosFiltrados = [...data]; // Inicialmente, los datos filtrados son todos los datos
      mostrarDatosPaginados(paginaActual);
    })
    .catch(error => {
      console.error("Error al cargar los datos completos:", error);
      mostrarNotificacion('Error al cargar los datos: ' + error.message, 'danger');
    });
}

// Función para buscar registros
function buscarRegistros(termino) {
  if (!termino.trim()) {
    // Si el término de búsqueda está vacío, mostrar todos los datos
    datosFiltrados = [...datosCompletos];
  } else {
    // Convertir el término a minúsculas para búsqueda sin distinción de mayúsculas
    termino = termino.toLowerCase();
    
    // Filtrar los datos según el término de búsqueda
    datosFiltrados = datosCompletos.filter(usuario => {
      // Buscar en todos los campos relevantes
      return Object.keys(usuario).some(key => {
        // Verificar que el valor existe y es una cadena o número antes de buscar
        const valor = usuario[key];
        if (valor !== null && valor !== undefined) {
          return String(valor).toLowerCase().includes(termino);
        }
        return false;
      });
    });
  }
  
  // Actualizar la paginación con los resultados filtrados
  mostrarDatosPaginados(1); // Siempre volver a la primera página después de una búsqueda
}

// Función para mostrar datos paginados
function mostrarDatosPaginados(pagina) {
  paginaActual = pagina; // Actualizar la variable global
  
  const totalPaginas = Math.ceil(datosFiltrados.length / registrosPorPagina);
  // Asegurar que la página actual es válida
  if (paginaActual < 1) paginaActual = 1;
  if (paginaActual > totalPaginas && totalPaginas > 0) paginaActual = totalPaginas;
  
  const inicio = (paginaActual - 1) * registrosPorPagina;
  const fin = Math.min(inicio + registrosPorPagina, datosFiltrados.length);
  const datosPagina = datosFiltrados.slice(inicio, fin);
  
  actualizarTabla(datosPagina);
  actualizarPaginacion(totalPaginas, paginaActual);
}

// Función para actualizar la tabla con los datos proporcionados
function actualizarTabla(datos) {
  let tabla = document.getElementById("tablaTodosUsuarios").getElementsByTagName("tbody")[0];
  tabla.innerHTML = '';

  if (!Array.isArray(datos) || datos.length === 0) {
    tabla.innerHTML = '<tr><td colspan="19" class="text-center">No hay solicitudes que coincidan con la búsqueda</td></tr>';
    return;
  }

  datos.forEach(usuario => {
    const estadoUsuario = usuario.estado || 'Pendiente';
    const esPendiente = estadoUsuario === 'Pendiente';
    
    let fila = tabla.insertRow();
    fila.innerHTML = `
      <td class="align-middle">${usuario.id_plaza || ''}</td>
      <td class="align-middle">${usuario.nombre || ''}</td>
      <td class="align-middle">${usuario.apellido || ''}</td>
      <td class="align-middle">${usuario.segundo_apellido || ''}</td>
      <td class="align-middle">${usuario.nombre_padres ? usuario.nombre_padres : 'No registrado'}</td>
      <td class="align-middle">${usuario.localidad || ''}</td>
      <td class="align-middle">${usuario.sector || ''}</td>
      <td class="align-middle">${usuario.nacionalidad || ''}</td>
      <td class="align-middle">${usuario.grado_solicitado || ''}</td>
      <td class="align-middle">${usuario.direccion || ''}</td>
      <td class="align-middle">${usuario.escuela_anterior || ''}</td>
      <td class="align-middle">${usuario.fecha_nacimiento || ''}</td>
      <td class="align-middle">${usuario.ocupacion_padres ? usuario.ocupacion_padres : 'No registrado'}</td>
      <td class="align-middle">${usuario.tipo_familia ? usuario.tipo_familia : 'No registrado'}</td>
      <td class="align-middle">${usuario.telefono ? usuario.telefono : 'No registrado'}</td>
      <td class="align-middle">${usuario.correo ? usuario.correo : 'No registrado'}</td>
      <td class="align-middle">
        ${usuario.acta_nacimiento_pdf ?
          `<a href="ver_pdf.php?tipo=acta&id=${usuario.id_plaza}" class="btn btn-sm btn-danger" target="_blank" 
            onclick="return confirm('¿Desea abrir el PDF?')">
            <i class="fas fa-file-pdf"></i> Ver Acta
          </a>`
          : 'No disponible'}
      </td>
      <td class="align-middle">
        ${usuario.record_calificaciones ?
          `<a href="ver_pdf.php?tipo=record&id=${usuario.id_plaza}" class="btn btn-sm btn-primary" target="_blank" 
            onclick="return confirm('¿Desea abrir el PDF?')">
            <i class="fas fa-file-pdf"></i> Ver Record
          </a>`
          : 'No disponible'}
      </td>
      <td class="align-middle fw-bold estado ${estadoUsuario ? 'estado-' + estadoUsuario.toLowerCase() : 'estado-pendiente'}">
        ${estadoUsuario}
      </td>
      <td class="align-middle">
        ${usuario.motivo_denegacion ? usuario.motivo_denegacion : ''}
      </td>
      
    `;
  });
}

// Función para actualizar la paginación
function actualizarPaginacion(totalPaginas, paginaActual) {
  const paginacion = document.querySelector('.pagination');
  paginacion.innerHTML = '';
  
  // No mostrar paginación si no hay páginas
  if (totalPaginas === 0) return;
  
  // Botón anterior
  const prevLi = document.createElement('li');
  prevLi.className = `page-item ${paginaActual === 1 ? 'disabled' : ''}`;
  const prevA = document.createElement('a');
  prevA.className = 'page-link';
  prevA.href = '#';
  prevA.innerHTML = '&laquo; Anterior';
  prevA.addEventListener('click', function(e) {
    e.preventDefault();
    if (paginaActual > 1) {
      mostrarDatosPaginados(paginaActual - 1);
    }
  });
  prevLi.appendChild(prevA);
  paginacion.appendChild(prevLi);
  
  // Determinar rango de páginas a mostrar
  let startPage = Math.max(1, paginaActual - 2);
  let endPage = Math.min(totalPaginas, startPage + 4);
  
  if (endPage - startPage < 4 && totalPaginas > 4) {
    startPage = Math.max(1, endPage - 4);
  }
  
  // Páginas numéricas
  for (let i = startPage; i <= endPage; i++) {
    const li = document.createElement('li');
    li.className = `page-item ${i === paginaActual ? 'active' : ''}`;
    const a = document.createElement('a');
    a.className = 'page-link';
    a.href = '#';
    a.textContent = i;
    a.addEventListener('click', function(e) {
      e.preventDefault();
      mostrarDatosPaginados(i);
    });
    li.appendChild(a);
    paginacion.appendChild(li);
  }
  
  // Botón siguiente
  const nextLi = document.createElement('li');
  nextLi.className = `page-item ${paginaActual === totalPaginas ? 'disabled' : ''}`;
  const nextA = document.createElement('a');
  nextA.className = 'page-link';
  nextA.href = '#';
  nextA.innerHTML = 'Siguiente &raquo;';
  nextA.addEventListener('click', function(e) {
    e.preventDefault();
    if (paginaActual < totalPaginas) {
      mostrarDatosPaginados(paginaActual + 1);
    }
  });
  nextLi.appendChild(nextA);
  paginacion.appendChild(nextLi);
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

  setTimeout(() => {
    notification.remove();
  }, 3000);
}

// Función actualizada para procesar actualizaciones de estado
function actualizarEstado(id, nuevoEstado, fila) {
  const formData = new FormData();
  formData.append('id', id);
  formData.append('estado', nuevoEstado);

  // Agregar razón si es denegado
  if (nuevoEstado === 'Denegado') {
    const razonSelect = document.getElementById('razonDenegacion');
    const otroMotivo = document.getElementById('otroMotivo');
    
    if (!razonSelect.value) {
      mostrarNotificacion('Por favor seleccione una razón para denegar', 'warning');
      return;
    }
    
    let razonFinal = razonSelect.value === 'otro' ?
      otroMotivo.value.trim() :
      razonSelect.options[razonSelect.selectedIndex].text;
      
    if (razonSelect.value === 'otro' && !razonFinal) {
      mostrarNotificacion('Por favor especifique el motivo', 'warning');
      return;
    }
    
    formData.append('razon', razonFinal);
  }

  fetch('filtros.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Cerrar el modal correctamente
        const modalElement = document.getElementById('confirmacionModal');
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
          modal.hide();
          modalElement.addEventListener('hidden.bs.modal', function () {
            document.body.classList.remove('modal-open');
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) backdrop.remove();
          }, { once: true });
        }

        // Recargar datos completos para mantener sincronizado
        cargarDatosCompletos();
        mostrarNotificacion(`Solicitud ${nuevoEstado.toLowerCase()} exitosamente`, 'success');
      } else {
        mostrarNotificacion('Error: ' + (data.message || 'Error desconocido'), 'danger');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      mostrarNotificacion('Error al procesar la solicitud', 'danger');
    });
}

// Función para exportar a Excel
function downloadExcel() {
  // Mostrar un indicador de carga
  mostrarNotificacion('Preparando la exportación de datos...', 'info');
  
  // Obtener todos los datos del servidor
  fetch("todas.php")
    .then(response => response.json())
    .then(data => {
      if (!Array.isArray(data) || data.length === 0) {
        mostrarNotificacion('No hay datos para exportar', 'warning');
        return;
      }
      
      // Definir mapeo de encabezados para Excel
      const headerMapping = {
        'ID de plaza': 'ID de plaza',
        'Nombre': 'Nombre del Estudiante',
        'Apellido': 'Primer Apellido',
        'Segundo Apellido': 'Segundo Apellido',
        'Nombre de los padres': 'Nombre de los Tutores',
        'Localidad': 'Localidad de Residencia',
        'Sector': 'Sector',
        'nacionalidad': 'Nacionalidad',
        'grado_solicitado'  : 'Grado Solicitado',
        'Dirección Actual': 'Domicilio Actual',
        'Escuela Anterior': 'Centro Educativo Anterior',
        'Fecha de nacimiento': 'Fecha de Nacimiento',
        'Ocupación de los padres': 'Ocupación de los Tutores',
        'Tipo de Familia': 'Tipo de familia',
        'Teléfono de contacto': 'Teléfono para Contacto',
        'Correo Electrónico': 'Correo Electrónico de Contacto',
        'Acta de nacimiento': 'Acta de nacimiento',
        'Record de notas': 'Record de Calificaciones',
        'Estado': 'Estado de la Solicitud',
        'Motivo': 'Motivo de Denegación'
      };
      
      // Obtener los encabezados de la tabla
      const table = document.getElementById('tablaTodosUsuarios');
      const originalHeaders = Array.from(table.querySelectorAll('thead th'))
        .slice(0, -1) // Excluir la columna de Acciones
        .map(th => th.textContent.trim());
      
      // Transformar los encabezados usando el mapeo
      const newHeaders = originalHeaders.map(header =>
        headerMapping[header] || header
      );
      
      // Preparar los datos para Excel
      const workbookData = [newHeaders];
      
      // Procesar todos los datos recuperados del servidor
      data.forEach(usuario => {
        const rowData = [];
        
        // Agregar cada valor en el orden correcto
        rowData.push(usuario.id_plaza || '');
        rowData.push(usuario.nombre || '');
        rowData.push(usuario.apellido || '');
        rowData.push(usuario.segundo_apellido || '');
        rowData.push(usuario.nombre_padres || 'No registrado');
        rowData.push(usuario.localidad || '');
        rowData.push(usuario.sector || '');
        rowData.push(usuario.nacionalidad || '');
        rowData.push(usuario.grado_solicitado || '');
        rowData.push(usuario.direccion || '');
        rowData.push(usuario.escuela_anterior || '');
        
        // Formatear fecha si existe
        let fechaNacimiento = usuario.fecha_nacimiento || '';
        if (fechaNacimiento) {
          const date = new Date(fechaNacimiento);
          if (!isNaN(date)) {
            fechaNacimiento = date.toLocaleDateString('es-ES');
          }
        }
        rowData.push(fechaNacimiento);
        
        rowData.push(usuario.ocupacion_padres || 'No registrado');
        rowData.push(usuario.tipo_familia || 'No registrado');
        rowData.push(usuario.telefono || 'No registrado');
        rowData.push(usuario.correo || 'No registrado');
        rowData.push(usuario.acta_nacimiento_pdf ? 'Disponible' : 'No disponible');
        rowData.push(usuario.record_calificaciones ? 'Disponible' : 'No disponible');
        rowData.push(usuario.estado || 'Pendiente');
        rowData.push(usuario.motivo_denegacion || '');
        
        workbookData.push(rowData);
      });
      
      // Crear hoja de trabajo
      const ws = XLSX.utils.aoa_to_sheet(workbookData);
      
      // Establecer anchos de columna
      const columnWidths = newHeaders.map(header => ({
        wch: Math.max(header.length, 15)
      }));
      ws['!cols'] = columnWidths;
      
      // Dar formato a las celdas
      for (let i = 0; i < workbookData.length; i++) {
        for (let j = 0; j < workbookData[i].length; j++) {
          const cellRef = XLSX.utils.encode_cell({ r: i, c: j });
          
          // Crear el objeto de celda si no existe
          if (!ws[cellRef]) {
            ws[cellRef] = { v: workbookData[i][j] };
          }
          
          // Formato para encabezados
          if (i === 0) {
            ws[cellRef].s = {
              font: { bold: true, color: { rgb: "FFFFFF" } },
              fill: { fgColor: { rgb: "4472C4" } },
              alignment: { horizontal: "center", vertical: "center" }
            };
          }
          
          // Formato para estado
          if (j === 16 && i > 0) { // Columna de Estado
            const estado = (workbookData[i][j] || '').toLowerCase();
            let fillColor = "FFFFFF";
            
            if (estado === 'aprobado') fillColor = "C6EFCE";
            else if (estado === 'denegado') fillColor = "FFC7CE";
            else if (estado === 'pendiente') fillColor = "FFEB9C";
            
            ws[cellRef].s = {
              fill: { fgColor: { rgb: fillColor } }
            };
          }
        }
      }
      
      // Crear libro y agregar la hoja
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Solicitudes");
      
      // Generar el archivo
      const timestamp = new Date().toISOString().replace(/[-:.]/g, "");
      const fileName = `Reporte_Admisiones_Completo_${timestamp}.xlsx`;
      
      XLSX.writeFile(wb, fileName);
      mostrarNotificacion('Exportación completada con éxito', 'success');
    })
    .catch(error => {
      console.error('Error al exportar datos:', error);
      mostrarNotificacion('Error al exportar datos', 'danger');
    });
}

// Alias para mantener compatibilidad con llamadas existentes
function cargarTodosLosDatos() {
  cargarDatosCompletos();
}
  </script>
</body>

</html>