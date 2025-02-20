// validacion.js
function validarForm() {
    // Usuario y contraseña predeterminados
    const USUARIO_CORRECTO = "admin";
    const PASS_CORRECTA = "&&6I+7q7Oh-3";

    // Obtener valores del formulario
    const username = document.getElementById('login-name').value.trim();
    const password = document.getElementById('login-pass').value.trim();
    
    // Limpiar mensajes de error previos
    document.getElementById('username-error').textContent = '';
    document.getElementById('password-error').textContent = '';
    
    let esValido = true;

    // Validar usuario
    if (username === '') {
        document.getElementById('username-error').textContent = 'Se requiere un nombre de usuario';
        esValido = false;
    } else if (username !== USUARIO_CORRECTO) {
        document.getElementById('username-error').textContent = 'Usuario incorrecto';
        esValido = false;
    }

    // Validar contraseña
    if (password === '') {
        document.getElementById('password-error').textContent = 'Se requiere una contraseña';
        esValido = false;
    } else if (password !== PASS_CORRECTA) {
        document.getElementById('password-error').textContent = 'Contraseña incorrecta';
        esValido = false;
    }

    return esValido;
}