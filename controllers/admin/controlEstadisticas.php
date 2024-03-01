<?php  
if (session_status() == PHP_SESSION_NONE)
    session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/models/conexion.php');

class ControlEstadisticas {
    private $mensaje;
    private $conexion;

    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formMensajeSistema.php'); 
        $this->mensaje = new formMensajeSistema();
        $this->conexion = new ConnectionBD();
    }

    public function ejecutarPost(){
        // Validación de botones
    }

    public function menuEstadisticasShow(){
        header("Location: /ProyectoDSW/views/admin/formEstadisticasAdmin.php");
        exit();
    }

    public function generarReporteVentasTotales(){
        $conn = $this->conexion->connect();
    
        // Consulta SQL para obtener las ventas totales
        $query = "SELECT DATE(b.fecha) AS fecha, dp.idPlato, p.nombre AS nombre_producto, SUM(dp.cantidad) AS cantidad, SUM(dp.cantidad * p.precio) AS monto
                  FROM boleta b
                  INNER JOIN pedido pe ON b.idPedido = pe.idPedido
                  INNER JOIN detallepedido dp ON pe.idPedido = dp.idPedido
                  INNER JOIN plato p ON dp.idPlato = p.idPlato
                  GROUP BY DATE(b.fecha), dp.idPlato, p.nombre";
        $result = mysqli_query($conn, $query);
    
        // Verificar si se obtuvieron resultados
        if (mysqli_num_rows($result) > 0) {
            echo "<h2 class='reporte-totales'>Reporte de Ventas Totales</h2>"; // Agregamos la clase CSS aquí
            echo "<table>";
            echo "<tr><th>Fecha</th><th>Código de Producto</th><th>Nombre de Producto</th><th>Cantidad</th><th>Monto</th></tr>";
            // Mostrar los resultados
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>{$row['fecha']}</td><td>{$row['idPlato']}</td><td>{$row['nombre_producto']}</td><td>{$row['cantidad']}</td><td>{$row['monto']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No hay datos disponibles.";
        }
    
        mysqli_close($conn);
    }
    
    
    
    public function generarReporteVentasPorPeriodo(){
        $conn = $this->conexion->connect();
    
        // Consulta SQL para obtener las ventas por período
        $query = "SELECT DATE_FORMAT(b.fecha, '%Y-%m-%d') AS periodo, SUM(dp.cantidad) AS cantidad, SUM(dp.cantidad * p.precio) AS monto_total 
                  FROM boleta b
                  INNER JOIN pedido pe ON b.idPedido = pe.idPedido
                  INNER JOIN detallepedido dp ON pe.idPedido = dp.idPedido
                  INNER JOIN plato p ON dp.idPlato = p.idPlato
                  GROUP BY periodo";
        $result = mysqli_query($conn, $query);
    
        // Verificar si se obtuvieron resultados
        if (mysqli_num_rows($result) > 0) {
            echo "<h2 class='reporte-periodo'>Reporte de Ventas por Período</h2>"; // Agregamos la clase CSS aquí
            echo "<table>";
            echo "<tr><th>Período</th><th>Cantidad</th><th>Monto Total</th></tr>";
            // Mostrar los resultados
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>{$row['periodo']}</td><td>{$row['cantidad']}</td><td>{$row['monto_total']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No hay datos disponibles.";
        }
    
        mysqli_close($conn);
    }
    
    
}

if (basename(__FILE__) === basename($_SERVER["SCRIPT_FILENAME"])){
    $controlador = new ControlEstadisticas();

    // Verificar qué acción se debe realizar
    if (isset($_GET['reporte'])) {
        if ($_GET['reporte'] == 'ventas_totales') {
            $controlador->generarReporteVentasTotales();
        } elseif ($_GET['reporte'] == 'ventas_por_periodo') {
            $controlador->generarReporteVentasPorPeriodo();
        }
    } else {
        $controlador->ejecutarPost();
    }
}
?>


