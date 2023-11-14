document.addEventListener('DOMContentLoaded', function () {
  // Ocultar todas las tablas y títulos al cargar la página
  const elementosOcultos = document.querySelectorAll('.tabla, [id^="tituloTabla"]');
  elementosOcultos.forEach(elemento => {
    elemento.style.display = 'none';
  });

  // Asignar evento al botón "Generar"
  const botonGenerar = document.getElementById('botonGenerar');
  botonGenerar.addEventListener('click', function (event) {
    event.preventDefault(); // Evitar que el formulario se envíe y recargue la página

    // Mostrar todas las tablas y títulos al hacer clic en el botón "Generar"
    const elementosMostrados = document.querySelectorAll('.tabla, [id^="tituloTabla"]');
    elementosMostrados.forEach(elemento => {
      elemento.style.display = 'block';
    });

  });
});
