<?php
session_start(); 
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formPanelCliente.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btnInicio'])){
            $modeloPlatos = new Eplatos();
            $platos = $modeloPlatos->obtenerPlatosActivos(); 
            $formInicio=new formPanelCliente();
            if (isset($_SESSION['nombreUsuario'])) {
                $nombreUsuario = $_SESSION['nombreUsuario'];
            }
            $formInicio->formPanelCabecera($nombreUsuario);
            $formInicio->formPanelMenu($platos);
        }
         //-------------------------------------------------
        elseif (isset($_POST['btnPedidos'])){
             if (isset($_SESSION['nombreUsuario'])) {
                 $nombreUsuario = $_SESSION['nombreUsuario'];
             }
             $modeloPlatos = new Eplatos();
             $platos = $modeloPlatos->obtenerPlatos();
             $formInicio=new formPanelCliente();
             $totalProductos = isset($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
             $formInicio->formPanelCabecera($nombreUsuario);
            $detallesCarrito = array();
            if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
                foreach ($_SESSION['carrito'] as $idProducto => $cantidad) {
                    $plato = $modeloPlatos->obtenerPlato($idProducto);
                    if ($plato) { 
                        $plato['cantidad'] = $cantidad; 
                        $detallesCarrito[] = $plato; 
                    }
                }
            }
            $formInicio->formPanelPedido($detallesCarrito);   
        }
        //---------------------------------------------------------- 
        elseif (isset($_POST['btnSalir'])){
            $_SESSION = array();
            //session_unset();
            session_destroy();
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/controlPanelUsuario.php');   
            $controlPanel = new ControlPanel();
            $controlPanel->cargarPanel();
        }

    }
?>


