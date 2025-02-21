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
  //SECCIONES
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

  // Función para validar el tamaño y tipo de archivo
  function validarArchivo(archivo, tipoDocumento) {
    const tiposPermitidos = ['application/pdf'];
    const tamañoMaximo = 5 * 1024 * 1024; // 5MB en bytes

    if (!archivo) {
      showAlert(`Por favor seleccione un archivo para ${tipoDocumento}`, 'warning');
      return false;
    }

    if (!tiposPermitidos.includes(archivo.type)) {
      showAlert(`El archivo de ${tipoDocumento} debe ser PDF`, 'danger');
      return false;
    }

    if (archivo.size > tamañoMaximo) {
      showAlert(`El archivo de ${tipoDocumento} no debe exceder 5MB`, 'danger');
      return false;
    }

    return true;
  }

  // Listener para acta de nacimiento
  actaNacimientoInput.addEventListener('change', function (e) {
    const archivo = e.target.files[0];
    if (validarArchivo(archivo, 'Acta de Nacimiento')) {
      showAlert('Acta de nacimiento cargada correctamente', 'success');
    } else {
      this.value = ''; // Limpiar el input si no es válido
    }
  });

  // Listener para record de notas
  recordNotasInput.addEventListener('change', function (e) {
    const archivo = e.target.files[0];
    if (validarArchivo(archivo, 'Record de Notas')) {
      showAlert('Record de notas cargado correctamente', 'success');
    } else {
      this.value = ''; // Limpiar el input si no es válido
    }
  });

  const numbers = document.querySelectorAll('.circulos .num');
  const lines = document.querySelectorAll('.circulos .line');
  let currentSection = 0;
  // Añadir esta línea para definir completedSections
  let completedSections = new Set([0]); // Inicializar con la primera sección

  // Initialize first section and styles
  sections[0].classList.add('section', 'active');
  sections.slice(1).forEach(section => section.classList.add('section'));

  // Update all buttons to be "next" type except the last one
  sections.forEach((section, index) => {
    const button = section.querySelector('button');
    if (index === sections.length - 1) {
      button.textContent = 'Enviar';
    } else {
      button.textContent = 'Siguiente';
    }
  });

  sections.forEach((section, index) => {
    const button = section.querySelector('button');
    button.addEventListener('click', function (e) {
      e.preventDefault();

      const requiredFields = section.querySelectorAll('input[required], select[required]');
      let isValid = true;
      let hasEmptyFields = false;
      let errorMessages = [];

      requiredFields.forEach(field => {
        if (!field.value.trim()) {
          isValid = false;
          hasEmptyFields = true;
          field.style.borderColor = 'red';
        } else if (field.id === 'telefono') {
          // Mantener solo la validación específica para teléfono
          if (!/^\d{10}$/.test(field.value.trim())) {
            isValid = false;
            field.style.borderColor = 'red';
            errorMessages.push('El teléfono debe contener 10 dígitos numéricos');
          }
        } else if (field.id === 'correo_electronico') {
          // Validación específica para el correo electrónico
          const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
          if (!emailPattern.test(field.value.trim())) {
            isValid = false;
            field.style.borderColor = 'red';
            errorMessages.push('Por favor, introduce un correo electrónico válido');
          }
        }
      });

      // Agregar mensaje genérico si hay campos vacíos
      if (hasEmptyFields) {
        errorMessages.unshift('Debe llenar los campos obligatorios');
      }

      if (!isValid) {
        const errorMessage = errorMessages.join('<br>');
        showAlert(errorMessage, 'danger');
        return;
      }

      // Modifica la generación del código dentro del if (index === sections.length - 1)
      const generarIdPlaza = () => {
        const num = String(Math.floor(Math.random() * 9000000) + 1000000).padStart(7, '0');
        return `PL${num}`;
      };


      // Si es la última sección (sixth_section)
      if (index === sections.length - 1) {
        const nombreEstudiante = document.getElementById('nombre').value || '';
        const apellidoEstudiante = document.getElementById('apellido').value || '';
        const segundoApellidoEstudiante = document.getElementById('segundo_apellido').value || '';
        const nombreCompleto = `${nombreEstudiante} ${apellidoEstudiante} ${segundoApellidoEstudiante}`.trim();
        const idPlaza = generarIdPlaza();

        // Mostrar ventana emergente
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

        // Configurar el envío del formulario
        document.getElementById('enviarFormulario').addEventListener('click', function () {
          const form = document.querySelector('form');

          // Agregar el campo oculto con el ID de plaza
          const idPlazaInput = document.createElement('input');
          idPlazaInput.type = 'hidden';
          idPlazaInput.name = 'id_plaza';
          idPlazaInput.value = idPlaza;
          document.querySelector('form').appendChild(idPlazaInput);

          form.submit();
        });

        return;
      }

      // Si no es la última sección, continuar normalmente
      navigateToSection(currentSection + 1);
      showAlert('Sección completada correctamente', 'success');
    });

    // Reset border color when user starts typing
    document.querySelectorAll('input[required], select[required]').forEach(input => {
      input.addEventListener('input', function () {
        this.style.borderColor = '#BABABA';
      });
    });
  });


  // Add click handlers to the numbers for navigation
  numbers.forEach((number, index) => {
    number.addEventListener('click', () => {
      const targetSection = index;

      // Allow moving backwards without validation
      if (targetSection < currentSection) {
        navigateToSection(targetSection);
        return;
      }

      // For forward navigation, check if all previous sections are completed
      if (canNavigateToSection(targetSection)) {
        navigateToSection(targetSection);
      } else {
        showAlert('Por favor complete la sección actual antes de avanzar', 'danger');
      }
    });
  });

  function canNavigateToSection(targetSection) {
    // Check if all previous sections have been completed
    for (let i = 0; i < targetSection; i++) {
      if (!completedSections.has(i)) {
        return false;
      }
    }
    return true;
  }

  function navigateToSection(targetSection) {
    // Remove active class from current section
    sections[currentSection].classList.remove('active');

    // Add active class to target section
    sections[targetSection].classList.add('active');

    // Update number and line styles
    updateNavigationStyles(targetSection);

    // Update current section
    currentSection = targetSection;
  }

  function updateNavigationStyles(targetSection) {
    // Update numbers
    numbers.forEach((num, index) => {
      if (index <= targetSection || completedSections.has(index)) {
        num.classList.add('active');
      } else {
        num.classList.remove('active');
      }
    });

    // Update lines
    lines.forEach((line, index) => {
      if (index < targetSection || (completedSections.has(index) && completedSections.has(index + 1))) {
        line.classList.add('active');
      } else {
        line.classList.remove('active');
      }
    });

    // Agregar el event listener para el select de nacionalidad
    const nacionalidadSelect = document.getElementById('nacionalidad_select');
    const otraNacionalidadDiv = document.getElementById('otra_nacionalidad_div');
    const otraNacionalidadInput = document.getElementById('otra_nacionalidad');


    nacionalidadSelect.addEventListener('change', function () {
      if (this.value === 'otro') {
        otraNacionalidadDiv.style.display = 'block';
        otraNacionalidadInput.required = true;
      } else {
        otraNacionalidadDiv.style.display = 'none';
        otraNacionalidadInput.required = false;
        otraNacionalidadInput.value = ''; // Limpiar el valor
      }


    });
    // Modificar la parte del envío del formulario
    document.getElementById('enviarFormulario')?.addEventListener('click', function () {
      const form = document.querySelector('form');
      const nacionalidadSelect = document.getElementById('nacionalidad_select');
      const otraNacionalidad = document.getElementById('otra_nacionalidad');

      // Crear o actualizar el campo oculto para la nacionalidad
      let hiddenInput = document.querySelector('input[name="nacionalidad"]');
      if (!hiddenInput) {
        hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'nacionalidad';
        form.appendChild(hiddenInput);
      }

      // Establecer el valor de nacionalidad
      if (nacionalidadSelect.value === 'otro' && otraNacionalidad.value) {
        hiddenInput.value = otraNacionalidad.value;
      } else {
        hiddenInput.value = nacionalidadSelect.value;
      }


    }

    );
  }
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


