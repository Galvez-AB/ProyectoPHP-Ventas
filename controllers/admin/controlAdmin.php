<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        unset($_SESSION['plato']);
        unset($_SESSION['platos']);
        
        if(isset($_POST['btnSalir'])){ 
            session_destroy();
            header("Location: /ProyectoDSW/index.php");
            exit();
        } elseif (isset($_POST['btnInicio'])){
            header("Location: /ProyectoDSW/views/admin/formInicioAdmin.php");
            exit();
        } elseif (isset($_POST['btnProductos'])){
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/admin/controlProductos.php');
            $controlador=new ControlProductos();
            $controlador->menuProductoShow();
        } elseif (isset($_POST['btnEstadisticas'])){
            header("Location: /ruta/estadisticas"); // Reemplaza "/ruta/estadisticas" con la ruta deseada para las estadísticas
        }
        elseif (isset($_POST['btnPedidos'])){
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/admin/controlPedidos.php');
            $controlador = new ControlPedidos();
            $controlador->menuPedidosShow();
        } elseif (isset($_POST['btnAyuda'])){
            header("Location: /ruta/ayuda");
        }
    }
?>