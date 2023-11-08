class AppController {
    constructor(modelo, vista) {
      this.modelo = modelo;
      this.vista = vista;
      this.vista.botonCalcular.addEventListener('click', this.calcular.bind(this));
    }
  
    calcular() {
      const datosUsuario = this.vista.obtenerDatosUsuario();
      this.modelo.montoPrestamo = datosUsuario.montoPrestamo;
      this.modelo.tasaInteres = datosUsuario.tasaInteres;
      this.modelo.plazoPrestamo = datosUsuario.plazoPrestamo;
  
      const amortizacion = this.modelo.calcularAmortizacion();
      this.vista.mostrarResultados(amortizacion.cuotaMensual, amortizacion.totalPago, amortizacion.interesesTotales);
    }
  }
  