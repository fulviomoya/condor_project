
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

    // Auto-cerrar la alerta después de 5 segundos
    setTimeout(() => {
        const alert = document.getElementById(alertId);
        if (alert) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }
    }, 5000);
}


// JavaScript for handling section navigation
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById("form");
    const sections = [
        document.querySelector('.first_section'),
        document.querySelector('.second_section'),
        document.querySelector('.third_section'),
        document.querySelector('.fourth_section'),
        document.querySelector('.fifth_section'),
        document.querySelector('.sixth_section')
    ];

    const actaNacimientoInput = document.getElementById('Acta_de_nacimiento');
    const recordNotasInput = document.getElementById('record_notas');

    // Función para validar archivos
    function validarArchivo(archivo, tipoDocumento) {
        const tiposPermitidos = ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'];
        const tamañoMaximo = 50 * 1024 * 1024; // 50MB en bytes

        if (!archivo) {
            showAlert(`Por favor seleccione un archivo para ${tipoDocumento}`, 'warning');
            return false;
        }

        if (!tiposPermitidos.includes(archivo.type)) {
            showAlert(`El archivo de ${tipoDocumento} debe ser PDF o una imagen`, 'danger');
            return false;
        }

        if (archivo.size > tamañoMaximo) {
            showAlert(`El archivo de ${tipoDocumento} no debe exceder los 50MB`, 'danger');
            return false;
        }

        return true;
    }

    // Event listeners para los archivos
    actaNacimientoInput.addEventListener('change', function (e) {
        const archivo = e.target.files[0];
        if (archivo) {
            if (validarArchivo(archivo, 'Acta de Nacimiento')) {
                showAlert('Acta de nacimiento cargada correctamente', 'success');
            } else {
                this.value = '';
            }
        }
    });

    recordNotasInput.addEventListener('change', function (e) {
        const archivo = e.target.files[0];
        if (archivo) {
            if (validarArchivo(archivo, 'Record de Notas')) {
                showAlert('Boletín de calificaciones cargado correctamente', 'success');
            } else {
                this.value = '';
            }
        }
    });

    const numbers = document.querySelectorAll('.circulos .num');
    const lines = document.querySelectorAll('.circulos .line');
    let currentSection = 0;
    let completedSections = new Set([0]);

    // Inicializar primera sección
    sections[0].classList.add('section', 'active');
    sections.slice(1).forEach(section => section.classList.add('section'));

    // Función para validar una sección
    function validateSection(sectionIndex) {
        const section = sections[sectionIndex];
        const requiredFields = section.querySelectorAll('input[required], select[required]');
        let isValid = true;
        let errorMessages = [];

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.style.borderColor = 'red';
            } else if (field.id === 'telefono') {
                if (!/^\d{10}$/.test(field.value.trim())) {
                    isValid = false;
                    field.style.borderColor = 'red';
                    errorMessages.push('El teléfono debe contener 10 dígitos numéricos');
                }
            } else if (field.id === 'correo_electronico') {
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(field.value.trim())) {
                    isValid = false;
                    field.style.borderColor = 'red';
                    errorMessages.push('Por favor, introduce un correo electrónico válido');
                }
            } else if (field.id === 'correo_padres') {
                const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(field.value.trim())) {
                    isValid = false;
                    field.style.borderColor = 'red';
                    errorMessages.push('Por favor, introduce un correo electrónico válido para los padres');
                }
            }
        });

        if (!isValid && requiredFields.length > 0) {
            errorMessages.unshift('Debe llenar los campos obligatorios');
        }

        return { isValid, errorMessages };
    }

    // Configurar botones de cada sección
    // Reemplazar la sección de configuración de botones con este código:
    sections.forEach((section, index) => {
        const button = section.querySelector('button');
        button.textContent = index === sections.length - 1 ? 'Finalizar' : 'Siguiente';

        button.addEventListener('click', function (e) {
            e.preventDefault();

            const { isValid, errorMessages } = validateSection(index);

            if (!isValid) {
                showAlert(errorMessages.join('<br>'), 'danger');
                return;
            }

            if (index === sections.length - 1) {
                // Generar ID de plaza antes de enviar
                const idPlaza = generarIdPlaza();
                const nombreCompleto = [
                    document.getElementById('nombre').value,
                    document.getElementById('apellido').value,
                    document.getElementById('segundo_apellido').value
                ].filter(Boolean).join(' ');

                // Crear input oculto para el ID de plaza
                const idPlazaInput = document.createElement('input');
                idPlazaInput.type = 'hidden';
                idPlazaInput.name = 'id_plaza';
                idPlazaInput.value = idPlaza;
                form.appendChild(idPlazaInput);

                // Guardar datos en sessionStorage para el modal
                sessionStorage.setItem('formularioData', JSON.stringify({
                    idPlaza: idPlaza,
                    nombreCompleto: nombreCompleto
                }));

                // Enviar formulario
                form.submit();
            } else {
                // Navegar a la siguiente sección
                completedSections.add(index);
                navigateToSection(index + 1);
                showAlert('Sección completada correctamente', 'success');
            }
        });
    });

    // Función auxiliar para generar ID de plaza
    function generarIdPlaza() {
        return `PL${String(Math.floor(Math.random() * 9000000) + 1000000)}${new Date().getHours().toString()}${new Date().getMilliseconds().toString()}`;
    }

    // Event listeners para los números de navegación
    numbers.forEach((number, index) => {
        number.addEventListener('click', () => {
            if (index < currentSection) {
                // Permitir navegación hacia atrás sin validación
                navigateToSection(index);
            } else if (index > currentSection) {
                // Validar sección actual antes de permitir avance
                const { isValid, errorMessages } = validateSection(currentSection);
                if (isValid) {
                    completedSections.add(currentSection);
                    navigateToSection(index);
                } else {
                    showAlert(errorMessages.join('<br>'), 'danger');
                }
            }
        });
    });

    function navigateToSection(targetSection) {
        sections[currentSection].classList.remove('active');
        sections[targetSection].classList.add('active');
        updateNavigationStyles(targetSection);
        currentSection = targetSection;
    }

    function updateNavigationStyles(targetSection) {
        numbers.forEach((num, index) => {
            num.classList.toggle('active', index <= targetSection || completedSections.has(index));
        });

        lines.forEach((line, index) => {
            line.classList.toggle('active',
                index < targetSection || (completedSections.has(index) && completedSections.has(index + 1))
            );
        });
    }

    // Manejo de nacionalidad
    const nacionalidadSelect = document.getElementById('nacionalidad_select');
    const otraNacionalidadDiv = document.getElementById('otra_nacionalidad_div');
    const otraNacionalidadInput = document.getElementById('otra_nacionalidad');

    if (nacionalidadSelect) {
        nacionalidadSelect.addEventListener('change', function () {
            const mostrarOtraNacionalidad = this.value === 'otro';
            otraNacionalidadDiv.style.display = mostrarOtraNacionalidad ? 'block' : 'none';
            otraNacionalidadInput.required = mostrarOtraNacionalidad;
            if (!mostrarOtraNacionalidad) {
                otraNacionalidadInput.value = '';
            }
        });
    }

    // Reset de bordes rojos al escribir
    document.querySelectorAll('input[required], select[required]').forEach(input => {
        input.addEventListener('input', function () {
            this.style.borderColor = '#BABABA';
        });
    });
});


