<?php
  session_start(); 

    $_SESSION['carrito'] = array();

    include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formPanelCliente.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
    $modeloPlatos = new Eplatos();
    $platos = $modeloPlatos->obtenerPlatosActivos(); 
    $formInicio=new formPanelCliente();
    
    if (isset($_SESSION['nombreUsuario'])) {
         $nombreUsuario = $_SESSION['nombreUsuario'];
    }
     //------------------------------------------------
     if(isset($_SESSION['ID'])) {
      $idUsuario = $_SESSION['ID'];
    }//------------------------------------------------
    $formInicio->formPanelCabecera($nombreUsuario);
    $formInicio->formPanelMenu($platos);
?>