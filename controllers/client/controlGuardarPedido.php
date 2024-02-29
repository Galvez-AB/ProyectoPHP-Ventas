<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

class controlGuardarPedido{
    private $ePedidos;
    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/Epedido.php");
        $this->ePedidos = new Epedido();
    }
    public function ejecutarPost() {
        $data = json_decode(file_get_contents('php://input'), true);
        if (!isset($data['direccion']) || !isset($_SESSION['carrito'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Faltan datos o el carrito está vacío']);
            exit;
        }
        if(isset($_SESSION['ID'])) {
            $idUsuario = $_SESSION['ID'];
        } 
        if (isset($data['totalGeneral'])) {
            $totalGeneral = $data['totalGeneral'];        
        }

        $direccion = $data['direccion'];
        try {
            $pedidoId = $this->ePedidos->agregarPedido($idUsuario, $direccion);
            //--------------------------------------------------------------------------
            $_SESSION['idPedido'] = $pedidoId;
            //--------------------------------------------------------------------------
            foreach ($_SESSION['carrito'] as $idPlato => $cantidad) {
                $this->ePedidos->agregarDetallesPedido($pedidoId, $idPlato, $cantidad);
            }
            $serie = "B" . str_pad($pedidoId, 5, "0", STR_PAD_LEFT); 
            $this->ePedidos->agregarBoleta($pedidoId, $serie, $totalGeneral);
            //--------------------------------------------------------------------------
            echo json_encode(['success' => true, 'message' => 'Pedido guardado con éxito', 'pedidoId' => $pedidoId]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Error al guardar el pedido: ' . $e->getMessage()]);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controlador = new controlGuardarPedido();
    $controlador->ejecutarPost();
}

?>