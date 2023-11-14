<?php
include 'controllers/Controller.php';
$controller = new Controller();

if (isset($_GET['view'])) {
    $view = $_GET['view'];
    
    switch ($view) {
        case 'informacion':
            $controller->mostrarVista($view);
            break;
        case 'tasa':
            $controller->mostrarVista($view);
            break;

        default:
            $controller->mostrarVista($view);
            break;
    }
} else {
    // Aquí puedes mostrar una página de inicio o redirigir a la primera vista
}
?>

