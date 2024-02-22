<?php
class ControlVerificacion{
    public function ejecutarPost(){
        $btnVerificar = isset($_POST['btnVerificar']) ? $_POST['btnVerificar'] : null;

        if($this->validarBoton($btnVerificar)){
            $txtCodigo=$_POST['txtCodigo'];
            $txtValidar=$_POST['txtValidar'];
            



        } else{
            header("Location: http://localhost/ProyectoDSW/index.php");
            exit();
        }





    }
    public function validarBoton($boton) {
        return isset($boton);
    }
    public function validarCodigo($codigo,$codigoC){
        return $codigo==$codigo;
    }
}

$controlador = new ControlVerificacion();
$controlador->ejecutarPost();
?>