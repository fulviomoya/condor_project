const FORMULARIO_LOGIN = document.getElementById("loginForm");

FORMULARIO_LOGIN.addEventListener('submit', async function (event) {
    event.preventDefault();
    let isValid = true;

    // Obtener valores del formulario
    const username = document.getElementById('login-name').value.trim();
    const password = document.getElementById('login-pass').value.trim();

    // Limpiar mensajes de error previos
    document.getElementById('username-error').textContent = '';
    document.getElementById('password-error').textContent = '';

    // Validaciones básicas del lado del cliente
    if (username === '') {
        document.getElementById('username-error').textContent = 'Se requiere un nombre de usuario';
        isValid = false;
    }

    if (password === '') {
        document.getElementById('password-error').textContent = 'Se requiere una contraseña';
        isValid = false;
    }

    // Solo enviar si los campos no están vacíos
    if (isValid) {
        try {
            const formData = new FormData(this);
            const response = await fetch("Validar.php", {
                method: "POST",
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const text = await response.text(); // Primero obtener el texto
            console.log('Respuesta del servidor:', text); // Para depuración

            try {
                const data = JSON.parse(text);
                if (data.success) {
                    window.location.href = "Parte_Administrativa/Dashboard(tabla).php";
                } else {
                    document.getElementById('username-error').textContent = data.message;
                }
            } catch (e) {
                console.error('Error al parsear JSON:', e);
                document.getElementById('username-error').textContent = 'Error en la respuesta del servidor';
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('username-error').textContent = 'Error de conexión. Por favor, intente nuevamente.';
        }
    }
});