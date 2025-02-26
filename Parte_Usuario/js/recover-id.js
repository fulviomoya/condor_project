document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formRecuperar');
    const idActaInput = document.getElementById('idActa');
    const resultadoBusqueda = document.getElementById('resultadoBusqueda');

    function showAlert(message, type = 'danger') {
        const alertContainer = document.getElementById('alertContainer');
        const alertId = `alert-${Date.now()}`;

        const alertHTML = `
            <div id="${alertId}" class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        alertContainer.insertAdjacentHTML('beforeend', alertHTML);

        setTimeout(() => {
            const alert = document.getElementById(alertId);
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    }

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Limpiamos el ID de acta removiendo los guiones
        const idActaSucio = idActaInput.value;
        const idActa = idActaSucio.replace(/-/g, '');

        // Validar longitud
        if (!idActa) {
            showAlert('Por favor, ingrese un ID de acta', 'danger');
            return;
        }

        if (idActa.length >= 19) {
            showAlert('El ID de acta no puede exceder los 19 caracteres', 'warning');
            return;
        }

        // Realizar la consulta con el ID limpio
        fetch('recuperar-id-plaza.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `idActa=${idActa}`
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultadoBusqueda.innerHTML = `
                    <div>Nombre completo: ${data.nombreCompleto}</div>
                    <div>Código de solicitud: ${data.idSolicitud}</div>
                `;
                    resultadoBusqueda.style.display = 'block';
                    resultadoBusqueda.className = 'mt-2 text-success';
                    showAlert('Información encontrada exitosamente', 'success');
                } else {
                    resultadoBusqueda.style.display = 'none';
                    showAlert(data.message, 'danger');
                }
            })
            .catch(error => {
                showAlert('Error al buscar el código de solicitud', 'danger');
                console.error('Error:', error);
            });
    });
});