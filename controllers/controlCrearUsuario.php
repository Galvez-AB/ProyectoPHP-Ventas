<?php
class ControlCrearUsuario{
    private $mensaje;
    private $eUsuario;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eusuario.php');
        $this->mensaje = new formMensajeSistema();
        $this->eUsuario = new Eusuario();
    }

    public function ejecutarPost(){
        $btnContinuar = isset($_POST['btnContinuar']) ? $_POST['btnContinuar'] : null;

        if($this->validarBoton($btnContinuar)){
            $txtNombre=$_POST['txtNombre'];
            $txtApellido=$_POST['txtApellido'];
            $txtCorreo=$_POST['txtCorreo'];
            $txtPassword=$_POST['txtPassword'];
            $txtPasswordC=$_POST['txtPasswordC'];

            if($this->validarCorreo($txtCorreo)){
                if($this->validarPassword($txtPassword)){
                    if($this->compararPasswords($txtPassword,$txtPasswordC)){
                        session_start();
                        $_SESSION['candidato']=array(
                            'nombre' => $txtNombre,
                            'apellido' => $txtApellido,
                            'correo' => $txtCorreo,
                            'password' => $txtPassword);
                        $_SESSION['codVerificar']=rand(10000, 99999);
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/correo.php');
                        $correoVerificacion=new Correo();
                        $enviado=$correoVerificacion->enviarCorreoVerificacion($txtNombre,$txtCorreo,$_SESSION['codVerificar']);
                        if($enviado){
                            header("Location: /ProyectoDSW/views/formVerificacion.php");
                            exit();
                        } else {
                            $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','No se pudo enviar el codigo de verificación');
                        }
                    } else{
                        $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','Las contraseñas digitadas no coinciden');
                    }
                } else{
                    $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','La contraseña ingresada debe tener al menos 8 caracteres');
                }
            } else{
                $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','El correo ingresado no es valido o ya esta en uso');
            }
        } else{
            header("Location: http://localhost/ProyectoDSW/index.php");
            exit();
        }
    }

    public function validarBoton($boton) {
        return isset($boton);
    }

    public function validarCorreo($correo) {
        if(filter_var($correo,FILTER_VALIDATE_EMAIL) && strlen($correo)<200)
            return !$this->eUsuario->validarUsuario($correo);
        return false;
    }

    public function validarPassword($password) {
        return (strlen($password)>7 && strlen($password)<50);
    }
    
    public function compararPasswords($password,$passwordC) {
        return $password==$passwordC;
    }
    
}

$controlador = new ControlCrearUsuario();
$controlador->ejecutarPost();
?>