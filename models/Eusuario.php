<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/conexion.php");

class Eusuario{
    public function validarUsuario($txtUser) {
        $conexion = new ConnectionBD();
        $con = $conexion->connect();
        $txtUser = mysqli_real_escape_string($con, $txtUser);
        $query = "SELECT * FROM Usuario WHERE correo = '$txtUser'";
        $result = mysqli_query($con, $query);
        $conexion->disconnect();
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validarContrasenia($txtUser, $txtPassword) {
        $conexion = new ConnectionBD();
        $con = $conexion->connect();
        $txtUser = mysqli_real_escape_string($con, $txtUser);
        $txtPassword = mysqli_real_escape_string($con, $txtPassword);
        $query = "SELECT txtPassword FROM Usuario WHERE correo = '$txtUser'";
        $result = mysqli_query($con, $query);
        $conexion->disconnect();
        if ($result && mysqli_num_rows($result) > 0) {
            $password_hash=mysqli_fetch_assoc($result)['txtPassword'];
            return password_verify($txtPassword,$password_hash);
        }
    }

    public function ingresarUsuario($txtNombre,$txtApellido,$txtCorreo,$txtPassword){
        $conexion = new ConnectionBD();
        $con = $conexion->connect();
        $txtNombre = mysqli_real_escape_string($con, $txtNombre);
        $txtApellido = mysqli_real_escape_string($con, $txtApellido);
        $txtCorreo = mysqli_real_escape_string($con, $txtCorreo);
        $txtPassword = mysqli_real_escape_string($con, $txtPassword);
        $txtPassword = password_hash($txtPassword,PASSWORD_DEFAULT,['cost'=>4]);
        $query = "INSERT INTO Usuario (nombre, apellido, correo, txtPassword, rol) 
            VALUES ('$txtNombre', '$txtApellido', '$txtCorreo', '$txtPassword', 'user')";
        $result = mysqli_query($con, $query);
        $conexion->disconnect();
    }
    
    public function obtenerUsuario($txtUser) {
        $conexion = new ConnectionBD();
        $con = $conexion->connect();
        $txtUser = mysqli_real_escape_string($con, $txtUser); 
        $query = "SELECT idUsuario,nombre,apellido,correo,rol FROM Usuario WHERE correo = '$txtUser'";
        $result = mysqli_query($con, $query); 
        $conexion->disconnect();
        if ($result && mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result); 
            return $usuario; 
        } else {
            return null; 
        }
    }
    public function obtenerUsuarioPorId($idUsuario) {
        $conexion = new ConnectionBD();
        $con = $conexion->connect();
        $query = "SELECT * FROM usuario WHERE idUsuario = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $idUsuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $conexion->disconnect();
        if ($result && mysqli_num_rows($result) > 0) {
            $usuario = mysqli_fetch_assoc($result);
            return $usuario;
        } else {
            return null;
        }
    }
}
?>