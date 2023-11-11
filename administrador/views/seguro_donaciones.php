<!DOCTYPE html>
<html>
<head>
    <title>Seguro y Donaciones</title>
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
</body>
</html>
