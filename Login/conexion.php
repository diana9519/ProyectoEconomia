<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "proyectoeconomia";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$conn)
{
	die("No hay conexion:".mysqli_connect_error());
}
?>