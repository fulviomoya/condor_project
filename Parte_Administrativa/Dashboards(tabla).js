document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.querySelector('.input-group input[type="text"]');
  const table = document.getElementById('tablaUsuarios');
  

  document.addEventListener('DOMContentLoaded', function() {
  let tabla = document.getElementById('tablaTodosUsuarios');
  if (tabla) {
    let tbody = tabla.getElementsByTagName('tbody')[0];
    // Your code here
  } else {
    console.error("El elemento con el ID 'tablaTodosUsuarios' no se encontró en el DOM.");
  }
});

  function filterTable(searchTerm) {
    searchTerm = searchTerm.toLowerCase().trim();

    Array.from(rows).forEach(row => {
      const cells = Array.from(row.getElementsByTagName('td'));

      // Si no hay término de búsqueda, mostrar todas las filas
      if (searchTerm === '') {
        row.style.display = '';
        cells.forEach((cell, index) => {
          // No modificar las celdas de los PDFs (índices 14 y 15)
          if (index !== 14 && index !== 15) {
            cell.innerHTML = cell.textContent;
          }
        });
        return;
      }

      // Buscar solo en las celdas que no son botones PDF
      const searchableCells = cells.filter((_, index) => index !== 14 && index !== 15 && index !== 17);
      const found = searchableCells.some(cell => {
        const text = cell.textContent.toLowerCase();
        return text.includes(searchTerm);
      });

      if (found) {
        row.style.display = '';
        cells.forEach((cell, index) => {
          // No modificar las celdas de los PDFs (índices 14 y 15) ni la columna de acciones (17)
          if (index !== 14 && index !== 15 && index !== 17) {
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

  // Botón para limpiar la búsqueda
  const searchContainer = searchInput.parentElement;
  const clearButton = document.createElement('button');

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



// Función para paginar los datos
function paginarDatos(datos, paginaActual, registrosPorPagina) {
  const inicio = (paginaActual - 1) * registrosPorPagina;
  const fin = inicio + registrosPorPagina;
  return datos.slice(inicio, fin);
}

// Función para crear los botones de paginación
function crearBotonesPaginacion(totalPaginas, paginaActual, callback) {
  const paginacion = document.querySelector('.pagination');
  paginacion.innerHTML = '';

  // Botón Anterior
  const prevLi = document.createElement('li');
  prevLi.className = `page-item ${paginaActual === 1 ? 'disabled' : ''}`;
  prevLi.innerHTML = `
<a class="page-link" href="#" data-page="prev" ${paginaActual === 1 ? 'tabindex="-1"' : ''}>
  Anterior
</a>
`;
  paginacion.appendChild(prevLi);

  // Botones numerados
  for (let i = 1; i <= totalPaginas; i++) {
    const li = document.createElement('li');
    li.className = `page-item ${paginaActual === i ? 'active' : ''}`;
    li.innerHTML = `
  <a class="page-link" href="#" data-page="${i}">${i}</a>
`;
    paginacion.appendChild(li);
  }

  // Botón Siguiente
  const nextLi = document.createElement('li');
  nextLi.className = `page-item ${paginaActual === totalPaginas ? 'disabled' : ''}`;
  nextLi.innerHTML = `
<a class="page-link" href="#" data-page="next" ${paginaActual === totalPaginas ? 'tabindex="-1"' : ''}>
  Siguiente
</a>
`;
  paginacion.appendChild(nextLi);

  // Event listener para la paginación
  paginacion.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains('page-link')) {
      const pageData = e.target.getAttribute('data-page');
      let newPage = paginaActual;

      if (pageData === 'prev' && paginaActual > 1) {
        newPage = paginaActual - 1;
      } else if (pageData === 'next' && paginaActual < totalPaginas) {
        newPage = paginaActual + 1;
      } else if (!isNaN(pageData)) {
        newPage = parseInt(pageData);
      }

      if (newPage !== paginaActual && newPage >= 1 && newPage <= totalPaginas) {
        // Reset scroll position before changing page
        const tableWrapper = document.querySelector('.table-wrapper');
        if (tableWrapper) {
          tableWrapper.scrollLeft = 0;
        }
        callback(newPage);
      }
    }
  });
}