<?php
class ControlCrearUsuario{
    private $mensaje;
    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');
        $this->mensaje = new formMensajeSistema();
    }

    
    public function ejecutarPost(){
        $btnContinuar = isset($_POST['btnContinuar']) ? $_POST['btnContinuar'] : null;

        if($this->validarBoton($btnContinuar)){
            $txtNombre=$_POST['txtNombre'];
            $txtApellido=$_POST['txtApellido'];
            $txtCorreo=$_POST['txtCorreo'];
            $txtPassword=$_POST['txtPassword'];
            $txtPasswordC=$_POST['txtPasswordC'];

            if(validarCorreo($txtCorreo)){
                if(validarPassword($txtPassword)){
                    if(compararPasswords($txtPassword,$txtPasswordC)){
                        //todos los datos son validos
                    } else{
                        $this->mensaje->formMensajeLoginError();
                        //passwords no son iguales
                    }
                } else{
                    //contraseña con cumple con los parametros
                }
            } else{
                $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','El correo ingresado ya esta en uso');
                //correo no cumple con las normas
            }
        } else{
            header("Location: http://localhost/ProyectoDSW/views/formHackeo.html");
            exit;
        }
    }

    public function validarBoton($boton) {
        return isset($boton);
    }
    public function validarCorreo($correo) {

        return (strlen($correo)>10 && strlen($correo)<50);
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