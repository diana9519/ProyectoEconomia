
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const amountInput = document.getElementById('amount');
    const amountSlider = document.getElementById('amountSlider');

    let tiposCredito;

    const xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            tiposCredito = JSON.parse(xhr.responseText);

            tiposCredito.forEach(function (tipo) {
                const option = document.createElement('option');
                option.value = tipo.id;
                option.textContent = tipo.nombre;
                typeSelect.appendChild(option);
            });

            // Configurar los valores mínimo y máximo para el campo amount y el slider
            updateAmountLimits();

            // Mostrar el valor mínimo por defecto
            amountInput.value = amountInput.min;
            amountSlider.value = amountInput.min;
        }
    };

    xhr.open('GET', 'controllers/getTiposCredito.php', true);
    xhr.send();

    // Agregar un evento de cambio al campo type para actualizar los límites
    typeSelect.addEventListener('change', updateAmountLimits);

    // Agregar un evento de cambio al slider para actualizar el campo amount
    amountSlider.addEventListener('input', function () {
        amountInput.value = amountSlider.value;
    });
});

// Función para actualizar los límites del campo amount y el slider
function updateAmountLimits() {
    const typeSelect = document.getElementById('type');
    const amountInput = document.getElementById('amount');
    const amountSlider = document.getElementById('amountSlider');

    const selectedTipo = tiposCredito.find(tipo => tipo.id == typeSelect.value);
    amountInput.min = selectedTipo.monto_minimo;
    amountInput.max = selectedTipo.monto_maximo;
    amountSlider.min = selectedTipo.monto_minimo;
    amountSlider.max = selectedTipo.monto_maximo;
    amountSlider.value = selectedTipo.monto_minimo; // Establecer el valor inicial al mínimo
    amountSlider.step = (selectedTipo.monto_maximo - selectedTipo.monto_minimo) / 100;
}

