<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "proyectoeconomia";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "Conexión exitosa";