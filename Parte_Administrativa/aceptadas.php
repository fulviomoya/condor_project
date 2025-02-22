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
          <table class="table table-striped table-hover" id="tablaUsuarios1">
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







  <script>
    // Actualización del script.js
    document.addEventListener("DOMContentLoaded", function() {
      cargarDatos();
    });

    function cargarDatos() {
      fetch("si.php")
        .then(response => response.json())
        .then(data => {
          let tabla = document.getElementById("tablaUsuarios1").getElementsByTagName("tbody")[0];
          tabla.innerHTML = '';

          if (!Array.isArray(data) || data.length === 0) {
            tabla.innerHTML = '<tr><td colspan="8" class="text-center">No hay solicitudes disponibles</td></tr>';
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
                    <td class="align-middle text-success fw-bold estado ${usuario.estado ? 'estado-' + usuario.estado.toLowerCase() : 'estado-pendiente'}">${usuario.estado || 'Pendiente'}</td>

                `;
          });

          // Agregar event listeners a los botones después de crear las filas
          document.querySelectorAll('.btn-aprobar').forEach(btn => {
            btn.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              actualizarEstado(id, 'Aprobado', this.closest('tr'));
            });
          });

          document.querySelectorAll('.btn-denegar').forEach(btn => {
            btn.addEventListener('click', function() {
              const id = this.getAttribute('data-id');
              actualizarEstado(id, 'Denegado', this.closest('tr'));
            });
          });
        })
        .catch(error => {
          console.error("Error al cargar los datos:", error);
          let tabla = document.getElementById("tablaUsuarios1").getElementsByTagName("tbody")[0];
          tabla.innerHTML = '<tr><td colspan="8" class="text-center">Error al cargar los datos</td></tr>';
        });
    }

    
    // Función para buscar en la tabla
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('.input-group input[type="text"]');
  const table = document.getElementById('tablaUsuarios1'); // Cambiado a tablaUsuarios1
  const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

  function filterTable(searchTerm) {
    searchTerm = searchTerm.toLowerCase().trim();

    Array.from(rows).forEach(row => {
      const cells = Array.from(row.getElementsByTagName('td'));
      
      // Si no hay término de búsqueda, mostrar todas las filas
      if (searchTerm === '') {
        row.style.display = '';
        cells.forEach(cell => {
          cell.innerHTML = cell.textContent;
        });
        return;
      }

      const found = cells.some(cell => {
        const text = cell.textContent.toLowerCase();
        return text.includes(searchTerm);
      });

      if (found) {
        row.style.display = '';
        cells.forEach(cell => {
          const text = cell.textContent;
          // Solo resaltar el texto exacto que se busca
          if (text.toLowerCase().includes(searchTerm)) {
            const regex = new RegExp(`(${searchTerm})`, 'gi');
            const highlightedText = text.replace(regex, '<span class="highlight">$1</span>');
            cell.innerHTML = highlightedText;
          } else {
            cell.innerHTML = text;
          }
        });
      } else {
        row.style.display = 'none';
      }
    });
  }

  // Botón para limpiar la búsqueda
  const searchContainer = searchInput.parentElement;
  const clearButton = document.createElement('button');
  clearButton.className = 'btn btn-outline-secondary';
  clearButton.innerHTML = '<i class="fa fa-times"></i>';
  clearButton.style.display = 'none';
  searchContainer.appendChild(clearButton);

  clearButton.addEventListener('click', () => {
    searchInput.value = '';
    filterTable('');
    clearButton.style.display = 'none';
  });

  searchInput.addEventListener('input', (e) => {
    filterTable(e.target.value);
    clearButton.style.display = e.target.value ? '' : 'none';
  });
});

// Función para agregar el botón de Excel y exportar
document.addEventListener('DOMContentLoaded', function() {
  function downloadExcel() {
    const table = document.getElementById('tablaUsuarios1');
    const rows = Array.from(table.querySelectorAll('tr'));
    
    const headerMapping = {
        'ID de plaza': 'ID de plaza',
        'Nombre': 'Nombre del Estudiante',
        'Apellido': 'Primer Apellido',
        'Segundo Apellido': 'Segundo Apellido',
        'Nombre de los padres': 'Nombre de los Tutores',
        'Localidad': 'Localidad de Residencia',
        'Sector': 'Sector',
        'Dirección Actual': 'Domicilio Actual',
        'Escuela Anterior': 'Centro Educativo Anterior',
        'Fecha de nacimiento': 'Fecha de Nacimiento',
        'Ocupación de los padres': 'Ocupación de los Tutores',
        'Tipo de Familia': 'Tipo de familia',
        'Teléfono de contacto': 'Teléfono para Contacto',
        'Correo Electrónico': 'Correo Electrónico de Contacto',
        'Acta de nacimiento': 'Acta de nacimiento',
        'Estado': 'Estado de la Solicitud'
    };

    const originalHeaders = Array.from(rows[0].querySelectorAll('th'))
        .map(th => th.textContent.trim());

    const newHeaders = originalHeaders.map(header => 
        headerMapping[header] || header
    );

    const workbookData = [newHeaders];

    rows.slice(1).forEach(row => {
        const rowData = Array.from(row.querySelectorAll('td'))
            .map((cell, index) => {
                let value = cell.textContent.trim();
                
                if (index === 9 && value) {
                    const date = new Date(value);
                    if (!isNaN(date)) {
                        value = date.toLocaleDateString('es-ES');
                    }
                }
                
                if (index === 14) {
                    const pdfLink = cell.querySelector('a');
                    value = pdfLink ? 'Disponible' : 'No disponible';
                }

                if (index === 16) {
                    return value || 'Pendiente';
                }

                return value || '';
            });
        workbookData.push(rowData);
    });

    const ws = XLSX.utils.aoa_to_sheet(workbookData);

    const columnWidths = newHeaders.map(header => ({
        wch: Math.max(header.length, 15)
    }));
    ws['!cols'] = columnWidths;

    for (let i = 0; i < workbookData.length; i++) {
        for (let j = 0; j < workbookData[i].length; j++) {
            const cellRef = XLSX.utils.encode_cell({ r: i, c: j });
            
            if (i === 0) {
                ws[cellRef].s = {
                    font: { bold: true, color: { rgb: "FFFFFF" } },
                    fill: { fgColor: { rgb: "4472C4" } },
                    alignment: { horizontal: "center", vertical: "center" }
                };
            }
            
            if (j === 16 && i > 0) {
                const estado = workbookData[i][j].toLowerCase();
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

    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Solicitudes");

    const timestamp = new Date().toISOString().replace(/[-:.]/g, "");
    const fileName = `Reporte_Admisiones_${timestamp}.xlsx`;
    XLSX.writeFile(wb, fileName);
  }

  // Agregar el botón de Excel
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

  // Hacer la función downloadExcel disponible globalmente
  window.downloadExcel = downloadExcel;
});
  </script>
</body>

</html>