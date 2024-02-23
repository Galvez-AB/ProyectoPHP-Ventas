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
<div>
    ¡Bienvenido a nuestro sistema, <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido']?>!
</div>