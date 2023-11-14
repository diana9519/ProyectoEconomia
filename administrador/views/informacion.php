<?php
$currentView = isset($_GET['view']) ? $_GET['view'] : '';
// Agrega esto al inicio de tu archivo index.php o donde procesas las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $controller = new Controller();

    switch ($_POST['accion']) {
        case 'actualizar_informacion':
            // Verifica que los campos necesarios estén presentes en el formulario
            if (isset($_POST['nombre']) && isset($_POST['direccion'])) {
                $nombre = $_POST['nombre'];
                $direccion = $_POST['direccion'];
                $controller->actualizarInformacionInstitucion($nombre, $direccion);
            } else {
                echo "Error: Campos de formulario faltantes.";
            }
            break;

        // Otros casos según sea necesario

        default:
            // Manejar otros casos o mostrar un error
            break;
    }
}

// Resto de tu código...

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de la Institución</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin:0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif; 

        }

        h1 {
            text-align: center;
            padding: 20px;
            background-color: #071841;
            color: #fff;
            margin: 0;
        }

        #menu {
            background-color: #071841;
            padding: 10px;
            text-align: right;
        }

        #menu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        #menu li {
            display: inline;
            margin-right: 10px;
        }

        #menu a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        #menu li.current a {
            color: #fff;
            background-color: #333;
            padding: 8px 12px;
            border-radius: 5px;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
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
<div id="menu">
        <ul>
            <li <?php echo ($currentView === 'informacion') ? 'class="current"' : ''; ?>>
                <a href="index.php?view=informacion">Información de la Institución</a>
            </li>
            <li <?php echo ($currentView === 'tasa') ? 'class="current"' : ''; ?>>
                <a href="index.php?view=tasa">Tasa de Crédito</a>
            </li>
            <li <?php echo ($currentView === 'seguro_donacion') ? 'class="current"' : ''; ?>>
                <a href="index.php?view=seguro_donacion">Seguro y Donaciones</a>
            </li>
            <li <?php echo ($currentView === 'cerrar_sesion') ? 'class="current"' : ''; ?>>
                <a href="index.php?view=cerrar_sesion">Cerrar Sesión</a>
            </li>
        </ul>
    </div>
  
    <h1>Información de la Institución</h1>
    <form action="p" method="post" enctype="multipart/form-data">
        <label for="nombre">Nombre de la Institución:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $detallesInstitucion['nombre']; ?>" required>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $detallesInstitucion['direccion']; ?>" required>
        
        <label for="logo">Logo:</label>
        <!-- Mostrar la imagen actual -->
        <img src="<?php echo $detallesInstitucion['logo']; ?>" alt="Logo Actual">
        
        <!-- Permitir la carga de un nuevo logo si es necesario -->
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