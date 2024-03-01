<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: /ProyectoDSW/views/formHackeo.html");
    exit();
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
$menuAdmin = new formMenuAdmin();

$menuAdmin->mostrarCabecera();
$menuAdmin->mostrarBarraLateral();
?>
<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/estadisticasAdmin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#btnVentasTotales").click(function(){
                $.get("/ProyectoDSW/controllers/admin/controlEstadisticas.php", { reporte: "ventas_totales" }, function(data){
                    $("#reporteContainer").html(data);
                });
            });

            $("#btnVentasPeriodo").click(function(){
                $.get("/ProyectoDSW/controllers/admin/controlEstadisticas.php", { reporte: "ventas_por_periodo" }, function(data){
                    $("#reporteContainer").html(data);
                });
            });
        });
    </script>
</head>
<body>
    <div class="contenedorEstadisticasAdmin">
        <div class="header">
            <img src="/ProyectoDSW/public/img/system/hamburguesaProductos.png" alt="Hamburguesa" class="hamburguesa-img">
            <h1>BIENVENIDO A MOSTRAR ESTADÍSTICAS</h1>
        </div>
        <div class="opciones">
            <button id="btnVentasTotales">Generar Reporte de Ventas Totales</button>
            <button id="btnVentasPeriodo">Generar Reporte de Ventas por Período</button>
        </div>
        <div id="reporteContainer"></div>
    </div>
</body>

