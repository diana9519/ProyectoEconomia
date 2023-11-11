<?php
class Controller {
    public function mostrarInformacion() {
        include 'views/informacion.php';
    }
    
    public function mostrarTasa() {
        include 'views/tasa.php';
    }
    
    public function mostrarSeguroDonacion() {
        include 'views/seguro_donacion.php';
    }
    
    // Puedes agregar métodos para procesar formularios aquí
}
?>
