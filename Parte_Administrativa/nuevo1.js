document.addEventListener('DOMContentLoaded', function() {
    // Funcionalidad del buscador
    const searchInput = document.querySelector('.input-group input[type="text"]');
    const table = document.querySelector('.table');
    const rows = table.querySelectorAll('tbody tr');
  
    function filterTable(searchTerm) {
        searchTerm = searchTerm.toLowerCase().trim();
  
        rows.forEach(row => {
            const cells = Array.from(row.getElementsByTagName('td')).slice(0, -1);
            
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
  
        updatePagination();
    }
  
    function updatePagination() {
        const visibleRows = Array.from(rows).filter(row => row.style.display !== 'none');
        const pagination = document.querySelector('.pagination');
        
        if (pagination) {
            pagination.style.display = visibleRows.length === 0 ? 'none' : '';
        }
    }
  
    // Mostrar todos los registros al cargar la página
    filterTable('');
  
    searchInput.addEventListener('input', (e) => {
        filterTable(e.target.value);
    });
  
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
  
    searchInput.addEventListener('input', () => {
        clearButton.style.display = searchInput.value ? '' : 'none';
    });
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    // Configuración de la paginación
    const rowsPerPage = 6;
    let currentPage = 1;
  
    // Funcionalidad de los botones Aprobar/Denegar
    const btnAprobar = document.querySelectorAll('.btn-aprobar');
    const btnDenegar = document.querySelectorAll('.btn-denegar');
  
    function actualizarEstado(fila, nuevoEstado) {
        // [Código previo se mantiene igual]
    }
  
    function confirmarAccion(mensaje) {
        return window.confirm(mensaje);
    }
  
    // [Código de btnAprobar y btnDenegar se mantiene igual]
  
    // Funcionalidad del buscador y paginación
    const searchInput = document.querySelector('.input-group input[type="text"]');
    const table = document.querySelector('.table');
    const rows = table.querySelectorAll('tbody tr');
  
    function filterTable(searchTerm) {
        searchTerm = searchTerm.toLowerCase().trim();
        let visibleRows = [];
  
        rows.forEach(row => {
            const cells = Array.from(row.getElementsByTagName('td')).slice(0, -1);
            
            if (searchTerm === '') {
                row.style.display = '';
                cells.forEach(cell => {
                    cell.innerHTML = cell.textContent;
                });
                visibleRows.push(row);
            } else {
                const found = cells.some(cell => {
                    const text = cell.textContent.toLowerCase();
                    return text.includes(searchTerm);
                });
  
                if (found) {
                    visibleRows.push(row);
                    cells.forEach(cell => {
                        const text = cell.textContent;
                        if (text.toLowerCase().includes(searchTerm)) {
                            const regex = new RegExp(`(${searchTerm})`, 'gi');
                            const highlightedText = text.replace(regex, '<span class="highlight">$1</span>');
                            cell.innerHTML = highlightedText;
                        } else {
                            cell.innerHTML = text;
                        }
                    });
                }
            }
        });
  
        updatePagination(visibleRows);
        showPage(1, visibleRows);
    }
  
    function showPage(page, visibleRows) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        currentPage = page;
  
        rows.forEach(row => row.style.display = 'none');
  
        visibleRows.slice(start, end).forEach(row => {
            row.style.display = '';
        });
  
        updatePaginationButtons(visibleRows.length);
    }
  
    function updatePagination(visibleRows) {
        const pagination = document.querySelector('.pagination');
        if (!pagination) return;
  
        const totalPages = Math.ceil(visibleRows.length / rowsPerPage);
        
        pagination.innerHTML = '';
  
        // Botón Anterior (corregido)
        const prevButton = createPageItem('Anterior', () => {
            if (currentPage > 1) {
                showPage(currentPage - 1, visibleRows);
            }
        });
        prevButton.querySelector('.page-link').addEventListener('click', (e) => {
            e.preventDefault();
            if (currentPage > 1) {
                showPage(currentPage - 1, visibleRows);
            }
        });
        pagination.appendChild(prevButton);
  
        // Números de página
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = createPageItem(i.toString(), () => {
                showPage(i, visibleRows);
            }, false, currentPage === i);
            pagination.appendChild(pageButton);
        }
  
        // Botón Siguiente
        const nextButton = createPageItem('Siguiente', () => {
            if (currentPage < totalPages) {
                showPage(currentPage + 1, visibleRows);
            }
        });
        pagination.appendChild(nextButton);
  
        updatePaginationButtons(visibleRows.length);
    }
  
    function createPageItem(text, onClick, disabled = false, active = false) {
        const li = document.createElement('li');
        li.className = `page-item${disabled ? ' disabled' : ''}${active ? ' active' : ''}`;
        
        const a = document.createElement('a');
        a.className = 'page-link';
        a.href = '#';
        a.textContent = text;
        
        if (!disabled) {
            a.addEventListener('click', (e) => {
                e.preventDefault();
                onClick();
            });
        }
        
        li.appendChild(a);
        return li;
    }
  
    function updatePaginationButtons(totalRows) {
        const totalPages = Math.ceil(totalRows / rowsPerPage);
        const pagination = document.querySelector('.pagination');
        
        Array.from(pagination.children).forEach(item => {
            if (item.textContent === 'Anterior') {
                item.classList.toggle('disabled', currentPage === 1);
            } else if (item.textContent === 'Siguiente') {
                item.classList.toggle('disabled', currentPage === totalPages);
            } else {
                const pageNum = parseInt(item.textContent);
                if (!isNaN(pageNum)) {
                    item.classList.toggle('active', pageNum === currentPage);
                }
            }
        });
    }
  
    // Inicialización y event listeners
    filterTable('');
  
    searchInput.addEventListener('input', (e) => {
        filterTable(e.target.value);
    });
  
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
  
    searchInput.addEventListener('input', () => {
        clearButton.style.display = searchInput.value ? '' : 'none';
    });
  });