function nextPage() {
    document.getElementById('page1').classList.remove('active');
    document.getElementById('page2').classList.add('active');
    document.getElementById('pageNumber').textContent = '2';
}

function previousPage() {
    document.getElementById('page2').classList.remove('active');
    document.getElementById('page1').classList.add('active');
    document.getElementById('pageNumber').textContent = '1';
}

function goToForm() {
    // Add your form URL here
    // window.location.href = 'your-form-url';
    alert('Aquí irá el enlace al formulario');
}

