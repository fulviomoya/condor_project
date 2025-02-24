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


// ventana solo paa IOS  chrome 

document.addEventListener('DOMContentLoaded', function () {
    function isIOSChrome() {
        const userAgent = navigator.userAgent;
        return /CriOS/.test(userAgent) && /iPad|iPhone|iPod/.test(userAgent);
    }

    if (isIOSChrome()) {
        showUnsupportedBrowserModal();
    }
});

function showUnsupportedBrowserModal() {
    const modalHTML = `
        <div class="unsupported-browser-modal">
            <div class="modal-content">
                <h2>Navegador no soportado</h2>
                <p>Este navegador no soporta el sistema. Por favor, use Safari en su dispositivo iOS.</p>
                <button class="close-modal" onclick="closeUnsupportedBrowserModal()">Cerrar</button>
            </div>
        </div>
        <div class="modal-overlay"></div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);
    document.querySelector('.modal-overlay').style.display = 'block';
    document.querySelector('.unsupported-browser-modal').style.display = 'block';
}

function closeUnsupportedBrowserModal() {
    document.querySelector('.unsupported-browser-modal').remove();
    document.querySelector('.modal-overlay').remove();
}