<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/ProyectoDSW/models/conexion.php");

    class Epedido{
        public function agregarPedido($idUsuario, $direccion) {
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
    
            try {
                $query = "INSERT INTO pedido (idUsuario, direccion) VALUES (?, ?)";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "is", $idUsuario, $direccion);
                mysqli_stmt_execute($stmt);
                $pedidoId = mysqli_insert_id($con);
                return $pedidoId;
            } catch (Exception $e) {
                echo "Error al insertar el pedido: " . $e->getMessage();
                exit;
            } finally {
                $conexion->disconnect();
            }
        }

        public function agregarDetallesPedido($pedidoId, $idPlato, $cantidad) {
            $conexion = new ConnectionBD(); 
            $con = $conexion->connect(); 
            mysqli_begin_transaction($con);
            try {
                $queryDetalle = "INSERT INTO detallepedido (idPedido, idPlato, cantidad) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($con, $queryDetalle);
                mysqli_stmt_bind_param($stmt, "iii", $pedidoId, $idPlato, $cantidad);
                mysqli_stmt_execute($stmt);
                mysqli_commit($con); 
            } catch (Exception $e) {
                mysqli_rollback($con);
                throw $e;
            } finally {
                $conexion->disconnect(); 
            }
        }

        public function agregarBoleta($idPedido, $serie, $monto) {
            $conexion = new ConnectionBD();
            $con = $conexion->connect(); 
            try {
                $fecha = date('Y-m-d H:i:s'); 
                $queryBoleta = "INSERT INTO boleta (idPedido, serie, fecha, monto) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($con, $queryBoleta);
                mysqli_stmt_bind_param($stmt, "issd", $idPedido, $serie, $fecha, $monto);
                mysqli_stmt_execute($stmt);
            } catch (Exception $e) {
                throw $e;
            } finally {
                $conexion->disconnect(); 
            }
        }
    }
?>