<?php

require_once 'conexionDB.php';

class ModeloGeneral{
    private $conexion;

    public function __construct() {
        $this->conexion = new ConexionDB();
    }


    public function obtenerInstituciones() {
        $query = "SELECT * FROM instituciones";
        $resultado = $this->conexion->query($query);

        $instituciones = array();
        while ($fila = $resultado->fetch_assoc()) {
            $instituciones[] = $fila;
        }

        return $instituciones;
    }

    public function obtenerTiposDeCreditos() {
        $query = "SELECT * FROM tipos_de_creditos";
        $resultado = $this->conexion->query($query);

        $tiposDeCreditos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $tiposDeCreditos[] = $fila;
        }

        return $tiposDeCreditos;
    }

    // Métodos para la tabla 'instituciones'
    public function obtenerDetallesInstitucion1($id) {
        $id = $this->conexion->real_escape_string($id);
        $query = "SELECT * FROM instituciones WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
        return $resultado->fetch_assoc();
    }
    public function obtenerDetallesInstitucion($id) {
        $id = $this->conexion->real_escape_string($id);
        $query = "SELECT * FROM instituciones WHERE id = '$id'";
        $resultado = $this->conexion->query($query);
    
        if ($resultado) {
            $detalles = $resultado->fetch_assoc();
            return $detalles['logo'];  // Devuelve el contenido binario del logo
        } else {
            return null;  // Maneja el error según tu lógica
        }
    }
    public function guardarInformacion($datos) {
        // Obtener datos del formulario
        $id = $datos['id'];
        $nombre = $this->conexion->real_escape_string($datos['nombre']);
        $direccion = $this->conexion->real_escape_string($datos['direccion']);
        // Otros campos...

        // Validar y actualizar en la base de datos
        $query = "UPDATE instituciones SET nombre = '$nombre', direccion = '$direccion' WHERE id = '$id'";
        $resultado = $this->conexion->query($query);

        // Redirigir a la vista después de guardar
        header("Location: index.php?view=informacion");
        exit();
    }
    

    public function actualizarInstitucion($id, $nombre, $logo, $direccion, $telefono) {
        $id = $this->conexion->real_escape_string($id);
        $nombre = $this->conexion->real_escape_string($nombre);
        $logo = $this->conexion->real_escape_string($logo);
        $direccion = $this->conexion->real_escape_string($direccion);
        $telefono = $this->conexion->real_escape_string($telefono);

        $query = "UPDATE instituciones SET nombre='$nombre', logo='$logo', direccion='$direccion', telefono='$telefono' WHERE id='$id'";
        return $this->conexion->query($query);
    }

    // Métodos para la tabla 'tipos_de_creditos'
    public function insertarTipoCredito($nombre, $tasaInteresAnual, $plazoMaximoMeses, $montoMinimo, $montoMaximo) {
        $nombre = $this->conexion->real_escape_string($nombre);
        $tasaInteresAnual = $this->conexion->real_escape_string($tasaInteresAnual);
        $plazoMaximoMeses = $this->conexion->real_escape_string($plazoMaximoMeses);
        $montoMinimo = $this->conexion->real_escape_string($montoMinimo);
        $montoMaximo = $this->conexion->real_escape_string($montoMaximo);

        $query = "INSERT INTO tipos_de_creditos (nombre, tasa_interes_anual, plazo_maximo_meses, monto_minimo, monto_maximo) VALUES ('$nombre', '$tasaInteresAnual', '$plazoMaximoMeses', '$montoMinimo', '$montoMaximo')";
        return $this->conexion->query($query);
    }

    public function actualizarTipoCredito($id, $nombre, $tasaInteresAnual, $plazoMaximoMeses, $montoMinimo, $montoMaximo) {
        $id = $this->conexion->real_escape_string($id);
        $nombre = $this->conexion->real_escape_string($nombre);
        $tasaInteresAnual = $this->conexion->real_escape_string($tasaInteresAnual);
        $plazoMaximoMeses = $this->conexion->real_escape_string($plazoMaximoMeses);
        $montoMinimo = $this->conexion->real_escape_string($montoMinimo);
        $montoMaximo = $this->conexion->real_escape_string($montoMaximo);

        $query = "UPDATE tipos_de_creditos SET nombre='$nombre', tasa_interes_anual='$tasaInteresAnual', plazo_maximo_meses='$plazoMaximoMeses', monto_minimo='$montoMinimo', monto_maximo='$montoMaximo' WHERE id='$id'";
        return $this->conexion->query($query);
    }

    public function eliminarTipoCredito($id) {
        $id = $this->conexion->real_escape_string($id);

        $query = "DELETE FROM tipos_de_creditos WHERE id='$id'";
        return $this->conexion->query($query);
    }
}

?>
