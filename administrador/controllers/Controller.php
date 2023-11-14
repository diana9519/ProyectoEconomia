<?php
require_once __DIR__ . '/../models/modeloGeneral.php';


class Controller {
    // Puedes agregar métodos para procesar formularios aquí

    private $modelo;

    public function __construct() {
        $this->modelo = new ModeloGeneral();
    }
    public function mostrarVista($vista) {
        switch ($vista) {
            case 'informacion':
                $detallesInstitucion = $this->modelo->obtenerInstituciones()[0]; 
                include 'views/informacion.php';
                break;

            case 'tasa':
                $tiposDeCreditos = $this->modelo->obtenerTiposDeCreditos();
                $detallesInstitucion = $this->modelo->obtenerInstituciones()[0]; 
                include 'views/tasa.php';
                break;

            default:
                // Vista por defecto o manejar errores
                break;
        }
    }


    public function guardarInformacion($datos) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
            $controller = new Controller();
        
            switch ($_POST['accion']) {
                case 'guardar_informacion':
                    // Llama a un método en el controlador para manejar la acción de guardar
                    $controller->guardarInformacion($_POST);
                    break;
                // Otros casos según sea necesario...
            }
        }
    }
    
    




}
?>
