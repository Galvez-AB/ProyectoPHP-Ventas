<?php
class ControlPanel {
    public function cargarPanel() {
        
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formPanelUsuario.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
        
        $modeloPlatos = new Eplatos();
        $platos = $modeloPlatos->obtenerPlatosActivos(); 
        
        $formPanel = new formPanelUsuario();
        $formPanel->formPanelCabecera(); 
        $formPanel->formPanelMenu($platos);
    }
    public function ejecutarAccion() {
        if (isset($_POST['accion']) && $_POST['accion'] == 'iniciarSesion') {
                include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formAutenticarUsuario.php');   
                $objFormAutenticar = new formAutenticarUsuario();
                $objFormAutenticar -> formAutenticarUsuarioShow();
        } else {
            
        }
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador = new ControlPanel();
    $controlador->ejecutarAccion();
} 
?>