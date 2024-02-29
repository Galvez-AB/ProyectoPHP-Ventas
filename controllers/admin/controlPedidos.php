<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

class ControlPedidos{
    private $ePedidos;

    public function __construct(){
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Epedido.php');
        $this->ePedidos = new Epedido();
    }

    public function cargarTabla(){
        $pedidos=$this->ePedidos->obtenerPedidos();

        $tabla_html = '<table>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>';

        foreach ($pedidos as $pedido):
            $tabla_html .=  '<tr>
                                <td>' . $pedido['nombre'] . '</td>
                                <td>' . $pedido['apellido'] . '</td>
                                <td>' . $pedido['direccion'] . '</td>
                                <td>' .  date("H:i", strtotime($pedido['fecha'])) . '</td>
                                <td>' . $pedido['estado'] . '</td>
                                <td><button id="'.$pedido['idPedido'].'" onclick="siguienteEstado(this.id)">Siguiente</button></td>
                                <td><button id="'.$pedido['idPedido'].'" onclick="detallePedido(this.id)">Detalles</button></td>
                            </tr>';
        endforeach;

        $tabla_html .= '</table>';

        // Devolver la tabla HTML
        echo $tabla_html;
    }

    public function pasarSigEstado($id){
        $this->ePedidos->siguienteEstado($id);
    }
    
    public function obtenerDetalle($id){
        $detalles=$this->ePedidos->obtenerDetallesPedido($id);
        echo json_encode($detalles);
    }
}


if(isset($_POST['action']) && !empty($_POST['action'])){
    $action = $_POST['action'];

    $controlador = new ControlPedidos();

    switch($action){
        case 'cargarTabla':
            $controlador->cargarTabla();
            break;
        case 'sigEstado':
            $id = $_POST['id'];
            $controlador->pasarSigEstado($id);
            break;
        case 'detallePedido':
            $id = $_POST['id'];
            $controlador->obtenerDetalle($id);
            break;
    }
}


?>