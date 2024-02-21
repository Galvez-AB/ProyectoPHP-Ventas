<?php    
    include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/controlPanelUsuario.php');   
    $controlPanel = new ControlPanel();
    $controlPanel->cargarPanel();
?>