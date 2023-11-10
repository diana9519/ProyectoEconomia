<?php

include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistemas de Amortización</title>
    <link rel="stylesheet" href="styles.css">
    <script src="models/LoanModel.js"></script>
    <script src="views/UIController.js"></script>
    <h1>Sistemas de Amortización</h1>
    <script>
        // Declarar tiposCredito en el ámbito global
        let tiposCredito;

        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const amountInput = document.getElementById('amount');
            const amountSlider = document.getElementById('amountSlider');
            const periodInput = document.getElementById('period');
            const periodSlider = document.getElementById('periodSlider');

            const xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    tiposCredito = JSON.parse(xhr.responseText);

                    tiposCredito.forEach(function(tipo) {
                        const option = document.createElement('option');
                        option.value = tipo.id;
                        option.textContent = tipo.nombre;
                        typeSelect.appendChild(option);
                    });

                    // Configurar los valores mínimo y máximo para el campo amount y el slider
                    updateAmountLimits();

                    // Configurar los valores mínimo y máximo para el campo período y el slider del período
                    updatePeriodLimits();

                    // Mostrar el valor mínimo por defecto para amount y período
                    amountInput.value = amountInput.min;
                    amountSlider.value = amountInput.min;
                    periodInput.value = periodInput.min;
                    periodSlider.value = periodInput.min;
                }
            };

            xhr.open('GET', 'controllers/getTiposCredito.php', true);
            xhr.send();

            // Agregar un evento de cambio al campo type para actualizar los límites de amount y período
            typeSelect.addEventListener('change', function() {
                if (tiposCredito) {
                    updateAmountLimits();
                    updatePeriodLimits();
                    amountInput.value = amountInput.min;
                    amountSlider.value = amountInput.min;
                    periodInput.value = periodInput.min;
                    periodSlider.value = periodInput.min;
                }
            });

            // Agregar un evento de cambio al slider de amount para actualizar el campo amount
            amountSlider.addEventListener('input', function() {
                amountInput.value = amountSlider.value;
            });

            // Agregar un evento de cambio al slider del período para actualizar el campo período
            periodSlider.addEventListener('input', function() {
                periodInput.value = periodSlider.value;
            });
        });

        // Función para actualizar los límites del campo amount y el slider
        function updateAmountLimits() {
            const typeSelect = document.getElementById('type');
            const amountInput = document.getElementById('amount');
            const amountSlider = document.getElementById('amountSlider');

            const selectedTipo = tiposCredito.find(tipo => tipo.id == typeSelect.value);

            amountInput.min = parseFloat(selectedTipo.monto_minimo);
            amountInput.max = parseFloat(selectedTipo.monto_maximo);
            amountSlider.min = parseFloat(selectedTipo.monto_minimo);
            amountSlider.max = parseFloat(selectedTipo.monto_maximo);
            amountSlider.value = parseFloat(selectedTipo.monto_minimo); // Establecer el valor inicial al mínimo
            amountSlider.step = (parseFloat(selectedTipo.monto_maximo) - parseFloat(selectedTipo.monto_minimo)) / 100;
        }

        // Función para actualizar los límites del campo período y el slider del período
        function updatePeriodLimits() {
            const typeSelect = document.getElementById('type');
            const periodInput = document.getElementById('period');
            const periodSlider = document.getElementById('periodSlider');

            const selectedTipo = tiposCredito.find(tipo => tipo.id == typeSelect.value);

            periodInput.min = 1;
            periodInput.max = selectedTipo.plazo_maximo_meses;
            periodSlider.min = 1;
            periodSlider.max = selectedTipo.plazo_maximo_meses;
            periodSlider.value = 1; // Establecer el valor inicial a 1
            periodSlider.step = 1;
        }
    </script>

</head>

<body>

    <form id="myForm">
        <label for="type">¿Qué tipo de crédito esta buscando?</label>
        <select id="type" name="type">
            <option value="french">Seleccionar un elemento</option>
        </select>

        <label for="amount">Monto que dinero que necesita</label>
        <input type="number" id="amount" name="amount" required>

        <input type="range" id="amountSlider" name="amountSlider">

        <label for="period">¿En cuantos tiempo quiere pagarlo?</label>
        <input type="number" id="period" name="period" required>
        <input type="range" id="periodSlider" name="periodSlider">

        <label for="system">Sistema de amortización</label>
        <select id="system" name="system">
            <option value="french">FRANCÉS (CUOTA FIJA)</option>
            <option value="aleman">ALEMÁN (CUOTA VARIABLE)</option>
        </select>

        <button type="button" id="botonGenerar">Generar</button>
        <button type="reset">Limpiar</button>

        <table id="tabla1" class="tabla">
            <caption id="tituloTabla">Detalle de carga financiera</caption>
            <tr>
                <th>Concepto</th>
                <th>USD$</th>
                <th>Explicación en términos utilizados</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </table>
        <table id="tabla2" class="tabla">
            <caption id="tituloTabla">Tasa de interés</caption>
            <tr>
                <th>Concepto</th>
                <th>USD$</th>
                <th>Explicación en términos utilizados</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </table>
        <table id="tabla3" class="tabla">
            <caption id="tituloTabla">Tabla de amortización</caption>
            <tr>
                <th>Cueota N°</th>
                <th>Abono Capital</th>
                <th>Interés</th>
                <th>Seguro Desg.</th>
                <th>Cuota</th>
                <th>Saldo</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <!-- Contenido de la tercera tabla -->
        </table>

    </form>
    <script src="controllers/AppController.js" defer></script> <!-- Agregamos el atributo "defer" -->

</body>

<footer>
    <div class="footer-column">
        <h3>Servicio al Cliente</h3>
        <ul>
            <li><a href="#">Contacto</a></li>
            <li><a href="#">Preguntas Frecuentes</a></li>

        </ul>
    </div>
    <div class="footer-column">
        <h3>Nuestros Servicios</h3>
        <ul>
            <li><a href="#">Sistemas de Amortización</a></li>
        </ul>
    </div>
    <div class="footer-column">
        <h3>Contacto</h3>
        <p>Teléfono: 0985332957 - 0990592339</p>
        <p>Correo Electrónico: info@sistemasdeamortizacion.com</p>
    </div>
</footer>


</html>