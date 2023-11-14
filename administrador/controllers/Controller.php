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
                include 'views/tasa.php';
                break;

            default:
                // Vista por defecto o manejar errores
                break;
        }
    }
    




}
?>
