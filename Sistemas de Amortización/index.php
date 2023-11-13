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
        let interestRateInput;

        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('type');
            const amountInput = document.getElementById('amount');
            const amountSlider = document.getElementById('amountSlider');
            const periodInput = document.getElementById('period');
            const periodSlider = document.getElementById('periodSlider');
            let interestRateInput = document.getElementById('interestRate');

            interestRateInput.value = 0;

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



                    generarAmortizacion();
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

                    const selectedTipo = tiposCredito.find(tipo => tipo.id == typeSelect.value);
                    if (selectedTipo) {
                        interestRateInput.value = selectedTipo.tasa_interes_anual;
                    } else {
                        console.error("No se encontró el tipo de crédito seleccionado en la lista.");
                    }

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

            actualizarTablaTasas(selectedTipo.tasa_interes_anual);
        }

        // Nueva función para actualizar la tabla2
        function actualizarTablaTasas(tasaInteresAnual) {
            const tablaTasas = document.getElementById('tabla2');

            // Limpiar la tabla antes de agregar nuevas filas
            tablaTasas.innerHTML = '';
            agregarFilaTablaTasas('Concepto', '%', 'Explicación en términos utilizados');
            agregarFilaTablaTasas('Tasa Nominal', tasaInteresAnual.toFixed(2), 'Es la Tasa de Interés Anual');

            // Calcular la tasa de interés efectiva mensual
            const tasaEfectivaMensual = tasaInteresAnual / 12;

            // Agregar la fila con la tasa de interés efectiva mensual
            agregarFilaTablaTasas('Tasa Efectiva',tasaEfectivaMensual.toFixed(2), 'Es la Tasa de Interés de operación según el número de períodos de pago al año');

            // Función para agregar filas a la tabla2
            function agregarFilaTablaTasas(concepto, porcentaje, explicacion) {

                const fila = tablaTasas.insertRow();
                const celdaConcepto = fila.insertCell(0);
                const celdaPorcentaje = fila.insertCell(1);
                const celdaExplicacion = fila.insertCell(2);

                celdaConcepto.textContent = concepto;
                celdaPorcentaje.textContent = porcentaje;
                celdaExplicacion.textContent = explicacion;
            }
        }


        ////////////////////////////////////////////////////
        function calcularTotalIntereses() {
            const tablaAmortizacion = document.getElementById('tabla3');
            let totalIntereses = 0;

            for (let i = 1; i < tablaAmortizacion.rows.length; i++) {
                // El índice 2 representa la columna de intereses en tu tabla
                const interes = parseFloat(tablaAmortizacion.rows[i].cells[2].textContent);

                // Verifica si el valor es un número válido antes de sumarlo
                if (!isNaN(interes)) {
                    totalIntereses += interes;
                }
            }

            return totalIntereses;
        }

        function calcularSumaTotalCuotas() {
            const tablaAmortizacion = document.getElementById('tabla3');
            let sumaTotalCuotas = 0;

            for (let i = 1; i < tablaAmortizacion.rows.length; i++) {
                // El índice 4 representa la columna de cuota total en tu tabla
                const cuotaTotal = parseFloat(tablaAmortizacion.rows[i].cells[3].textContent);

                // Verifica si el valor es un número válido antes de sumarlo
                if (!isNaN(cuotaTotal)) {
                    sumaTotalCuotas += cuotaTotal;
                }
            }

            return sumaTotalCuotas;
        }

        function calcularAmortizacionFrances() {
            limpiarTabla();
            const montoPrestamo = parseFloat(document.getElementById('amount').value);
            const selectedType = tiposCredito.find(tipo => tipo.id == document.getElementById('type').value);
            const tasaInteres = selectedType.tasa_interes_anual / 100;
            const plazoMeses = parseInt(document.getElementById('period').value);

            const tasaMensual = tasaInteres / 12;
            const cuotaMensual = (montoPrestamo * tasaMensual) / (1 - Math.pow(1 + tasaMensual, -plazoMeses));

            let saldoPendiente = montoPrestamo;

            // Limpiar la tabla antes de agregar nuevas filas
            limpiarTabla();

            // Agregar la fila con los valores iniciales
            agregarFilaTabla(0, 0, 0, 0, saldoPendiente);

            for (let cuota = 1; cuota <= plazoMeses; cuota++) {
                const interesMensual = saldoPendiente * tasaMensual;
                const abonoCapital = cuotaMensual - interesMensual;
                saldoPendiente -= abonoCapital;

                // Redondear valores para evitar problemas con decimales
                const abonoCapitalRedondeado = roundToTwo(abonoCapital);
                const interesMensualRedondeado = roundToTwo(interesMensual);
                const cuotaMensualRedondeada = roundToTwo(cuotaMensual);
                const saldoPendienteRedondeado = roundToTwo(saldoPendiente);

                // Agregar una fila a la tabla con los resultados
                agregarFilaTabla(cuota, abonoCapitalRedondeado, interesMensualRedondeado, cuotaMensualRedondeada, saldoPendienteRedondeado);
            }


            // Calcular totales
            const montoFinanciero = parseFloat(document.getElementById('amount').value);
            const totalIntereses = calcularTotalIntereses(); // Necesitarías implementar esta función
            const sumaTotalCuotas = calcularSumaTotalCuotas(); // Necesitarías implementar esta función

            // Actualizar los totales en la tabla
            document.getElementById('montoFinanciero').textContent = montoFinanciero.toFixed(2);
            document.getElementById('totalIntereses').textContent = totalIntereses.toFixed(2);
            document.getElementById('sumaTotalCuotas').textContent = sumaTotalCuotas.toFixed(2);
        }

        // Función para redondear valores a dos decimales
        function roundToTwo(num) {
            return +(Math.round(num + "e+2") + "e-2");
        }




        function calcularAmortizacionAleman() {
            limpiarTabla();
            const montoPrestamo = parseFloat(document.getElementById('amount').value);
            const selectedType = tiposCredito.find(tipo => tipo.id == document.getElementById('type').value);
            const tasaInteres = selectedType.tasa_interes_anual / 100;
            const plazoMeses = parseInt(document.getElementById('period').value);

            const tasaMensual = tasaInteres / 12;
            const abonoCapital = montoPrestamo / plazoMeses;

            let saldoPendiente = montoPrestamo;


            agregarFilaTabla(0, 0, 0, 0, saldoPendiente);

            for (let cuota = 1; cuota <= plazoMeses; cuota++) {
                const interesMensual = saldoPendiente * tasaMensual;
                saldoPendiente -= abonoCapital;

                // Agregar una fila a la tabla con los resultados
                agregarFilaTabla(cuota, abonoCapital, interesMensual, abonoCapital + interesMensual, saldoPendiente);
            }
        }

        function generarAmortizacion() {
            const montoInput = document.getElementById('amount');
            const periodoInput = document.getElementById('period');
            const monto = parseFloat(montoInput.value);
            const periodo = parseInt(periodoInput.value);
            const selectedType = tiposCredito.find(tipo => tipo.id == document.getElementById('type').value);

            if (isNaN(monto) || monto < parseFloat(selectedType.monto_minimo) || monto > parseFloat(selectedType.monto_maximo)) {
                alert('El monto ingresado no es válido. Debe estar dentro del rango permitido.');
                montoInput.value = selectedType.monto_minimo;
                return;
            }

            if (isNaN(periodo) || periodo < 1 || periodo > parseInt(selectedType.plazo_maximo_meses)) {
                alert('El período ingresado no es válido. Debe estar dentro del rango permitido.');
                periodoInput.value = 1;
                return;
            }

            const sistemaAmortizacion = document.getElementById('system').value;

            if (sistemaAmortizacion === 'french') {
                calcularAmortizacionFrances();
            } else if (sistemaAmortizacion === 'aleman') {
                calcularAmortizacionAleman();
            }
        }


        function limpiarTabla() {
            const tablaAmortizacion = document.getElementById('tabla3');
            tablaAmortizacion.innerHTML = '';
            agregarFilaTabla('Cuota N°', 'Abono Capital', 'Interés', 'Cuota', 'Saldo');
        }

        function agregarFilaTabla(cuota, abonoCapital, interes, cuotaTotal, saldo) {

            const tablaAmortizacion = document.getElementById('tabla3');
            const fila = tablaAmortizacion.insertRow();
            const celdaCuota = fila.insertCell(0);
            const celdaAbonoCapital = fila.insertCell(1);
            const celdaInteres = fila.insertCell(2);
            const celdaCuotaTotal = fila.insertCell(3);
            const celdaSaldo = fila.insertCell(4);

            // Verificar si es un encabezado
            const esEncabezado = cuota === 'Cuota N°' && abonoCapital === 'Abono Capital' && interes === 'Interés' && cuotaTotal === 'Cuota' && saldo === 'Saldo';

            // Si es un encabezado, usar los valores directamente, de lo contrario, realizar conversiones
            celdaCuota.innerHTML = esEncabezado ? cuota : parseFloat(cuota).toFixed(0);
            celdaAbonoCapital.innerHTML = esEncabezado ? abonoCapital : formatNumber(abonoCapital, 2);
            celdaInteres.innerHTML = esEncabezado ? interes : formatNumber(interes, 2);
            celdaCuotaTotal.innerHTML = esEncabezado ? cuotaTotal : formatNumber(cuotaTotal, 2);
            celdaSaldo.innerHTML = esEncabezado ? saldo : formatNumber(saldo, 2);
        }

        function formatNumber(number, decimalPlaces) {
            if (isNaN(number)) {
                return '0.00';
            }
            return parseFloat(number).toFixed(decimalPlaces);
        }


        const tasaInteresXHR = new XMLHttpRequest();

        tasaInteresXHR.onreadystatechange = function() {
            if (tasaInteresXHR.readyState === 4) {
                if (tasaInteresXHR.status === 200) {
                    try {
                        const response = JSON.parse(tasaInteresXHR.responseText);
                        if (Array.isArray(response) && response.length > 0 && 'tasa_interes_anual' in response[0]) {
                            const tasaInteresAnual = response[0].tasa_interes_anual;
                            console.log('interestRateInput:', interestRateInput);
                            interestRateInput.value = tasaInteresAnual;
                        } else {
                            console.error("Error: Propiedad 'tasa_interes_anual' no encontrada en la respuesta JSON:", response);
                        }
                    } catch (error) {
                        console.error("Error al analizar la respuesta JSON de la tasa de interés:", error);
                    }
                } else {
                    console.error("Error en la solicitud de la tasa de interés. Código de estado:", tasaInteresXHR.status);
                }
            }
        };

        tasaInteresXHR.open('GET', 'controllers/getTiposCredito.php', true);
        tasaInteresXHR.send();
    </script>

