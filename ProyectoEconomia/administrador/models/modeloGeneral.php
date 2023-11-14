<?php

require_once 'conexionDB.php';

class ModeloGeneral {
    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionDB();
    }

    public function obtenerInstituciones() {
        $query = "SELECT * FROM instituciones LIMIT 1";
        $resultado = $this->conexion->query($query);

        return $resultado->fetch_assoc();
    }

    public function guardarInformacion($id, $nombre, $logo, $direccion) {
        $id = htmlspecialchars($id);
        $nombre = htmlspecialchars($nombre);
        $direccion = htmlspecialchars($direccion);

        // Verificar si se proporcionó un nuevo logo
        if (!empty($logo['tmp_name'])) {
            // Procesar la imagen
            $imagenBinaria = file_get_contents($logo['tmp_name']);
        } else {
            // Mantener el logo existente si no se proporciona uno nuevo
            $detallesInstitucion = $this->obtenerInstituciones();
            $imagenBinaria = $detallesInstitucion['logo'];
        }

        // Utilizar una consulta preparada
        $query = "UPDATE instituciones SET nombre=?, logo=?, direccion=? WHERE id=?";
        $stmt = $this->conexion->prepare($query);

        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param("sssi", $nombre, $imagenBinaria, $direccion, $id);

            // Ejecutar la consulta
            $result = $stmt->execute();

            // Cerrar la consulta preparada
            $stmt->close();

            return $result;
        } else {
            // Manejar el error según tu lógica
            return false;
        }
        
    }
    
    public function obtenerNombresTiposDeCreditos() {
        $query = "SELECT nombre FROM tipos_de_creditos";
        $resultado = $this->conexion->query($query);

        $tiposDeCreditos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $tiposDeCreditos[] = $fila;
        }

        return $tiposDeCreditos;
    }
}
?>
