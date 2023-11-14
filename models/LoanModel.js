class LoanModel {
  constructor() {
    this.montoPrestamo = 0;
    this.tasaInteres = 0;
    this.plazoPrestamo = 0;
  }

  calcularTabla1(monto, plazo, sistemaAmortizacion) {
    // Implementa la lógica para calcular y generar el contenido de la tabla 1
    let tabla1HTML = '<table>';
    // Agrega filas y celdas a la tabla1HTML según tus cálculos
    // Ejemplo: tabla1HTML += '<tr><td>Cuota 1</td><td>Interés 1</td><td>Capital 1</td></tr>';
    tabla1HTML += '</table>';
    return tabla1HTML;
  }

  calcularTabla3(monto, plazo, sistemaAmortizacion) {
    // Implementa la lógica para calcular y generar el contenido de la tabla 3
    let tabla3HTML = '<table>';
    // Agrega filas y celdas a la tabla3HTML según tus cálculos
    // Ejemplo: tabla3HTML += '<tr><td>Cuota 1</td><td>Interés 1</td><td>Capital 1</td></tr>';
    tabla3HTML += '</table>';
    return tabla3HTML;
  }
}
