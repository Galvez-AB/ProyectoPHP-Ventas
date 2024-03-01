<?php
class formPanelUsuario{
    public function formPanelCabecera(){
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/panelCabecera.css">
        </head>
        <body>
            <div class="PanelCabecera">
                    <div class="encabezado-izquierda">
                        <img src="http://localhost/ProyectoDSW/public/img/system/iconoPW.png">
                        <h1>B U R G E R - F I S I </h1>
                        <button class="botonInicio" >Inicio</button>
                    </div>
                    <div class="encabezado-derecha">
                        <div class="informacion">
                        </div>
                        <img src="http://localhost/ProyectoDSW/public/icons/user.svg">
                        <form action="http://localhost/ProyectoDSW/controllers/controlPanelUsuario.php" method="POST">
                            <button type="submit" name="accion" value="iniciarSesion">Iniciar Sesión</button>
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
        </head>
        <body>
            <div class="baner">
                <video autoplay muted loop class="video-fondo">
                    <source src="http://localhost/ProyectoDSW/public/videos/banerVideo.mp4" type="video/mp4">
                </video>
                <h1>Burger Fisi</h1>
                <h2>¡ B I E N V E N I D O !</h2>
                <h3>La hamburguesa para el cuerpo no es suficiente, <br>
                    debe haber una hamburguesa para el alma.</h3>
            </div>
            <div class="informacionExtra">
                <div class="info1">
                    <h1>¡ HOLA !</h1>
                    <p> Nos esforzamos por ofrecer<br>
                        experiencias culinarias <br>
                        excepcionales que deleiten <br>
                        el paladar y nutran el <br>
                        espíritu.</p>
                    </div>
                <div class="info2">
                    <h1>¡ CONOCENOS !</h1>
                    <p> En nuestra empresa nos <br>
                        dedicamos a servir <br>
                        hamburguesas deliciosas <br>
                        y nutritivas, preparadas <br>
                        con amor.</p>
                </div>
            </div>

            <div class="tituloVentas">
                <h1>Conoce a nuestos productos</h1>
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
                        <button class="carritoNulo">Agregar al Carrito</button>
                    </div>
                <?php } ?>
            </div>

        </body>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var botonesAgregar = document.querySelectorAll('.carritoNulo');
                botonesAgregar.forEach(function(boton) {
                    boton.addEventListener('click', function() {
                        Swal.fire({
                            title: "¡Iniciar Sesión!",
                            text: "Debe iniciar sesión para comprar",
                            icon: "warning",
                            position: 'center'
                        });
                    });
                });
            });
        </script>
        </html>
        <?php
    }
}

?>