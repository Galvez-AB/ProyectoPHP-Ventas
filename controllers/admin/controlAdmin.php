<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btnInicio'])){
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formInicioAdmin.php');
            $formInicio=new formInicioAdmin();
            $formInicio->formInicioAdminShow();
        }
        elseif (isset($_POST['btnProductos'])){
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/admin/controlProductos.php');
            $controlProductos=new ControlProductos();
            $controlProductos->menuProductoShow();
        }
        elseif (isset($_POST['btnEstadisticas']))
            header("Location: /ruta/estadisticas"); // Reemplaza "/ruta/estadisticas" con la ruta deseada para las estadísticas
        elseif (isset($_POST['btnPedidos']))
            header("Location: /ruta/pedidos"); // Reemplaza "/ruta/pedidos" con la ruta deseada para la gestión de pedidos
        elseif (isset($_POST['btnAyuda']))
            header("Location: /ruta/ayuda"); 
    }
?>


