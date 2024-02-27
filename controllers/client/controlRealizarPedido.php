<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formRealizarPedido.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formPanelCliente.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRealizarPedido'])) {
        if (isset($_SESSION['nombreUsuario'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
        }
        //--------------------------------------------------
        if(isset($_SESSION['ID'])) {
            $idUsuario = $_SESSION['ID'];
        }
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
        }
        //--------------------------------------------------
        $formInicio=new formPanelCliente();
        $formInicio->formPanelCabecera($nombreUsuario);
        
        if (isset($_POST['totalGeneral'])) {
            $totalGeneral = $_POST['totalGeneral'];
            $formPago=new formPagos();
            $formPago->formPagoPayPal($totalGeneral);
        }
        
    } else {

        header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
        exit();
    }

?>