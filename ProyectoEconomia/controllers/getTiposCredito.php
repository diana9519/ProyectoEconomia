<?php
include '../config.php';

// Consulta SQL
$sql = "SELECT id, nombre, monto_minimo, monto_maximo, plazo_maximo_meses, tasa_interes_anual FROM tipos_de_creditos";
$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result) {
    $tiposCredito = array();

    // Obtener datos y almacenarlos en un array
    while ($row = $result->fetch_assoc()) {
        // Asegúrate de que la propiedad 'tasa_interes_anual' está presente y es un número
        if (isset($row['tasa_interes_anual'])) {
            $row['tasa_interes_anual'] = floatval($row['tasa_interes_anual']); // Convertir a número
        } else {
            // Si 'tasa_interes_anual' no está presente, establecerlo como null o algún valor predeterminado según sea necesario
            $row['tasa_interes_anual'] = null;
        }
        $tiposCredito[] = $row;
    }

    // Enviar datos como respuesta en formato JSON
    echo json_encode($tiposCredito);
} else {
    echo 'Error en la consulta SQL: ' . $conexion->error;
}
?>
