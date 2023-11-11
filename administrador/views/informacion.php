<!DOCTYPE html>
<html>
<head>
    <title>Información de la Institución</title>
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
</html>