// Importar jsPDF desde CDN (agregar al HTML)
// <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

class ImageToPDFConverter {
    constructor(fileInput, acceptedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf']) {
        this.fileInput = fileInput;
        this.acceptedTypes = acceptedTypes;
        this.setupFileInput();
    }

    setupFileInput() {
        // Modificar el accept attribute para permitir imágenes y PDF
        this.fileInput.accept = '.pdf,.jpg,.jpeg,.png,.gif';

        this.fileInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (!file) return;

            try {
                const convertedFile = await this.handleFile(file);
                // Reemplazar el archivo en el input con el PDF convertido
                const container = new DataTransfer();
                container.items.add(convertedFile);
                this.fileInput.files = container.files;

                showAlert('Archivo procesado correctamente', 'success');
            } catch (error) {
                showAlert('Error al procesar el archivo: ' + error.message, 'danger');
                this.fileInput.value = '';
            }
        });
    }

    async handleFile(file) {
        // Si ya es PDF, retornar el archivo
        if (file.type === 'application/pdf') {
            return file;
        }

        // Validar si es una imagen aceptada
        if (!this.acceptedTypes.includes(file.type)) {
            throw new Error('Tipo de archivo no soportado');
        }

        // Convertir imagen a PDF
        return await this.convertImageToPDF(file);
    }

    async convertImageToPDF(imageFile) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = async (e) => {
                try {
                    const img = new Image();
                    img.src = e.target.result;

                    await new Promise(resolve => img.onload = resolve);

                    // Crear PDF con dimensiones proporcionales a la imagen
                    const pdf = new jspdf.jsPDF({
                        orientation: img.width > img.height ? 'l' : 'p',
                        unit: 'px',
                        format: [img.width, img.height]
                    });

                    // Agregar la imagen al PDF
                    pdf.addImage(
                        img.src,
                        'JPEG',
                        0,
                        0,
                        img.width,
                        img.height
                    );

                    // Convertir a Blob
                    const pdfBlob = pdf.output('blob');

                    // Crear archivo PDF
                    const pdfFile = new File(
                        [pdfBlob],
                        imageFile.name.replace(/\.[^/.]+$/, '.pdf'),
                        { type: 'application/pdf' }
                    );

                    resolve(pdfFile);
                } catch (error) {
                    reject(error);
                }
            };
            reader.onerror = () => reject(new Error('Error al leer el archivo'));
            reader.readAsDataURL(imageFile);
        });
    }
}


document.addEventListener('DOMContentLoaded', function () {
    // Inicializar convertidores para ambos inputs de archivo
    const actaConverter = new ImageToPDFConverter(
        document.getElementById('Acta_de_nacimiento')
    );
    const notasConverter = new ImageToPDFConverter(
        document.getElementById('record_notas')
    );
});