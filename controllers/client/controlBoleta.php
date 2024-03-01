<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formBoletaCliente.php');
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/Epedido.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/Eusuario.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/Eplatos.php");

session_start(); 
if (isset($_SESSION['idPedido'])) {
    $pedidoId = $_SESSION['idPedido'];
}

$modelo = new Epedido();
$Boleta = $modelo->obtenerBoleta($pedidoId);

$Pedido = $modelo->obtenerPedido($pedidoId);
    $iduser = $Pedido['idUsuario'];

$modeloUser = new Eusuario();
$Usuario = $modeloUser->obtenerUsuarioPorId($iduser);

$DetallePedido=$modelo->obtenerDetallesPedidos($pedidoId);
$modeloPlato = new Eplatos();
$Platos = [];
if (!empty($DetallePedido)) {
    foreach ($DetallePedido as $detalle) {
        $idPlato = $detalle['idPlato'];
        $cantidad = $detalle['cantidad']; 
        $infoPlato = $modeloPlato->obtenerPlato($idPlato);
        $Platos[] = [
            'cantidad' => $cantidad,
            'nombre' => $infoPlato['nombre'],
            'precio' => $infoPlato['precio'],
            'total' => $cantidad * $infoPlato['precio']
        ];
    }
} else {
    echo "No se encontraron detalles para el pedido.";
}
$boleta = new boleta();
$boleta->generarBoleta($Boleta,$Usuario,$Pedido,$Platos);

?>