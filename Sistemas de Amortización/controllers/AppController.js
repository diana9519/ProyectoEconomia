class AppController {
  constructor(modelo, vista) {
    this.modelo = modelo;
    this.vista = vista;
    this.vista.botonGenerar.addEventListener('click', this.calcular.bind(this));

    // Ocultar la tabla al cargar la página
    const tabla1 = document.getElementById('tabla1');
    tabla1.style.display = 'none';
  }

  calcular() {
    const monto = parseFloat(document.getElementById('amount').value);
    const plazo = parseInt(document.getElementById('period').value);
    const sistemaAmortizacion = document.getElementById('system').value;

    const tabla1HTML = LoanModel.calcularTabla1(monto, plazo, sistemaAmortizacion);
    const tabla2HTML = AmortizationSchedule.calcularTabla2(monto, plazo, sistemaAmortizacion);
    const tabla3HTML = this.modelo.calcularTabla3(monto, plazo, sistemaAmortizacion);

    // Mostrar la tabla al hacer clic en el botón "Generar"
    const tabla1 = document.getElementById('tabla1');
    tabla1.innerHTML = tabla1HTML;
    tabla1.style.display = 'block'; // Mostrar la tabla

    // Agregar el contenido a las otras tablas y mostrarlas de manera similar
    document.getElementById('tabla2').innerHTML = tabla2HTML;
    document.getElementById('tabla3').innerHTML = tabla3HTML;
  }
}
