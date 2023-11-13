<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de la Institución</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Información de la Institución</h1>
    <form action="guardar_informacion.php" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre de la Institución:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="logo">Logo:</label>
        <input type="file" id="logo" name="logo" accept="image/*">
        
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