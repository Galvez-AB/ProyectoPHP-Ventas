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

$menuAdmin->mostrarBarraLateral();
?>
<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/ayudaAdmin.css">
</head>
<body>
    <div class="contenedorAyudaAdmin">
        <div class="contacto">
            <h2>Contacto de la Empresa</h2>
            <p>Nombre: BurgerFisi</p>
            <p>Correo: burgerfisi@gmail.com</p>
            <p>Pagina Web: www.burgerfisi.com</p>
            <p>Teléfono(1): 910 486 639</p>
            <p>Teléfono(2): 123 456 789</p>
        </div>
        
        <div class="preguntasFrecuentes">
            <h2>Preguntas Frecuentes</h2>
            <p><b>¿Como puedo controlar lo que se muestra en mi menu de ventas?</b></p>
            <p>Se debe ingresar al apartado de gestionar productos y cambiar el estado a no disponible </p>
            <p><b>¿Puedo recuperar un producto eliminado?</b></p>
            <p>No, una vez eliminado el producto ya no se puede acceder a este, tienes que comunicarte con el administrador de la base de datos para recuperarlo</p>
        </div>
        
        <div class="tutorial">
            <h2>Tutorial: Agregar un producto</h2>
            <p><b>Paso 1:</b> Ingresar al apartado de Gestionar productos</p>
            <p><b>Paso 3:</b> Click en agregar(el boton se encuentra en al parte superior derecha)</p>
            <p><b>Paso 4:</b> Complete los campos correctamente, caso contrario no podra continuar</p>
            <p><b>Paso 5:</b> Una vez que completado, click en guardar</p>
            <p><b>System:</b> El sistema de redirigira a la ventana principal</p>
            <p>               donde podra visualizar su nuevo producto.</p>
        </div>
    </div>
</body>
<?php
$menuAdmin->mostrarCabecera();
?>