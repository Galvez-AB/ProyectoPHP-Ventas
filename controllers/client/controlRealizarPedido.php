<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['realizarPedido'])) {
    // Logica de realiza pago

    
    exit();
} else {

    header("Location: /ProyectoDSW/views/client/formPanelCliente.php");
    exit();
}
?>

