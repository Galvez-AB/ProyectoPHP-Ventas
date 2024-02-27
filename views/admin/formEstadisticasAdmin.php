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
<head>
    <!---------Ya tiene css------------>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/estadisticasAdmin.css">
</head>
<body>
    <div class="contenedorEstadisticasAdmin">
        <h1>Hola estas en Mostrar Estadisticas</h1>
        <p>Pagina web en desarrollo.........</p>
    </div>
    </body>