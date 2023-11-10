<?php
include '../config.php';

// Consulta SQL
$sql = "SELECT id, nombre, monto_minimo, monto_maximo, plazo_maximo_meses FROM tipos_de_creditos";
$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result) {
    $tiposCredito = array();

    // Obtener datos y almacenarlos en un array
    while ($row = $result->fetch_assoc()) {
        $tiposCredito[] = $row;
    }

    // Enviar datos como respuesta en formato JSON
    echo json_encode($tiposCredito);
} else {
    echo 'Error en la consulta SQL: ' . $conexion->error;
}
?>
