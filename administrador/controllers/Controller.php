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
                $detallesInstitucion = $this->modelo->obtenerInstituciones(); 
                include 'views/informacion.php';
                break;

            case 'tasa':
                $tiposDeCreditos = $this->modelo->obtenerTiposDeCreditos();
                $detallesInstitucion = $this->modelo->obtenerInstituciones(); 
                include 'views/tasa.php';
                break;

            default:
                // Vista por defecto o manejar errores
                break;
        }
    }

    public function procesarFormulario($datos) {
        if (isset($datos['accion']) && $datos['accion'] === 'guardar_informacion') {
            $id = $datos['id'];
            $nombre = $datos['nombre'];
            $logo = isset($datos['logo']) ? $datos['logo'] : null; // Cambiado para manejar el archivo de imagen
            $direccion = $datos['direccion'];
    
            $this->modelo->guardarInformacion($id, $nombre, $logo, $direccion);
        }
    }
    
       

}
?>
