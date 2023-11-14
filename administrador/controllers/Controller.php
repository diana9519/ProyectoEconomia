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
            case 'seguro_donacion':
                $cobrosIndirectos = $this->modelo->obtenerCobrosIndirectos();
                include 'views/seguro_donacion.php';
                break;

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
    // Agrega este método al final de tu controlador
    public function actualizarInformacionInstitucion($nombre, $direccion) {
        // Supongamos que no necesitas proporcionar el ID porque solo hay una institución
        // Puedes adaptar según tu necesidad
        $idInstitucion = 1;  // Modifica esto según tu situación

        // Llama al método para actualizar la información de la institución
        $actualizado = $this->modelo->actualizarInstitucion($idInstitucion, $nombre, $direccion);

        // Verifica si la actualización fue exitosa
        if ($actualizado) {
            echo "Información actualizada correctamente.";
        } else {
            echo "Hubo un error al actualizar la información.";
        }
    }





}
?>
