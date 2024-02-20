<?php  
    class ControlProductos {
        private $mensaje;
        public function __construct() {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');  
            $this->mensaje = new formMensajeSistema();
        }

        public function ejecutarPost() {
            $btnModificar=isset($_POST['btnmodificar']) ? $_POST['btnmodificar'] : null;
            $btnAgregar = isset($_POST['btnagregar']) ? $_POST['btnagregar'] : null;
            $btnEliminar = isset($_POST['btneliminar']) ? $_POST['btneliminar'] : null;

            if ($this->validarBoton($btnAgregar)) {
                include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formAgregarProducto.php');
                $objFormAgregarProd = new formAgregarProd();
                $objFormAgregarProd->formAgregarProductosShow();
            } else if($this->validarBoton($btnModificar)){
                include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
                include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formModificarProducto.php');
                $idPlato = $_POST['id'];
                $objEPlatos = new Eplatos();
                $plato= $objEPlatos->obtenerPlato($idPlato);
                $objFormModProd = new formModificarProd();
                $objFormModProd->formModificarProductosShow($plato);
            } else if($this->validarBoton($btnEliminar)){
                include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
                $idPlato = $_POST['id'];
                $objEPlatos = new Eplatos();
                $plato=$objEPlatos->obtenerPlato($idPlato);          
                if ($plato) {
                    $objEPlatos->eliminarPLatos($idPlato);
                    $ruta = $plato['imagen'];
                    $rutaAbs = $_SERVER['DOCUMENT_ROOT'] . $ruta;
                    try {
                        unlink($rutaAbs);
                        $this->menuProductoShow();
                        $this->mensaje->formMensajeProcesoCompleto('El producto ha sido Eliminado');
                    } catch (\Throwable $th) {
                        $this->menuProductoShow();
                        $this->mensaje->formMensajeProcesoCompletoAdvertencia('Error al eliminar la imagen');
                    }
                } else {
                    $this->menuProductoShow();
                }
            }
            else{
                header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
                exit;
            }
        }


        public function menuProductoShow() {
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formProductos.php');
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
            $objEPlatos = new Eplatos();
            $platos = $objEPlatos->obtenerPlatos();
            $objFormProd = new formProductos();
            $objFormProd->formProductosShow($platos);
        }


        public function validarBoton($boton) {
            return isset($boton);
        }
    }






    if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])){
        $controlador = new ControlProductos();
        $controlador->ejecutarPost();
    }
?>