</head>

<body>

    <form id="myForm">
        <label for="type">¿Qué tipo de crédito esta buscando?</label>
        <select id="type" name="type">
            <option value="french">Seleccionar un elemento</option>
        </select>

        <label for="interestRate">Tasa de interés anual (%)</label>
        <input type="number" id="interestRate" name="interestRate" disabled>

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

        <button type="button" id="botonGenerar" onclick="generarAmortizacion()">Generar</button>
        <button type=" reset">Limpiar</button>

        <table id="tabla1" class="tabla">
            <caption id="tituloTabla">Detalle de carga financiera</caption>
            <tr>
                <th>Concepto</th>
                <th>USD$</th>
                <th>Explicación en términos utilizados</th>
            </tr>
            <tr>
                <td>Monto Financiero</td>
                <td id="montoFinanciero">0.00</td>
                <td>Es el monto del crédito otorgado</td>
            </tr>
            <tr>
                <td>Intereses</td>
                <td id="totalIntereses">0.00</td>
                <td>Equivale a la suma de intereses que paga el socio durante la vigencia del crédito</td>
            </tr>
            <tr>
                <td>Suma total de cuotas</td>
                <td id="sumaTotalCuotas">0.00</td>
                <td>Equivale a la suma de las cuotas que paga el socio durante la vigencia del crédito</td>
            </tr>
        </table>

        <table id="tabla2" class="tabla">
            <caption id="tituloTabla2">Tasa de interés</caption>
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
            <caption id="tituloTabla3">Tabla de amortización</caption>
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