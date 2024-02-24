<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

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
            $nombre=$_SESSION['candidato']['nombre'];
            $apellido=$_SESSION['candidato']['apellido'];
            $txtCorreo=$_SESSION['candidato']['correo'];
            $txtPassword=$_SESSION['candidato']['password'];
            $txtCodigo=$_POST['txtCodigo'];
            $txtVerificar=$_SESSION['codVerificar'];

            if($this->validarCodigo($txtCodigo,$txtVerificar)){
                $this->eUsuario->ingresarUsuario($nombre,$apellido,$txtCorreo,$txtPassword);
                $usuario=$this->eUsuario->obtenerUsuario($txtCorreo);
                session_unset();
                $_SESSION['usuario']=$usuario;
                header("Location: /ProyectoDSW/views/admin/formInicioAdmin.php");
                exit();
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