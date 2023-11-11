<!DOCTYPE html>
<html>
<head>
    <title>Tasa de Crédito</title>
</head>
<body>
    <h1>Tasa de Crédito</h1>
    <form action="guardar_tasa.php" method="post">
        <label for="tasa">Tasa de Crédito (%):</label>
        <input type="number" id="tasa" name="tasa" step="0.01" required>
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
