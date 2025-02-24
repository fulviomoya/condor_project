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
    <div class="sidebar p-4 vh-100">
      <h4 class="text-center">
        <img src="IMG/LOGO.png" alt="Logo" class="img-fluid">
      </h4>
      <ul class="nav flex-column">
        <div class="advance">
          <li class="nav-item">
            <a class="nav-link text-dark" href="Dashboard.html">
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
        <table class="table table-striped table-hover" id="tablaUsuarios">
          <thead>
            <tr>
              <th>ID de acta</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Segundo Apellido</th>
              <th>Nombre de los padres</th>
              <th>Localidad</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>

            </tr>
          </tbody>
        </table>

        <nav>
          <ul class="pagination justify-content-end">
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <script src="Dashboards(tabla).js"></script>




  <script>
    document.addEventListener("DOMContentLoaded", function() {
      fetch("dash1.php")
        .then(response => response.json())
        .then(data => {
          let tabla = document.getElementById("tablaUsuarios").getElementsByTagName("tbody")[0];
          tabla.innerHTML = '';

          if (!Array.isArray(data) || data.length === 0) {
            tabla.innerHTML = '<tr><td colspan="8" class="text-center">No hay solicitudes pendientes</td></tr>';
            return;
          }

          data.forEach(usuario => {
            if (usuario.id_plaza) { // Verifica que el usuario tiene ID válido
              let fila = tabla.insertRow();
              fila.innerHTML = `
                        <td>${usuario.id_plaza}</td>
                        <td>${usuario.nombre}</td>
                        <td>${usuario.apellido}</td>
                        <td>${usuario.segundo_apellido || ''}</td>
                        <td>${usuario.nombre_padres || 'No registrado'}</td>
                        <td>${usuario.localidad || ''}</td>
                        <td class="estado estado-pendiente">Pendiente</td>
                        <td class="align-middle">
                            <div class="d-flex flex-column gap-2">
                                <button class="btn btn-success btn-sm btn-aprobar">Aprobar</button>
                                <button class="btn btn-danger btn-sm btn-denegar">Denegar</button>
                            </div>
                        </td>
                    `;

              // Agregar eventos a los botones de la fila
              agregarEventosBotones(fila);
            }
          });
        })
        .catch(error => console.error("Error al obtener los usuarios: ", error));
    });

    function agregarEventosBotones(fila) {
      const btnAprobar = fila.querySelector('.btn-aprobar');
      const btnDenegar = fila.querySelector('.btn-denegar');
      const estado = fila.querySelector('.estado');

      btnAprobar.addEventListener('click', function() {
        if (estado.textContent.trim() === 'Pendiente' && confirm('¿Está seguro que desea aprobar esta solicitud?')) {
          estado.textContent = 'Aprobado';
          estado.classList.remove('estado-pendiente');
          estado.classList.add('estado-aprobado');
          btnAprobar.style.display = 'none';
          btnDenegar.style.display = 'none';
        }
      });

      btnDenegar.addEventListener('click', function() {
        if (estado.textContent.trim() === 'Pendiente' && confirm('¿Está seguro que desea denegar esta solicitud?')) {
          estado.textContent = 'Denegado';
          estado.classList.remove('estado-pendiente');
          estado.classList.add('estado-denegado');
          btnAprobar.style.display = 'none';
          btnDenegar.style.display = 'none';
        }
      });
    }

    // Función para agregar el botón de Excel
    document.addEventListener('DOMContentLoaded', function() {
      // Encontrar el elemento de "Reporte de datos" en el sidebar
      const reporteLink = document.querySelector('a.nav-link i.fa-solid.fa-clipboard').parentElement;

      // Crear el botón de Excel
      const excelButton = document.createElement('li');
      excelButton.className = 'nav-item';
      excelButton.innerHTML = `
    <a class="nav-link text-dark" href="#" id="btnExportExcel">
      <i class="fas fa-file-excel" style="color: #217346;"></i> Exportar Excel
    </a>
  `;

      // Insertar el botón después del elemento "Reporte de datos"
      reporteLink.parentNode.insertBefore(excelButton, reporteLink.nextSibling);

      // Agregar el evento click al botón
      document.getElementById('btnExportExcel').addEventListener('click', function(e) {
        e.preventDefault();
        downloadExcel();
      });
    });

    // Función para exportar a Excel
    function downloadExcel() {
      const table = document.getElementById('tablaUsuarios');
      const rows = Array.from(table.querySelectorAll('tr'));

      // Filtrar los encabezados excluyendo la columna de Acciones
      const headers = Array.from(rows[0].querySelectorAll('th'))
        .map(th => th.textContent.trim())
        .filter(header => header !== 'Acciones');

      const workbookData = [headers];

      // Obtener los datos de las filas
      rows.slice(1).forEach(row => {
        const cells = Array.from(row.querySelectorAll('td'));
        // Excluir la última columna (Acciones)
        const rowData = cells.slice(0, -1).map(cell => cell.textContent.trim());
        workbookData.push(rowData);
      });

      // Crear la hoja de Excel
      const ws = XLSX.utils.aoa_to_sheet(workbookData);

      // Establecer anchos de columna
      const columnWidths = headers.map(header => ({
        wch: Math.max(header.length, 15)
      }));
      ws['!cols'] = columnWidths;

      // Aplicar estilos
      for (let i = 0; i < workbookData.length; i++) {
        for (let j = 0; j < workbookData[i].length; j++) {
          const cellRef = XLSX.utils.encode_cell({
            r: i,
            c: j
          });

          if (i === 0) {
            // Estilo para encabezados
            ws[cellRef].s = {
              font: {
                bold: true,
                color: {
                  rgb: "FFFFFF"
                }
              },
              fill: {
                fgColor: {
                  rgb: "4472C4"
                }
              },
              alignment: {
                horizontal: "center",
                vertical: "center"
              }
            };
          }

          // Estilo para la columna de Estado
          if (j === 6 && i > 0) {
            const estado = workbookData[i][j].toLowerCase();
            let fillColor = "FFFFFF";

            if (estado === 'aprobado') fillColor = "C6EFCE";
            else if (estado === 'denegado') fillColor = "FFC7CE";
            else if (estado === 'pendiente') fillColor = "FFEB9C";

            ws[cellRef].s = {
              fill: {
                fgColor: {
                  rgb: fillColor
                }
              }
            };
          }
        }
      }

      // Crear y descargar el archivo
      const wb = XLSX.utils.book_new();
      XLSX.utils.book_append_sheet(wb, ws, "Solicitudes");

      const timestamp = new Date().toISOString().replace(/[-:.]/g, "");
      const fileName = `Reporte_Admisiones_${timestamp}.xlsx`;

      XLSX.writeFile(wb, fileName);
    }

    // Función de búsqueda
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.querySelector('.input-group input[type="text"]');
      const table = document.getElementById('tablaUsuarios');
      const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

      function filterTable(searchTerm) {
        searchTerm = searchTerm.toLowerCase().trim();

        Array.from(rows).forEach(row => {
          const cells = Array.from(row.getElementsByTagName('td'));

          if (searchTerm === '') {
            row.style.display = '';
            cells.forEach(cell => {
              // No restaurar el HTML de la celda si contiene botones
              if (!cell.querySelector('.btn')) {
                cell.innerHTML = cell.textContent;
              }
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
              // Si la celda contiene botones, no modificar su HTML
              if (!cell.querySelector('.btn')) {
                const text = cell.textContent;
                if (text.toLowerCase().includes(searchTerm)) {
                  const regex = new RegExp(`(${searchTerm})`, 'gi');
                  const highlightedText = text.replace(regex, '<span class="highlight">$1</span>');
                  cell.innerHTML = highlightedText;
                } else {
                  cell.innerHTML = text;
                }
              }
            });
          } else {
            row.style.display = 'none';
          }
        });
      }

      // Agregar el botón de limpiar búsqueda
      const searchContainer = searchInput.parentElement;
      const clearButton = document.createElement('button');
      clearButton.className = 'btn btn-outline-secondary';

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
  </script>
</body>

</html>