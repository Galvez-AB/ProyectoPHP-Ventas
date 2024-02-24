<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/conexion.php");


    class Eplatos{


        public function obtenerPlatos(){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "SELECT * FROM plato";
            $result = mysqli_query($con, $query);
            $platos = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $platos[] = $row;
            }
            $conexion->disconnect();
            return $platos;
        }

        public function obtenerPlatosActivos(){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "SELECT * FROM plato WHERE estado = 1";
            $result = mysqli_query($con, $query);
            $platos = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $platos[] = $row;
            }
            $conexion->disconnect();
            return $platos;
        }


        public function agregarPlatos($nombre,$precio,$desc,$estado){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "INSERT INTO plato (nombre, precio, descripcion, estado) VALUES ('$nombre', $precio, '$desc',$estado)";
            $result=mysqli_query($con,$query);
            $conexion->disconnect();
        }


        public function actualizarPlatos($nombre,$precio,$desc,$estado,$id){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "UPDATE plato SET nombre='$nombre', precio=$precio, descripcion='$desc',estado=$estado WHERE idPlato=$id";
            $result=mysqli_query($con,$query);
            $conexion->disconnect();
        }


        public function obtenerPlato($id){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "SELECT * FROM plato WHERE idPlato = $id";
            $result=mysqli_query($con,$query);
            $plato = mysqli_fetch_assoc($result);
            $conexion->disconnect();
            return $plato;
        }


        public function eliminarPLatos($id){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "DELETE FROM plato WHERE idPlato = $id";
            $result=mysqli_query($con,$query);
            $conexion->disconnect();
        }


        public function insertarImagen($id,$ruta){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "UPDATE plato SET imagen='$ruta' WHERE idPlato=$id";
            $result=mysqli_query($con,$query);
            $conexion->disconnect();
        }


        public function maxId(){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            $query = "SELECT MAX(idPlato) AS max_id FROM plato";
            $result=mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($result);
            $maxId = $row['max_id'];
            $conexion->disconnect();
            return $maxId;
        }
    }
?>