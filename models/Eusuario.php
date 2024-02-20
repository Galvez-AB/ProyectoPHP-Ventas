<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/conexion.php");

class Eusuario extends ConnectionBD {
    public function validarUsuario($txtUser) {
        $con = $this->connect();
        $txtUser = mysqli_real_escape_string($con, $txtUser);
        $query = "SELECT * FROM Usuario WHERE txtUser = '$txtUser'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validarContrasenia($txtUser, $txtPassword) {
        $con = $this->connect();
        $txtUser = mysqli_real_escape_string($con, $txtUser);
        $txtPassword = mysqli_real_escape_string($con, $txtPassword);
        $query = "SELECT * FROM Usuario WHERE txtUser = '$txtUser' AND txtPassword = '$txtPassword'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerRol($txtUser) {
        $con = $this->connect();
        $txtUser = mysqli_real_escape_string($con, $txtUser);
        $query = "SELECT rol FROM Usuario WHERE txtUser = '$txtUser'";
        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['rol'];
        } else {
            return null;
        }
    }
}
?>