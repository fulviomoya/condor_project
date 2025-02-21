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
  // Add popup HTML to the document

  const form = document.getElementById("form")
  const sections = [
    document.querySelector('.first_section'),
    document.querySelector('.second_section'),
    document.querySelector('.third_section'),
    document.querySelector('.fourth_section')
  ];

  const numbers = document.querySelectorAll('.circulos .num');
  const lines = document.querySelectorAll('.circulos .line');
  let currentSection = 0;

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

      // Si es la última sección y todos los campos son válidos, mostrar el popup
      if (index === sections.length - 1) {
        // reenviar 
        window.location.href = "Form2.php";
        return;
      }

      // Si no es la última sección, continuar con la navegación normal
      sections[currentSection].classList.remove('active');
      if (currentSection < numbers.length - 1) {
        numbers[currentSection + 1].classList.add('active');
        if (lines[currentSection]) {
          lines[currentSection].classList.add('active');
        }
      }

      currentSection++;
      sections[currentSection].classList.add('active');
      showAlert('Sección completada correctamente', 'success');
    });
  });

  
  // Reset border color when user starts typing
  document.querySelectorAll('input[required], select[required]').forEach(input => {
    input.addEventListener('input', function () {
      this.style.borderColor = '#BABABA';
    });
  });
});
document.addEventListener('DOMContentLoaded', function () {
  const sections = document.querySelectorAll('.section');
  const numbers = document.querySelectorAll('.circulos .num');
  const lines = document.querySelectorAll('.circulos .line');
  let currentSection = 0;
  let completedSections = new Set([0]); // Track completed sections, starting with first section

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
  }

  // Modify your existing button click handlers
  sections.forEach((section, index) => {
    const button = section.querySelector('button');
    button.addEventListener('click', function (e) {
      e.preventDefault();

      const requiredFields = section.querySelectorAll('input[required], select[required]');
      let isValid = true;
      let hasEmptyFields = false;
      let errorMessages = [];

      // Your existing validation code...
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
        } else if (field.id === 'correo_electronico') {
          const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
          if (!emailPattern.test(field.value.trim())) {
            isValid = false;
            field.style.borderColor = 'red';
            errorMessages.push('Por favor, introduce un correo electrónico válido');
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

      completedSections.add(index);

      // Si es la última sección y todos los campos son válidos
      // if (index === sections.length - 1) {
      //   const nombre = document.getElementById('nombre').value || '';
      //   const apellido = document.getElementById('apellido').value || '';
      //   const segundoApellido = document.getElementById('segundo_apellido').value || '';
      //   const nombreCompleto = `${nombre} ${apellido} ${segundoApellido}`.trim();
      //   const codigoAdmision = Math.floor(Math.random() * 9000000) + 1000000;

      //   document.getElementById('nombreCompleto').textContent = nombreCompleto;
      //   document.getElementById('codigoAdmision').textContent = codigoAdmision;

      //   // Mostrar el popup
      //   document.getElementById('overlay').style.display = 'flex';
      //   document.getElementById('successPopup').style.display = 'flex';

      //   // Agregar event listener para el botón de enviar
      //   document.getElementById('enviarFormulario').addEventListener('click', function () {
      //     showAlert('Formulario enviado correctamente', 'success');
      //     form.submit();
      //   });

      //   return;
      // }


      // Navigate to next section
      navigateToSection(currentSection + 1);
      showAlert('Sección completada correctamente', 'success');
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

function toggleOtraNacionalidad() {
  const nacionalidadSelect = document.getElementById('nacionalidad_select');
  const otraNacionalidad = document.getElementById('otra_nacionalidad');

  if (nacionalidadSelect.value === 'otro') {
    otraNacionalidad.style.display = 'block';
    otraNacionalidad.disabled = false;
  } else {
    otraNacionalidad.style.display = 'none';
    otraNacionalidad.disabled = true;
  }
}
