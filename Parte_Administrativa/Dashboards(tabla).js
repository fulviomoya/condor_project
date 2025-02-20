
  // Viejo javascript //
  document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.input-group input[type="text"]');
    const table = document.querySelector('.table');
    const rows = table.querySelectorAll('tbody tr');
  
    function filterTable(searchTerm) {
      searchTerm = searchTerm.toLowerCase().trim();
  
      rows.forEach(row => {
        const cells = Array.from(row.getElementsByTagName('td')).slice(0, -1);
        
        const found = cells.some(cell => {
          const text = cell.textContent.toLowerCase();
          return text.includes(searchTerm);
        });
  
        if (found) {
          row.style.display = '';
          if (searchTerm !== '') {
            cells.forEach(cell => {
              const text = cell.textContent;
              if (text.toLowerCase().includes(searchTerm)) {
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                const highlightedText = text.replace(regex, '<span class="highlight">$1</span>');
                cell.innerHTML = highlightedText;
              }
            });
          } else {
            cells.forEach(cell => {
              cell.innerHTML = cell.textContent;
            });
          }
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
        if (visibleRows.length === 0) {
          pagination.style.display = 'none';
        } else {
          pagination.style.display = '';
        }
      }
    }
  
    searchInput.addEventListener('input', (e) => {
      filterTable(e.target.value);
    });
  
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
  

  


 