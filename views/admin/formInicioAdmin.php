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
        <div class="Bienvenida">
            ¡Bienvenido a nuestro sistema, <?= $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellido']?>!
        </div>
        <div class="informacionAdmin">
            
            <div class="mensajesAdmin">
                <div class="mensaje">
                    <h2>Mensaje Importante </h2>
                    <p>Este es un mensaje importante para el administrador.</p>
                </div>
                <div class="mensaje">
                    <h2>Otro Msj</h2>
                    <p>Probadno estilos hasta que quede uno uuuu.....</p>
                </div>
            </div>
        </div>
    </div>
   
</body>