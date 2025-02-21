// Agregar el HTML del modal al inicio del archivo
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
        <span id="codigoAdmision"></span>
        <h3>Código de admisión</h3>
      </div>
      <div>
        <span id="nombreCompleto"></span>
        <h3>Nombre completo</h3>
      </div>
    </div>
    <button id="enviarFormulario" class="btn btn-primary mt-4">Enviar Formulario</button>
  </div>
</div>
<div class="overlay" id="overlay"></div>
`;


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

/* Estilos del modal */
.overlay {
    position: fixed;
    display: none; /* Oculto por defecto */
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
    display: none; /* Oculto por defecto */
    flex-direction: column;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
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
  //insertar modal
  document.body.insertAdjacentHTML('beforeend', popupHTML);

  // Ocultar el modal explícitamente
  document.getElementById('overlay').style.display = 'none';
  document.getElementById('successPopup').style.display = 'none';

  const sections = [
    document.querySelector('.first_section'),
    document.querySelector('.second_section')
  ];

  // Mover el código de manejo de secciones dentro del DOMContentLoaded
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
          if (!/^\d{10}$/.test(field.value.trim())) {
            isValid = false;
            field.style.borderColor = 'red';
            errorMessages.push('El teléfono debe contener 10 dígitos numéricos');
          }
        }
      });

      if (hasEmptyFields) {
        errorMessages.unshift('Debe llenar los campos obligatorios');
      }

      if (!isValid) {
        const errorMessage = errorMessages.join('<br>');
        showAlert(errorMessage, 'danger');
        return;
      }

      // Mark this section as completed
      completedSections.add(index);

      // Si es la última sección del formulario
      if (index === sections.length - 1) {
        const nombreEstudiante = sessionStorage.getItem('estudiante_nombre') || '';
        const apellidoEstudiante = sessionStorage.getItem('estudiante_apellido') || '';
        const segundoApellidoEstudiante = sessionStorage.getItem('estudiante_segundo_apellido') || '';
        const nombreCompleto = `${nombreEstudiante} ${apellidoEstudiante} ${segundoApellidoEstudiante}`.trim();
        const codigoAdmision = Math.floor(Math.random() * 9000000) + 1000000;

        document.getElementById('nombreCompleto').textContent = nombreCompleto;
        document.getElementById('codigoAdmision').textContent = codigoAdmision;

        document.getElementById('overlay').style.display = 'flex';
        document.getElementById('successPopup').style.display = 'flex';
        return;
      }

      // Navigate to next section
      navigateToSection(currentSection + 1);
      showAlert('Sección completada correctamente', 'success');
    });
  });

  const numbers = document.querySelectorAll('.circulos .num');
  const lines = document.querySelectorAll('.circulos .line');
  let currentSection = 0;
  let completedSections = new Set([0]); // Track completed sections, starting with first section

  // Initialize first section and styles
  sections[0].classList.add('section', 'active');
  sections[1].classList.add('section');

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

  // Si es la última sección del formulario de padres
  if (index === sections.length - 1) {
    // Mostrar el modal con los datos
    const nombreEstudiante = sessionStorage.getItem('estudiante_nombre') || '';
    const apellidoEstudiante = sessionStorage.getItem('estudiante_apellido') || '';
    const segundoApellidoEstudiante = sessionStorage.getItem('estudiante_segundo_apellido') || '';
    const nombreCompleto = `${nombreEstudiante} ${apellidoEstudiante} ${segundoApellidoEstudiante}`.trim();
    const codigoAdmision = Math.floor(Math.random() * 9000000) + 1000000;

    document.getElementById('nombreCompleto').textContent = nombreCompleto;
    document.getElementById('codigoAdmision').textContent = codigoAdmision;

    // Mostrar el modal
    document.getElementById('overlay').style.display = 'flex';
    document.getElementById('successPopup').style.display = 'flex';

    // Configurar el botón de enviar del modal
    document.getElementById('enviarFormulario').addEventListener('click', function () {
      showAlert('Formulario enviado correctamente', 'success');
      document.querySelector('form').submit();
    });
    return;
  }

  // Navegar a la siguiente sección
  navigateToSection(currentSection + 1);
  showAlert('Sección completada correctamente', 'success');
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
}

// Update button text
sections.forEach((section, index) => {
  const button = section.querySelector('button');
  button.addEventListener('click', function (e) {
    e.preventDefault();

    // Validación existente...

    if (index === sections.length - 1) {
      const codigoAdmision = Math.floor(Math.random() * 9000000) + 1000000;
      document.getElementById('codigoAdmision').textContent = codigoAdmision;

      // Obtener el nombre del almacenamiento local o session storage
      const nombreEstudiante = sessionStorage.getItem('nombreEstudiante');
      document.getElementById('nombreCompleto').textContent = nombreEstudiante;

      // Mostrar el modal
      document.getElementById('overlay').style.display = 'flex';
      document.getElementById('successPopup').style.display = 'flex';

      // Manejar el envío del formulario
      document.getElementById('enviarFormulario').addEventListener('click', function () {
        showAlert('Formulario enviado correctamente', 'success');
        document.querySelector('form').submit();
      });
      return;
    }
  });

  // Handle button clicks with validation
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
          if (!/^\d{10}$/.test(field.value.trim())) {
            isValid = false;
            field.style.borderColor = 'red';
            errorMessages.push('El teléfono debe contener 10 dígitos numéricos');
          }
        }
      });

      if (hasEmptyFields) {
        errorMessages.unshift('Debe llenar los campos obligatorios');
      }

      if (!isValid) {
        const errorMessage = errorMessages.join('<br>');
        showAlert(errorMessage, 'danger');
        return;
      }

      // Mark this section as completed
      completedSections.add(index);

      // Handle last section (form submission)
      if (index === sections.length - 1) {
        showAlert('Formulario enviado correctamente', 'success');
        setTimeout(() => {
          document.querySelector('form').submit();
        }, 1000);
        return;
      }

      // Navigate to next section
      navigateToSection(currentSection + 1);
      showAlert('Sección completada correctamente', 'success');
    });
  });

  // Close popup when X is clicked
  document.getElementById('closePopup').addEventListener('click', function () {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('successPopup').style.display = 'none';
  });

  // Close popup when clicking outside
  document.getElementById('overlay').addEventListener('click', function (e) {
    if (e.target === this) {
      document.getElementById('overlay').style.display = 'none';
      document.getElementById('successPopup').style.display = 'none';
    }
  });


  // Reset border color when user starts typing
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


document.getElementById('nombre_padres').addEventListener('focus', function (e) {
  if (!this.closest('.section').classList.contains('active')) {
    e.preventDefault();
    this.blur();
  }
});