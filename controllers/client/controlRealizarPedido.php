<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formRealizarPedido.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formPanelCliente.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btnRealizarPedido'])) {
        if (isset($_SESSION['nombreUsuario'])) {
            $nombreUsuario = $_SESSION['nombreUsuario'];
        }
        $formInicio=new formPanelCliente();
        $formInicio->formPanelCabecera($nombreUsuario);
        
        if (isset($_POST['totalGeneral'])) {
            $totalGeneral = $_POST['totalGeneral'];
            //echo "<p>Total a pagar: $totalGeneral</p>";
            $formDetalles=new formPagos();
            $formDetalles->formDetallesCompra($totalGeneral);

        }
        $formPago=new formPagos();
        $formPago->formPagoPayPal($totalGeneral);

    } else {

        // header("Location: /ProyectoDSW/views/client/formPanelCliente.php");
        // exit();
        header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
        exit();
        //echo  "error";
    }

?>