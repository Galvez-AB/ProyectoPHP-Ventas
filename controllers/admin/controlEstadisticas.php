<?php  
if (session_status() == PHP_SESSION_NONE)
    session_start();

class ControlEstadisticas {
    private $mensaje;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php'); 
        $this->mensaje = new formMensajeSistema();
    }
    public function ejecutarPost(){
        //validacion de botones 
    }

    public function menuEstadisticasShow(){
        header("Location: /ProyectoDSW/views/admin/formEstadisticasAdmin.php");
        exit();
    }
}

if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])){
    $controlador = new ControlEstadisticas();
    $controlador->ejecutarPost();
}
?>