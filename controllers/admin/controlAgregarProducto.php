<?php
class ControlAgregarProductos{
    private $mensaje;
    private $ePlatos;
    private $controlProductos;
    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/controllers/admin/controlProductos.php');
        $this->mensaje = new formMensajeSistema();
        $this->ePlatos = new Eplatos();
        $this->controlProductos=new ControlProductos();
    }


    public function ejecutarPost(){
            $btnGuardar = isset($_POST['btnguardar']) ? $_POST['btnguardar'] : null;
            if ($this->validarBoton($btnGuardar)){
                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
                $desc = $_POST['descripcion'];
                $imagen=$_FILES["imagen"]["tmp_name"];
                $nomImagen=$_FILES["imagen"]["name"];
                $tipoImagen=strtolower(pathinfo($nomImagen,PATHINFO_EXTENSION));
                $estado= $_POST['estado'];

                ?><script>
                if(window.history.replaceState)
                    window.history.replaceState(null,null,'http://localhost/ProyectoDSW/controllers/admin/controlProductos.php?mostrarMenuProductos=true');
                </script><?php

                if ($this->validarNombre($nombre) && $this->validarPrecio($precio) && $this->validarDescripcion($desc) && $this->validarImagen($tipoImagen)) {
                    $this->ePlatos->agregarPlatos($nombre,$precio,$desc,$estado);
                    $idRegistro=$this->ePlatos->maxId();

                    $ruta="/ProyectoDSW/public/img/platos/".$idRegistro.".".$tipoImagen;
                    $rutaAbs=$_SERVER['DOCUMENT_ROOT'].$ruta;
                    $this->ePlatos->insertarImagen($idRegistro,$ruta);
                    move_uploaded_file($imagen,$rutaAbs);
                    
                    $this->controlProductos->menuProductoShow();
                    $this->mensaje->formMensajeProcesoCompleto('El producto ha sido Agregado');
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


        public function validarNombre($texto){
            return (!empty($texto)&&strlen($texto)<200);
        }


        public function validarPrecio($precio){
            return (!empty($precio) && is_numeric($precio) && $precio > 0);
        }


        public function validarDescripcion($desc){
            return (!empty($desc) && strlen($desc) <= 200);
        }


        public function validarImagen($ext){
            return ($ext=="jpg"||$ext=="png"||$ext=="jpeg");
        }
    }

$controlador = new ControlAgregarProductos();
$controlador->ejecutarPost();

?>


