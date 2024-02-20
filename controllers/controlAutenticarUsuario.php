<?php
class ControlAutenticarUsuario {
    private $mensaje;
    private $eUsuario;
    private $formInicio;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eusuario.php');
        $this->mensaje = new formMensajeSistema();
        $this->eUsuario = new Eusuario();
    }

    public function ejecutarPost() {
        
        $btnIniciar = isset($_POST['btnIniciar']) ? $_POST['btnIniciar'] : null;

        if ($this->validarBoton($btnIniciar)) {
            $txtUser = $_POST['txtUser'];
            $txtPassword = $_POST['txtPassword'];

            if ($this->validarDatos($txtUser, $txtPassword)) {
                if($this->eUsuario->validarUsuario($txtUser)){
                    if($this->eUsuario->validarContrasenia($txtUser, $txtPassword)){
                        $rol=$this->eUsuario->obtenerRol($txtUser);
                        session_start();
                        $_SESSION['correo']=$txtUser;
                        if($rol=='admin'){
                            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formInicioAdmin.php');
                            $this->formInicio=new formInicioAdmin();
                            $this->formInicio->formInicioAdminShow();
                        }
                        else{
                            
                        }
                    }
                    else
                        $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','La contraseña es incorrecta');
                }
                else
                    $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','El usuario ingresado no existe');
            } else
                $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','Los datos ingresados no cumplen con las normas requeridas');
        } else {
            header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
            exit;
        }
    }

    public function validarBoton($boton) {
        return isset($boton);
    }

    public function validarDatos($txtUser, $txtPassword) {
        return (strlen($txtUser) > 3 && strlen($txtPassword) > 7);
    }
}

$controlador = new ControlAutenticarUsuario();
$controlador->ejecutarPost();
?>


