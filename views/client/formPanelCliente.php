<?php
session_start(); 
class formPanelCliente{
    public function formPanelCabecera($nombreUsuario){
        $totalProductos = isset($_SESSION['carrito']) ? array_sum($_SESSION['carrito']) : 0;
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/panelCabecera.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">        </head>
            <script src=" https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <body>
            <div class="PanelCabecera">
                    <div class="encabezado-izquierda">
                        <img src="http://localhost/ProyectoDSW/public/img/system/iconoPW.png">
                        <h1>B U R G E R - F I S I </h1>
                        <form method="post" action="/ProyectoDSW/controllers/client/controlCliente.php">
                            <button class="botonInicio" type="submit" name="btnInicio">Inicio</button>
                        </form>
                        <form method="post" action="/ProyectoDSW/controllers/client/controlCliente.php">
                            <button class="botonPedidos" type="submit" name="btnPedidos">Pedidos</button>
                        </form>
                    </div>
                    <div class="encabezado-derecha">
                        <div class="carrito">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="contador-carrito"><?php echo $totalProductos; ?></span>
                        </div>
                        <img src="http://localhost/ProyectoDSW/public/icons/user.svg">
                        <span class="nombre-usuario"><?php echo htmlspecialchars($nombreUsuario, ENT_QUOTES, 'UTF-8'); ?></span>
                        <form action="http://localhost/ProyectoDSW/controllers/client/controlCliente.php" method="POST">
                            <button type="submit" name="btnSalir" value="salir">Salir</button>
                        </form>
                   </div>
            </div>
        </body>
        </html>
        <?php
    }
    public function formPanelMenu($productos){
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/panelMenu.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src=" https://code.jquery.com/jquery-3.7.1.min.js"></script>
        </head>
        <body>
            <div class="baner">
                <video autoplay muted loop class="video-fondo">
                    <source src="http://localhost/ProyectoDSW/public/videos/banerVideo.mp4" type="video/mp4">
                </video>
                <h1>Burger Fisi</h1>
                <h2>!! B I E N V E N I D O !!</h2>
                <h3>La hamburguesa para el cuerpo no es suficiente, <br>
                    debe haber una hamburguesa para el alma.</h3>
            </div>
            <div class="informacionExtra">
                <div class="info1">
                    <h1>!! HOLA !!</h1>
                    <p> Nos esforzamos por ofrecer<br>
                        experiencias culinarias <br>
                        excepcionales que deleiten <br>
                        el paladar y nutran el <br>
                        espíritu.</p>
                    </div>
                <div class="info2">
                    <h1>!! CONOCENOS !!</h1>
                    <p> En nuestra empresa nos <br>
                        dedicamos a servir <br>
                        hamburguesas deliciosas <br>
                        y nutritivas, preparadas <br>
                        con amor.</p>
                </div>
            </div>

            <div class="tituloVentas">
                <h1>Conoce a nuestos productos !!</h1>
            </div>

            <div class="VentaProductos">
                <?php foreach ($productos as $producto) { ?>
                    <div class="product-card">
                        <img src="<?php echo $producto['imagen']; ?>" alt="Imagen de <?php echo $producto['nombre']; ?>" class="product-image">
                        <h2 class="product-name"><?php echo $producto['nombre']; ?>
                        <img src="/ProyectoDSW/public/icons/star.svg"width="15" height="15">
                        <img src="/ProyectoDSW/public/icons/star.svg"width="15" height="15">
                        <img src="/ProyectoDSW/public/icons/star.svg"width="15" height="15"></h2>
                        <p class="product-price">$.<?php echo $producto['precio']; ?></p>
                        <p class="product-description"><?php echo $producto['descripcion']; ?></p>
                        <form  class="carritoForm" method="POST" action="/ProyectoDSW/controllers/client/controlCarrito.php">
                            <input type="hidden" name="idProducto" value="<?php echo $producto['idPlato']; ?>">
                            <button type="submit" class="carritoNew" name="agregarCarrito">Agregar al Carrito</button>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <script>
            $(document).ready(function(){
            $(".carritoNew").click(function(e){
                e.preventDefault();
                var idProducto = $(this).prev('input').val();
                $.ajax({
                url: '/ProyectoDSW/controllers/client/controlCarrito.php',
                type: 'post',
                data: {idProducto: idProducto, agregarCarrito: true},
                success: function(response) {
                    Swal.fire({
                        title: "¡Producto Agregado!",
                        text: "El producto ha sido agregado al carrito, lo puede ver en el apartado de pedidos",
                        icon: "success",
                        position: 'center'
                    });
                    var data = JSON.parse(response);
                    $(".contador-carrito").text(data.totalItems);
                }
                });
            });
            });
            </script>
        </body>
        </html>
        <?php
    }
    public function formPanelPedido($detallesCarrito){
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/panelPedido.css">
        </head>
        <body>
        <div class="PanelPedido">
            <h1>Detalles del Pedido</h1>
            <?php
            if (empty($detallesCarrito)) {
                echo "<p>No se agregó ningún producto en el carrito.</p>";
            } else {
                ?>
                <table>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                    <?php
                    $totalGeneral = 0;
                    foreach ($detallesCarrito as $producto) {
                        $nombre = $producto['nombre'];
                        $precio = $producto['precio'];
                        $cantidad = $producto['cantidad'];
                        $totalProducto = $precio * $cantidad;

                        echo "<tr>
                                <td>{$nombre}</td>
                                <td>\$.{$precio}</td>
                                <td>{$cantidad}</td>
                                <td>\$.{$totalProducto}</td>
                            </tr>";

                        $totalGeneral += $totalProducto;
                    }
                    ?>
                    <tr>
                        <td colspan="3"><strong>Total General</strong></td>
                        <td>$.<?php echo $totalGeneral; ?></td>
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
        <div class="panelPedidosBoton">
            <form method="POST" action="/ProyectoDSW/controllers/client/controlRealizarPedido.php">
                <?php
                // Envia los detalles del pedido
                foreach ($detallesCarrito as $producto) {
                    echo '<input type="hidden" name="productos[]" value="' . $producto['idPlato'] . '">';
                }
                ?>
                <button type="submit">Realizar el pedido</button>
            </form>
        </div>
        </body>
        </html>

        <?php
    }
   
}

?>