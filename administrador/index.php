<?php
include 'controllers/Controller.php';
$controller = new Controller();

if (isset($_GET['view'])) {
    $view = $_GET['view'];
    
    switch ($views) {
        case 'informacion':
            $controller->mostrarInformacion();
            break;
        case 'tasa':
            $controller->mostrarTasa();
            break;
        case 'seguro_donacion':
            $controller->mostrarSeguroDonacion();
            break;
        default:
            echo "Vista no encontrada";
            break;
    }
} else {
    // Aquí puedes mostrar una página de inicio o redirigir a la primera vista
}
?>
