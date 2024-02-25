<?php
    class formMenuAdmin{
        public function mostrarCabecera(){
            ?>
            <head>
                <link rel="icon" href="http://localhost/ProyectoDSW/public/img/system/iconoPW.png" />
                <title>BurgerFisi</title>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/cabecera.css">
            </head>
            <body>
                <div class="encabezado">
                    <div class="encabezado-izquierda">
                        <img src="/ProyectoDSW/public/icons/icon.svg">
                        <h1>B U R G E R - F I S I </h1>
                    </div>
                    <div class="encabezado-derecha">
                        <div class="informacion">
                        <p>¡Bienvenido(a), <?= $_SESSION['usuario']['nombre']?>!</p> 
                        </div>
                        <div class="icons">
                            <form method="post" action="/ProyectoDSW/controllers/admin/controlAdmin.php">
                                <img src="/ProyectoDSW/public/icons/mail.svg">
                                <img src="/ProyectoDSW/public/icons/user.svg">
                                <button type="submit" name="btnSalir">
                                    <img src="/ProyectoDSW/public/icons/exit.svg">
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            <?php
        }


        public function mostrarBarraLateral(){
            ?>
            <head>
            <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/barraLateral.css">
            </head>
            <body>
                <div class="barra-lateral">
                    <div class="titulo">
                        A D M I N I S T R A C I Ó N
                    </div>
                    <div class="logo">
                        <img src="/ProyectoDSW/public/img/system/logoAdmin.png">
                    </div>
                    <ul>
                        <li>  
                            <form method="post" action="/ProyectoDSW/controllers/admin/controlAdmin.php">
                                <button type="submit" name="btnInicio">
                                    <img src="/ProyectoDSW/public/icons/inicio.svg">
                                    <a>Inicio</a>
                                </button>
                            </form>
                        </li>
                        <li>  
                            <form method="post" action="/ProyectoDSW/controllers/admin/controlAdmin.php">
                                <button type="submit" name="btnProductos">
                                    <img src="/ProyectoDSW/public/icons/productos.svg">
                                    <a>Gestionar Productos</a>
                                </button>
                            </form>
                        </li>
                        <li>  
                            <form method="post" action="/ProyectoDSW/controllers/admin/controlAdmin.php">
                                <button type="submit" name="btnEstadisticas">
                                    <img src="/ProyectoDSW/public/icons/analytics.svg">
                                    <a>Mostrar estadisticas</a>
                                </button>
                            </form>
                        </li>
                        <li>  
                            <form method="post" action="/ProyectoDSW/controllers/admin/controlAdmin.php">
                                <button type="submit" id="btnPedidos">
                                    <img src="/ProyectoDSW/public/icons/pedidos.svg">
                                    <a>Gestionar pedidos</a>
                                </button>
                            </form>
                        </li>
                        <li>  
                            <form method="post" action="/ProyectoDSW/controllers/admin/controlAdmin.php">
                                <button type="submit" id="btnAyuda">
                                    <img src="/ProyectoDSW/public/icons/ayuda.svg">
                                    <a>Ayuda</a>
                                </button>
                            </form>
                        </li>
                    </ul>  
                </div>
            </body>
            </html>
            <?php
        }


        public function mostrarPieDePagina(){
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
            </head>
            <body>
                
            </body>
            </html>
            <?php
        }
    }
?>

