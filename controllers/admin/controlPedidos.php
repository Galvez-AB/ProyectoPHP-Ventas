<?php  
if (session_status() == PHP_SESSION_NONE)
    session_start();

//----------------------------------------------------------
//----------------------------------------------------------

    if (!isset($_SESSION['estadosPedidos'])) {
        $_SESSION['estadosPedidos'] = [];
    }
//----------------------------------------------------------
//----------------------------------------------------------

class ControlPedidos {
    private $mensaje;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php'); 
        $this->mensaje = new formMensajeSistema();
    }
    public function ejecutarPost(){
        //Code por el momento para la simulacion--------------------------------------
        //----------------------------------------------------------
        if (isset($_POST['estado']) && isset($_POST['idPedido'])) {
            $nuevoEstado = $_POST['estado'];
            $idPedido = $_POST['idPedido'];
           
            $_SESSION['estadosPedidos'][$idPedido] = $nuevoEstado;
            
            header("Location: /ProyectoDSW/views/admin/formPedidosAdmin.php");
            exit();
        }
        //----------------------------------------------------------
        //----------------------------------------------------------

    }

    public function menuPedidosShow(){
        header("Location: /ProyectoDSW/views/admin/formPedidosAdmin.php");
        exit();
    }
}

if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])){
    $controlador = new ControlPedidos();
    $controlador->ejecutarPost();
}
?>