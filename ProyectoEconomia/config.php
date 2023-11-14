<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "Diana12345";
$basededatos = "proyectoeconomia";

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basededatos);

// Verificar la conexión
if (!$conexion) {
    die("La conexión falló: " . mysqli_connect_error());
}
?>
