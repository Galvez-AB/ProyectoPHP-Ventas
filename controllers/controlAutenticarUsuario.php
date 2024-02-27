<?php
class ControlAutenticarUsuario {
    private $mensaje;
    private $eUsuario;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eusuario.php');
        $this->mensaje = new formMensajeSistema();
        $this->eUsuario = new Eusuario();
    }

    public function ejecutarPost() {
        $btnIniciar = isset($_POST['btnIniciar']) ? $_POST['btnIniciar'] : null;
        $btnRegistrar = isset($_POST['btnRegistrar']) ? $_POST['btnRegistrar'] : null;

        if ($this->validarBoton($btnIniciar)) {
            $txtUser = $_POST['txtUser'];
            $txtPassword = $_POST['txtPassword'];

            if ($this->validarDatos($txtUser, $txtPassword)) {
                if($this->eUsuario->validarUsuario($txtUser)){
                    if($this->eUsuario->validarContrasenia($txtUser, $txtPassword)){
                        $usuario=$this->eUsuario->obtenerUsuario($txtUser);
                        session_start();
                        if($usuario['rol']=='admin'){
                            $_SESSION['usuario']=$usuario;
                            header("Location: /ProyectoDSW/views/admin/formInicioAdmin.php");
                            exit();
                        }
                        else{
                            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/client/formPanelCliente.php');
                            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/Eplatos.php');
                            $modeloPlatos = new Eplatos();
                            $platos = $modeloPlatos->obtenerPlatosActivos(); 
                            $formInicio=new formPanelCliente();
                            //-------------------------------------------------
                            $_SESSION['nombreUsuario'] = $usuario['nombre'];
                            $_SESSION['ID'] = $usuario['idUsuario']; 

                            $formInicio->formPanelCabecera($_SESSION['nombreUsuario']);
                            //-------------------------------------------------
                            $formInicio->formPanelMenu($platos);
                            }
                        }
                    else
                        $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','La contraseña es incorrecta');
                }
                else
                    $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','El usuario ingresado no existe');
            } else
                $this->mensaje->formMensajeLoginError('DATOS NO VÁLIDOS','El correo debe ser válido y la contraseña tiene que tener al menos 8 caracteres');
        } elseif($this->validarBoton($btnRegistrar)){
            header("Location: /ProyectoDSW/views/formCrearUsuario.php");
            exit();
        } else {
            header("Location: http://localhost/ProyectoDSW/index.php");
            exit();
        }
    }

    public function validarBoton($boton) {
        return isset($boton);
    }

    public function validarDatos($txtUser, $txtPassword) {
        return filter_var($txtUser,FILTER_VALIDATE_EMAIL) && strlen($txtUser)<200 &&
        strlen($txtPassword) <50 && strlen($txtPassword) > 7;
    }
}

$controlador = new ControlAutenticarUsuario();
$controlador->ejecutarPost();
?>


