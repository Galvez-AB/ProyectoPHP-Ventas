<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

class ControlModificarProductos{
    private $mensaje;
    private $ePlatos;
    private $controlador;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');  
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php'); 
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/admin/controlProductos.php');
        $this->mensaje = new formMensajeSistema();
        $this->ePlatos = new Eplatos();
        $this->controlador=new ControlProductos();
    }

    public function ejecutarPost(){
        $btnGuardar = isset($_POST['btnguardar']) ? $_POST['btnguardar'] : null;

        if ($this->validarBoton($btnGuardar)){
            $idPlato = $_POST['idPlato'];
            $precio = $_POST['precio'];
            $desc = $_POST['descripcion'];
            $imagen=$_FILES["imagen"]["tmp_name"];
            $nomImagen=$_FILES["imagen"]["name"];
            $tipoImagen=strtolower(pathinfo($nomImagen,PATHINFO_EXTENSION));
            $estado = $_POST['estado'];

            if ($this->validarPrecio($precio) &&
            $this->validarDescripcion($desc)) {

                $this->ePlatos->actualizarPlatos($precio,$desc,$estado,$idPlato);

                if($imagen){
                    if($this->validarImagen($tipoImagen)){
                        $plato=$this->ePlatos->obtenerPlato($idPlato);
                        try {
                            $ruta=$plato['imagen'];
                            $rutaAbs=$_SERVER['DOCUMENT_ROOT'].$ruta;
                            unlink($rutaAbs);

                            $ruta="/ProyectoDSW/public/img/platos/".$idPlato.".".$tipoImagen;
                            $rutaAbs=$_SERVER['DOCUMENT_ROOT'].$ruta;
                            $this->ePlatos->insertarImagen($idPlato,$ruta);
                            move_uploaded_file($imagen,$rutaAbs);
                        } catch (Throwable $t) {
                            echo 'Throwable capturado: ' . $t->getMessage();
                            echo 'No se pudo modificar la imagen';
                        }
                    } else {
                        echo 'El archivo ingresado no es una imagen';
                    }   
                }
                $this->controlador->menuProductoShow();
            } else {
                $this->mensaje->formMensajeValidarDatosAdmin();
            }
        } else {
            header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
            exit();
        }
    }
    public function validarBoton($boton){
        return(isset($boton));	
    }

    public function validarPrecio($precio){
        return (is_numeric($precio) && $precio > 0);
    }

    public function validarDescripcion($desc){
        return (strlen($desc) < 300);
    }

    public function validarImagen($ext){
        return ($ext=="jpg"||$ext=="png"||$ext=="jpeg");
    }
}

$controlador = new ControlModificarProductos();
$controlador->ejecutarPost();

?>