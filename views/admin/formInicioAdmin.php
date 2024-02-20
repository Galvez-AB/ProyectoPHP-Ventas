<?php
class formInicioAdmin{
    private $menuAdmin;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
        $this->menuAdmin = new formMenuAdmin();
    }
    
    public function formInicioAdminShow(){
        $this->menuAdmin->mostrarCabecera();
        $this->menuAdmin->mostrarBarraLateral();
        
    }
}


?>