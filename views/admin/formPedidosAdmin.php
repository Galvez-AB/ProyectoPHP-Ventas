<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: /ProyectoDSW/views/formHackeo.html");
    exit();
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
$menuAdmin=new formMenuAdmin();

$menuAdmin->mostrarCabecera();
$menuAdmin->mostrarBarraLateral();

//--------------ESTOS DATOS SON SOLO DE PRUEBA, LUEGO SE BORRA-------------------------------
//-------------------------------------------------------------------------------------------
$pedidos = [
    (object)[
        'nroPedido' => 1,
        'idPedido' => 101,
        'nombre' => 'Juan',
        'apellido' => 'Pérez',
        'direccion' => 'Calle Falsa 123',
        'montoTotal' => 150.00,
        'estado' => 'pendiente'
    ],
    (object)[
        'nroPedido' => 2,
        'idPedido' => 102,
        'nombre' => 'Ana',
        'apellido' => 'López',
        'direccion' => 'Avenida Siempreviva 456',
        'montoTotal' => 200.00,
        'estado' => 'en camino'
    ],
    (object)[
        'nroPedido' => 3,
        'idPedido' => 103,
        'nombre' => 'Juan',
        'apellido' => 'Pérez',
        'direccion' => 'Calle Falsa 123',
        'montoTotal' => 150.00,
        'estado' => 'pendiente'
    ],
    (object)[
        'nroPedido' => 4,
        'idPedido' => 104,
        'nombre' => 'Ana',
        'apellido' => 'López',
        'direccion' => 'Avenida Siempreviva 456',
        'montoTotal' => 200.00,
        'estado' => 'en camino'
    ],
];
//--------------ESTOS DATOS SON SOLO DE PRUEBA-----------------------------------------------
//-------------------------------------------------------------------------------------------


?>
<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/pedidosAdmin.css">
</head>
<body>
    <div class="contenedorPedidosAdmin">
        <div class="encabezadoPedidosAdmin">
            <img src="/ProyectoDSW/public/img/system/burgerTruck.png" alt="Hamburguesa">
            <h1>Panel de gestion de pedidos</h1>
        </div>
        <p>Los datos solo son para la simulacion.........</p>
        <table>
            <thead>
                <tr>
                    <th>NroPedido</th>
                    <th>IDPedido</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Monto</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pedidos as $pedido) {
                    $estadoActual = $_SESSION['estadosPedidos'][$pedido->idPedido] ?? $pedido->estado; 
                    echo "<tr class='{$claseEstado}'>
                            <td>{$pedido->nroPedido}</td>
                            <td>{$pedido->idPedido}</td>
                            <td>{$pedido->nombre}</td>
                            <td>{$pedido->apellido}</td>
                            <td>{$pedido->direccion}</td>
                            <td>\${$pedido->montoTotal}</td>
                            <td>
                                <form action='/ProyectoDSW/controllers/admin/controlPedidos.php' method='post'>
                                    <select name='estado' onchange='this.form.submit()'>
                                        <option value='pendiente' ".($estadoActual == 'pendiente' ? 'selected' : '').">Pendiente</option>
                                        <option value='en camino' ".($estadoActual == 'en camino' ? 'selected' : '').">En camino</option>
                                        <option value='entregado' ".($estadoActual == 'entregado' ? 'selected' : '').">Entregado</option>
                                    </select>
                                    <input type='hidden' name='idPedido' value='{$pedido->idPedido}'>
                                </form>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>