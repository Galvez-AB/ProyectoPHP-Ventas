<?php
    class formCrearUsuario{
        public function formCrearUsuarioShow(){
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
            </head>
            <body>
                <div class="formulario">
                    <h1>Inicio de sesión</h1>
                    <form method="post" action="/ProyectoDSW/controllers/controlAutenticarUsuario.php">
                        <div class="username">
                            <input type="text" name="txtUser" required >
                            <label>Usuario</label>
                        </div>
                    </form>
                </div>



            </body>
            <?php
        }
    }

?>