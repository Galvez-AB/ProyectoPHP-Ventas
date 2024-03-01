<?php  
if (session_status() == PHP_SESSION_NONE)
    session_start();

class ControlProductos {
    private $mensaje;
    private $ePlatos;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php'); 
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php'); 
        $this->mensaje = new formMensajeSistema();
        $this->ePlatos = new Eplatos();
    }

    public function ejecutarPost() {
        $btnModificar=isset($_POST['btnmodificar']) ? $_POST['btnmodificar'] : null;
        $btnAgregar = isset($_POST['btnagregar']) ? $_POST['btnagregar'] : null;
        $btnEliminar = isset($_POST['btneliminar']) ? $_POST['btneliminar'] : null;

        if ($this->validarBoton($btnAgregar)) {
            header("Location: /ProyectoDSW/views/admin/formAgregarProducto.php");
            exit();
        } else if($this->validarBoton($btnModificar)){
            $idPlato = $_POST['id'];
            $_SESSION['plato']=$this->ePlatos->obtenerPlato($idPlato);
            header("Location: /ProyectoDSW/views/admin/formModificarProducto.php");
            exit();
        } else if($this->validarBoton($btnEliminar)){
            $idPlato = $_POST['id'];
            $plato=$this->ePlatos->obtenerPlato($idPlato);          
            if ($plato) {
                $this->ePlatos->eliminarPLatos($idPlato);

                try {
                    $ruta = $plato['imagen'];
                    $rutaAbs = $_SERVER['DOCUMENT_ROOT'] . $ruta;
                    unlink($rutaAbs);
                } catch (Throwable $t) {
                    echo 'Throwable capturado: ' . $t->getMessage();
                    echo 'No se pudo eliminar la imagen';
                }
                $this->menuProductoShow();
            } else {
                echo 'No se encontro el plato';
            }
        }
        else{
            header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
            exit();
        }
    }

    public function validarBoton($boton) {
        return isset($boton);
    }

    public function menuProductoShow() {
        $_SESSION['platos'] = $this->ePlatos->obtenerPlatos();
        header("Location: /ProyectoDSW/views/admin/formProductos.php");
        exit();
    }

}

if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])){
    $controlador = new ControlProductos();
    $controlador->ejecutarPost();
}
?>