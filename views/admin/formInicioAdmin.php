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
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/inicioAdmin.css">
</head>
<body>
    <div class="contenedorMenuAdmin">
        <div class="container">
            <div class="accesorios">
                 <img id="admin" src="http://localhost/ProyectoDSW/public/img/system/Dadmin.png">
            </div>
            <div class="datosAdmin">
                <h3>Datos del Administrador</h3>
                <p>Nombre: <?= $_SESSION['usuario']['nombre']?></p>
                <p>Apellido: <?= $_SESSION['usuario']['apellido']?></p>
                <p>Email: <?= $_SESSION['usuario']['correo']?></p>
            </div>
        </div>
        <div class="informacionAdmin">
            <div class="mensajesAdmin">
                <div class="mensaje">
                    <h2>¡Bienvenido al sistema!</h2>
                    <p>Nuestro sistema cuenta con apartados<br>de gestion y muestras de ventas</p>
                </div>
                <div class="mensaje">
                    <h2>¡Como administrador!</h2>
                    <p>Tu papel es fundamental para el<br> gestión de nuestro sistema</p>
                </div>
            </div>
        </div>
    </div>
    </body>

