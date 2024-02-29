<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: /ProyectoDSW/views/formHackeo.html");
    exit();
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
$menuAdmin=new formMenuAdmin();

$menuAdmin->mostrarCabecera();
$menuAdmin->mostrarBarraLateral();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--<link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/pedidosAdmin.css">-->
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/productos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="http://localhost/ProyectoDSW/public/js/tablaPedidos.js"></script>
</head>
<body>
    <div class="contenedor">
        <div class="header">
            <img src="/ProyectoDSW/public/img/system/hamburguesaProductos.png" alt="Hamburguesa" class="hamburguesa-img">
            <h1>BIENVENIDO A GESTIONAR PEDIDOS</h1>
        </div>
        <div id="tabla_datos" class="table">

        </div>
    </div>
</body>
</html>
<!--class="contenedorPedidosAdmin"-->