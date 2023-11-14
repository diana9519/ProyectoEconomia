<?php

class ConexionDB {
    private $host = "localhost";
    private $usuario = "root";
    private $contrasena = "";
    private $nombreBD = "proyectoeconomia";

    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->contrasena, $this->nombreBD);

        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public function query($sql) {
        return $this->conexion->query($sql);
    }
}
?>
