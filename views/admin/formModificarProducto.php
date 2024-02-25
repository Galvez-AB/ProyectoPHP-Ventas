<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

$plato=$_SESSION['plato'];

include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
$menuAdmin=new formMenuAdmin();

$menuAdmin->mostrarCabecera();
$menuAdmin->mostrarBarraLateral();
?>
<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/modificarProducto.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="container-modificar-productos">
    <header>
        <h1 class="h1">Modificar Productos</h1>
    </header>
    <div class="general">
        <div class="container-form">
            <div class="welcome">
                <div class="hamburgesa"> 
                    <img class="images" src="http://localhost/ProyectoDSW/public/img/system/hamburguesaModificar.png"> 
                </div>
            </div>

            <div class="container">
                <div class="formulario">
                    <form class="form" name="formAgregarProd" method="post" action="/ProyectoDSW/controllers/admin/controlModificarProducto.php" enctype="multipart/form-data">
                        <input type="hidden" name="idPlato" value="<?php echo $plato['idPlato']; ?>">
                        <div class="seccion">
                            <div>
                                <label>Nombre</label>
                                <input type="text" value="<?php echo $plato['nombre'];?>" readonly style="cursor: not-allowed;">
                            </div>
                            <div >
                                <label>Precio</label>
                                <input type="number"name="precio" value="<?php echo $plato['precio'];?>" required>
                            </div>
                            <div>
                                <label>Descripción</label>
                                <input type="text" name="descripcion" value="<?php echo $plato['descripcion'];?>" required>
                            </div>
                            <div>
                                <label>Imagen</label>
                                <input class="archivo" type="file" name="imagen">
                            </div>
                            <div>
                                <label>Estado</label>
                                <select class="estad" name="estado">
                                    <option value="1">Disponible</option>
                                    <option value="0">No disponible</option>
                                </select>
                            </div>
                            <div class="botones">
                                <button class="b1" type="submit" name="btnguardar">Guardar</button>
                                <button class="b2" type="button"  name="btncancelar" onclick="history.back()">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </div> 
</div>
</body>
