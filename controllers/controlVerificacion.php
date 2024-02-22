<?php
class ControlVerificacion{
    private $mensaje;
    private $eUsuario;
    public function __construct(){
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eusuario.php');
        $this->mensaje = new formMensajeSistema();
        $this->eUsuario = new Eusuario();
    }
    public function ejecutarPost(){
        $btnVerificar = isset($_POST['btnVerificar']) ? $_POST['btnVerificar'] : null;

        if($this->validarBoton($btnVerificar)){
            $usuario=$_POST['usuario'];
            $txtCodigo=$_POST['txtCodigo'];
            $txtValidar=$_POST['txtValidar'];

            if($this->validarCodigo($txtCodigo,$txtValidar)){
                
                //guardar info en la base de datos
                //ingresar a la pagina
            } else{
                $this->mensaje->formMensajeLoginError('CODIGO NO VALIDO','El codigo ingresado no coincide');
                //mensaje el codigo es incorrecto
            }
        } else{
            header("Location: http://localhost/ProyectoDSW/index.php");
            exit();
        }





    }
    public function validarBoton($boton) {
        return isset($boton);
    }
    public function validarCodigo($codigo,$codigoC){
        return $codigo==$codigoC;
    }
}

$controlador = new ControlVerificacion();
$controlador->ejecutarPost();
?>