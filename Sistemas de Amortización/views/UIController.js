// UIController.js

class UIController {
  constructor() {
    this.botonGenerar = document.getElementById('botonGenerar');
    this.tipoCreditoSelect = document.getElementById('type');
    this.botonGenerar.addEventListener('click', () => this.calcular());
    this.init();
  }

  init() {
    // Hacer la solicitud al servidor para obtener los tipos de crédito
    fetch('getTiposCredito.php') // Nombre del archivo PHP que manejará la consulta a la base de datos
      .then(response => response.json())
      .then(data => this.mostrarTiposCredito(data));
  }

  mostrarTiposCredito(tiposCredito) {
    // Limpiar opciones actuales
    this.tipoCreditoSelect.innerHTML = '';

    // Agregar la opción predeterminada
    const optionDefault = document.createElement('option');
    optionDefault.value = 'seleccionar';
    optionDefault.textContent = 'Seleccionar un elemento';
    this.tipoCreditoSelect.appendChild(optionDefault);

    // Agregar opciones desde la base de datos
    tiposCredito.forEach(tipo => {
      const option = document.createElement('option');
      option.value = tipo.id; // Suponiendo que en tu base de datos tengas una columna 'id' y otra 'nombre'
      option.textContent = tipo.nombre;
      this.tipoCreditoSelect.appendChild(option);
    });
  }

  calcular() {
    // Funcionalidad para el botón Generar
    console.log('Función calcular ejecutada');
  }
}

const uiController = new UIController();
