<?php  
if (session_status() == PHP_SESSION_NONE)
    session_start();

class ControlPedidos {
    private $mensaje;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php'); 
        $this->mensaje = new formMensajeSistema();
    }
    public function ejecutarPost(){

    }

    public function menuPedidosShow(){
        echo 'menuPedidosShow';
    }
}

if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])){
    $controlador = new ControlPedidos();
    $controlador->ejecutarPost();
}
?>