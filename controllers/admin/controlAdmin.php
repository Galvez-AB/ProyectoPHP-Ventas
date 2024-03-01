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
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/admin/controlEstadisticas.php');
            $controlador = new ControlEstadisticas();
            $controlador->menuEstadisticasShow();
        }
        elseif (isset($_POST['btnPedidos'])){
            header("Location: /ProyectoDSW/views/admin/formPedidos.php");
        
        } elseif (isset($_POST['btnAyuda'])){
            header("Location: /ProyectoDSW/views/admin/formAyudaAdmin.php");
            exit();
        }
    }
?>