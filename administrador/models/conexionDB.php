<?php

class ConexionDB {
    private $mysqli;
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
    public function getConexion() {
        return $this->mysqli;
    }
    public function escape_string($string) {
        return $this->mysqli->real_escape_string($string);
    }
    public function prepare($query) {
        return $this->conexion->prepare($query);
    }
}
?>
