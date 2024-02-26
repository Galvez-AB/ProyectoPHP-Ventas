<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: /ProyectoDSW/views/formAutenticarUsuario.php");
    exit();
}


include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
$menuAdmin=new formMenuAdmin();

$menuAdmin->mostrarCabecera();
$menuAdmin->mostrarBarraLateral();
?>
<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/pedidosAdmin.css">
</head>
<body>
    <div class="contenedorPedidosAdmin">
        <h1>Hola estas en pedidos</h1>
        <p>Pagina web en desarrollo.........</p>
    </div>
</body>