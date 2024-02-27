<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['usuario'])) {
    session_destroy();
    header("Location: /ProyectoDSW/views/formHackeo.html");
    exit();
}

$platos=$_SESSION['platos'];


include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
$menuAdmin=new formMenuAdmin();

$menuAdmin->mostrarCabecera();
$menuAdmin->mostrarBarraLateral();
?>
<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/productos.css">
</head>
<body>
    <div class="contenedor">
        <div class="header">
            <img src="/ProyectoDSW/public/img/system/hamburguesaProductos.png" alt="Hamburguesa" class="hamburguesa-img">
            <h1>BIENVENIDO A GESTIONAR PRODUCTOS</h1>
        </div>
        <div class="table-container">
            <table class="table">
                <thead class="bg-info">
                    <tr class="trhead">
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($platos as $plato): ?>
                        <tr>
                            <td><?= $plato['nombre'] ?></td>
                            <td><?= $plato['precio'] ?></td>
                            <td>
                                <img style="width:50px; height: 50px;"src="<?= $plato['imagen'] ?>">
                            </td>
                            <td>
                                <textarea class="descripcion" readonly><?= $plato['descripcion'] ?></textarea>
                            </td>
                            <td>
                                <?php
                                if ($plato['estado'] == 1) {
                                    echo "Disponible";
                                } else {
                                    echo "No disponible";
                                }
                                ?>
                            </td>
                            <td>
                                <form style="display: inline;" method="post" action="/ProyectoDSW/controllers/admin/controlProductos.php">
                                    <input type="hidden" name="id" value="<?= $plato['idPlato'] ?>">
                                    <button type="submit" name="btnmodificar" class="button-modificar">
                                        <img src="/ProyectoDSW/public/img/system/modificar.png" alt="Modificar">
                                    </button>
                                </form>
                                <form style="display: inline;" method="post" action="/ProyectoDSW/controllers/admin/controlProductos.php">
                                    <input type="hidden" name="id" value="<?= $plato['idPlato'] ?>">
                                    <button type="submit" name="btneliminar" class="button-eliminar">
                                        <img src="/ProyectoDSW/public/img/system/eliminar.png" alt="Eliminar">
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="post" action="/ProyectoDSW/controllers/admin/controlProductos.php" class="button-agregar">
                <button type="submit" name="btnagregar" value='agregar'>
                    <img src="/ProyectoDSW/public/img/system/agregar.png" alt="Agregar" class="agregar-img">
                    Agregar
                </button>
            </form>
        </div>
    </div>
</body>
</html>
