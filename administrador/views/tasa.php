<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasa de Crédito</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>Tasa de Crédito</h1>
    <form action="guardar_tasa.php" method="post">
        <label for="tasa">Nombre del Crédito:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="tasa">Porcentaje Crédito(%):</label>
        <input type="number" id="tasa" name="tasa" step="0.01" required>
        <input type="submit" value="Guardar">
    </form>
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