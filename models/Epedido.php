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
            date_default_timezone_set('America/Lima');
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

        public function obtenerPedidos() {
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            try{
                $query= "SELECT p.idPedido,u.nombre, u.apellido, p.direccion, b.monto, b.fecha, p.estado
                FROM pedido p JOIN usuario u ON p.idUsuario = u.idUsuario
                JOIN boleta b ON p.idPedido = b.idPedido
                WHERE DATE(b.fecha) = CURDATE()";
                $result = mysqli_query($con, $query);
                $pedidos=array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $pedidos[] = $row;
                }
                return $pedidos;
            } catch (Exception $e) {
                throw $e;
            } finally {
                $conexion->disconnect();
            }
        }

        public function obtenerDetallesPedido($idPedido){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();

            try{
                $query= "SELECT dp.idPlato, pl.nombre, dp.cantidad FROM detallepedido dp
                JOIN plato pl ON dp.idPlato = pl.idPlato
                WHERE dp.idPedido = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "i", $idPedido);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $detalles=array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $detalles[] = $row;
                }
                return $detalles;
            } catch (Exception $e) {
                throw $e;
            } finally {
                $conexion->disconnect();
            }
        }

        public function siguienteEstado($idPedido){
            $conexion = new ConnectionBD();
            $con = $conexion->connect();

            try{
                $selectQuery = "SELECT estado FROM pedido 
                WHERE idPedido = ?";
                $selectStmt = mysqli_prepare($con, $selectQuery);
                mysqli_stmt_bind_param($selectStmt, "i", $idPedido);
                mysqli_stmt_execute($selectStmt);
                $result = mysqli_stmt_get_result($selectStmt);
                if ($row = mysqli_fetch_assoc($result)) {
                    $estadoAct = $row['estado'];
                    switch($estadoAct){
                        case 0:
                            $sigEstado=1;
                            break;
                        case 1:
                            $sigEstado=2;
                            break;
                    }

                    if (isset($sigEstado)){
                        $updateQuery = "UPDATE pedido SET estado = ? WHERE idPedido = ?";
                        $updateStmt = mysqli_prepare($con, $updateQuery);
                        mysqli_stmt_bind_param($updateStmt, "ii", $sigEstado, $idPedido);
                        mysqli_stmt_execute($updateStmt);
                    }
                }
            } catch (Exception $e) {
                throw $e;
            } finally {
                $conexion->disconnect();
            }
        }
        //-------------------------------------------------------------------------------
        public function obtenerBoleta($pedidoId) {
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            try {
                $query = "SELECT * FROM boleta WHERE idPedido = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "i", $pedidoId);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $datosBoleta = $resultado->fetch_assoc();
                return $datosBoleta;
            } catch (Exception $e) {
                echo "Error al obtener datos de la boleta: " . $e->getMessage();
                exit;
            } finally {
                $conexion->disconnect();
            }
        }
        public function obtenerPedido($pedidoId) {
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            try {
                $query = "SELECT * FROM pedido WHERE idPedido = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "i", $pedidoId);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                $datosPedido = $resultado->fetch_assoc();
                return $datosPedido;
            } catch (Exception $e) {
                echo "Error al obtener datos del pedido: " . $e->getMessage();
                exit;
            } finally {
                $conexion->disconnect();
            }
        }
        public function obtenerDetallesPedidos($pedidoId) {
            $conexion = new ConnectionBD();
            $con = $conexion->connect();
            try {
                $query = "SELECT dp.idPedido, dp.idPlato, dp.cantidad, p.nombre, p.precio 
                          FROM detallepedido dp
                          JOIN plato p ON dp.idPlato = p.idPlato
                          WHERE dp.idPedido = ?";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, "i", $pedidoId);
                mysqli_stmt_execute($stmt);
                $resultado = mysqli_stmt_get_result($stmt);
                                $detallesPedido = [];
                while ($fila = $resultado->fetch_assoc()) {
                    $detallesPedido[] = $fila;
                }
                
                return $detallesPedido;
            } catch (Exception $e) {
                echo "Error al obtener los detalles del pedido: " . $e->getMessage();
                exit;
            } finally {
                $conexion->disconnect();
            }
        }
    }
?>