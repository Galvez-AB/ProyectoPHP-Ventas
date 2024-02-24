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
        $query = "SELECT * FROM Usuario WHERE correo = '$txtUser' AND txtPassword = '$txtPassword'";
        $result = mysqli_query($con, $query);
        $conexion->disconnect();
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function ingresarUsuario($txtNombre,$txtApellido,$txtCorreo,$txtPassword){
        $conexion = new ConnectionBD();
        $con = $conexion->connect();
        $txtNombre = mysqli_real_escape_string($con, $txtNombre);
        $txtApellido = mysqli_real_escape_string($con, $txtApellido);
        $txtCorreo = mysqli_real_escape_string($con, $txtCorreo);
        $txtPassword = mysqli_real_escape_string($con, $txtPassword);
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
}
?>