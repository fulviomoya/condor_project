// Add this CSS to complement your existing styles
const styles = `
.section {
  opacity: 0;
  display: none;
  transform: translateX(20px);
  transition: opacity 0.5s ease, transform 0.5s ease;
}

.section.active {
  opacity: 1;
  display: flex;
  transform: translateX(0);
}

input{
    height: 60px;
    border-radius: 16px;
    border: solid 3px #BABABA;
    padding: 10px;
}

input::placeholder{
    margin-left: 10px;
    font-size: 18px;
    font-family: 'popinsBold';
}

input[type="date"] {
    height: 60px;
    border-radius: 16px;
    border: solid 3px #BABABA;
    padding: 10px;
    font-family: 'popinsBold';
    font-size: 18px;
    color: #666;
    position: relative;
    cursor: pointer;
}

/* Transition for the circles and lines */
.num {
  transition: background-color 0.3s ease;
}

.line {
  transition: background-color 0.3s ease;
}

.num.active {
  background-color: var(--principal-color);
}

.line.active {
  background-color: var(--principal-color);
}

/* Popup and overlay styles */
.overlay {
  position: fixed;
  display: none;
  z-index: 1000;
  background-color: rgba(0, 0, 0, 0.6);
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}

.Pop-Pup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1001;
  border-radius: 10px;
  width: 55%;
  max-width: 600px;
  background-color: #ffffff;
  display: none;
  flex-direction: column;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.header_pop {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  padding: 10px;
}

.logo_pop {
  width: 140px;
  height: 100%;
  padding: 10px;
}

.svg_x {
  display: flex;
  align-items: flex-start;
  height: 100%;
  margin: 10px;
  cursor: pointer;
}

.svg_x svg {
  width: 32px;
  height: 32px;
  margin: 7px;
}

.cont_pop-pup {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: space-around;
  width: 100%;
  padding: 30px;
}

.text_pop-pup {
  display: flex;
  justify-content: center;
  text-align: center;
  width: 90%;
  font-family: 'popinsBold';
  font-size: 30px !important;
  color: var(--principal-color);
  margin-bottom: 40px;
}

.info_user {
  display: flex;
  justify-content: space-around;
  align-items: center;
  width: 100%;
  flex-wrap: wrap;
}

.info_user div {
  display: flex;
  text-align: center;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  margin: 10px 20px;
}

.info_user div span {
  color: var(--principal-color);
  font-size: 24px;
  font-family: 'popinsBold';
  margin-bottom: 10px;
}
  

/* Responsive adjustments */
@media (max-width: 808px) {
  .Pop-Pup {
    width: 90%;
    padding: 14px;
    background-color:transarent;
  }
  
  .text_pop-pup {
    font-size: 24px !important;
  }
  
  .info_user div span {
    font-size: 18px;
  }
}
@media (max-width: 1008px) {
 
  .cont_pop-pup{
  padding:0px;
  }
}
`;

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

// Add the styles to the document
const styleSheet = document.createElement("style");
styleSheet.textContent = styles;
document.head.appendChild(styleSheet);

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
        showAlert('Record de notas cargado correctamente', 'success');
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
      }
    });

    if (!isValid && requiredFields.length > 0) {
      errorMessages.unshift('Debe llenar los campos obligatorios');
    }

    return { isValid, errorMessages };
  }

  // Configurar botones de cada sección
  sections.forEach((section, index) => {
    const button = section.querySelector('button');
    button.textContent = index === sections.length - 1 ? 'Enviar' : 'Siguiente';

    button.addEventListener('click', function (e) {
      e.preventDefault();

      const { isValid, errorMessages } = validateSection(index);
      
      if (!isValid) {
        showAlert(errorMessages.join('<br>'), 'danger');
        return;
      }

      if (index === sections.length - 1) {
        // Lógica para la última sección
        const generarIdPlaza = () => {
          return `PL${String(Math.floor(Math.random() * 9000000) + 1000000).padStart(7, '0')}`;
        };

        const nombreCompleto = [
          document.getElementById('nombre').value,
          document.getElementById('apellido').value,
          document.getElementById('segundo_apellido').value
        ].filter(Boolean).join(' ');
        
        const idPlaza = generarIdPlaza();

        // Crear ventana emergente
        const popupHTML = `
          <div class="Pop-Pup" id="successPopup">
            <div class="header_pop">
              <div class="logo_pop">
                <img src="./IMG/logo1.png" alt="Logo" class="logo_pop"/>
              </div>
              <div class="svg_x" id="closePopup">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
              </div>
            </div>
            <div class="cont_pop-pup">
              <div class="text_pop-pup">
                <span>¡Formulario completado exitosamente!</span>
              </div>
              <div class="info_user">
                <div>
                  <span id="idPlaza">${idPlaza}</span>
                  <h3>ID de Plaza</h3>
                </div>
                <div>
                  <span id="nombreCompleto">${nombreCompleto}</span>
                  <h3>Nombre completo</h3>
                </div>
              </div>
              <button id="enviarFormulario" class="btn btn-primary mt-4">Enviar Formulario</button>
            </div>
          </div>
          <div class="overlay" id="overlay"></div>
        `;

        document.body.insertAdjacentHTML('beforeend', popupHTML);
        document.getElementById('overlay').style.display = 'flex';
        document.getElementById('successPopup').style.display = 'flex';

        // Configurar cierre del popup al hacer clic en la "X"
        document.getElementById('closePopup').addEventListener('click', function () {
          document.getElementById('successPopup').style.display = 'none';
          document.getElementById('overlay').style.display = 'none';
        });
        
        // Configurar envío final
        document.getElementById('enviarFormulario').addEventListener('click', function () {
          const idPlazaInput = document.createElement('input');
          idPlazaInput.type = 'hidden';
          idPlazaInput.name = 'id_plaza';
          idPlazaInput.value = idPlaza;
          form.appendChild(idPlazaInput);
          form.submit();
        });
      } else {
        // Navegar a la siguiente sección
        completedSections.add(index);
        navigateToSection(index + 1);
        showAlert('Sección completada correctamente', 'success');
      }
    });
  });

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

// Agregar estilos para el botón
const additionalStyles = `
#enviarFormulario {
    background-color: var(--principal-color);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-family: 'popinsBold';
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#enviarFormulario:hover {
    background-color: #0056b3;
}
`;

// Agregar los estilos adicionales
styleSheet.textContent = styles + additionalStyles;














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


document.addEventListener('DOMContentLoaded', function() {
  // Inicializar convertidores para ambos inputs de archivo
  const actaConverter = new ImageToPDFConverter(
    document.getElementById('Acta_de_nacimiento')
  );
  const notasConverter = new ImageToPDFConverter(
    document.getElementById('record_notas')
  );
});