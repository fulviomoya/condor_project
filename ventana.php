<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        /* Estilos para el enlace de ejemplo */
        .ejemplo {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .ejemplo:hover {
            color: #1d4ed8;
        }

        .ejemplo::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #2563eb;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .ejemplo:hover::after {
            transform: scaleX(1);
        }

        /* Estilos del Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            transition: background-color 0.3s ease;
            backdrop-filter: blur(0);
            transition: backdrop-filter 0.3s ease;
        }

        .modal.show {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 2rem;
            width: 90%;
            max-width: 600px;
            border-radius: 1rem;
            position: relative;
            transform: scale(0.7) translateY(-100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .modal.show .modal-content {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .modal-header h2 {
            margin: 0;
            color: #1f2937;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .close-button {
            position: absolute;
            right: 1.5rem;
            top: 1.5rem;
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            border: none;
            background-color: #f3f4f6;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .close-button:hover {
            background-color: #e5e7eb;
            transform: rotate(90deg);
        }

        .close-button::before,
        .close-button::after {
            content: '';
            position: absolute;
            width: 1rem;
            height: 2px;
            background-color: #4b5563;
            transition: background-color 0.2s ease;
        }

        .close-button::before {
            transform: rotate(45deg);
        }

        .close-button::after {
            transform: rotate(-45deg);
        }

        .close-button:hover::before,
        .close-button:hover::after {
            background-color: #1f2937;
        }

        .modal-body {
            position: relative;
            padding: 1rem 0;
        }

        .modal-body img {
            width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .modal-body img:hover {
            transform: scale(1.02);
        }

        @media (max-width: 640px) {
            .modal-content {
                margin: 10% auto;
                width: 95%;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- En tu formulario, donde va el enlace de ejemplo -->
    <span class="field-name">Acta de Nacimiento:</span>
    <span class="field-description">
        Adjuntar un documento o foto del acta de nacimiento del estudiante. 
        <span class="ejemplo" onclick="openModal()">Ejemplo</span>
    </span>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Ejemplo de Acta de Nacimiento</h2>
                <button class="close-button" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <img src="Parte_Administrativa/IMG/ejemplo_acta.png" alt="Ejemplo de Acta de Nacimiento">
            </div>
        </div>
    </div>

    <script>
        // Funciones del Modal
        function openModal() {
            const modal = document.getElementById('myModal');
            modal.style.display = 'block';
            // Forzar un reflow para que la transición funcione
            modal.offsetHeight;
            modal.classList.add('show');
        }

        function closeModal() {
            const modal = document.getElementById('myModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); // Tiempo igual a la duración de la transición
        }

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            const modal = document.getElementById('myModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Cerrar con tecla Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>
</html>