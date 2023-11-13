<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguro y Donaciones</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #071841;
            color: #fff;
            margin: 0;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            text-align: center;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        footer {
            background-color: #365b77;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .footer-column {
            width: 30%;
            text-align: left;
            padding: 10px;
        }

        .footer-column h3 {
            font-size: 18px;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column li {
            margin: 5px 0;
        }

        .footer-column a {
            color: #fff;
            text-decoration: none;
        }

        footer p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <h1>Seguro y Donaciones</h1>
    <form action="guardar_seguro_donacion.php" method="post">
        <div>
            <label for="seguro">Seguro:</label>
            <input type="text" id="seguro" name="seguro" required>
        </div>
        <div>
            <label for="donacion">Donación:</label>
            <input type="text" id="donacion" name="donacion" required>
        </div>
        <input type="submit" value="Guardar">
    </form>

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
</body>

</html>
