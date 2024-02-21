<?php
    class formCrearUsuario{
        public function formCrearUsuarioShow(){
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
            </head>
            <body>
                <div class="formulario">
                    <h1>Registrate</h1>
                    <form method="post" action="/ProyectoDSW/controllers/controlCrearUsuario.php">
                        <div class="username">
                            <input type="text" name="txtNombre" required >
                            <label>Nombres</label>
                        </div>
                        <div class="username">
                            <input type="text" name="txtApellido" required >
                            <label>Apellidos</label>
                        </div>
                        <div class="username">
                            <input type="text" name="txtCorreo" required >
                            <label>Correo electrónico</label>
                        </div>
                        <div class="username">
                            <input type="password" name="txtPassword" required>
                            <label>Contraseña</label>
                        </div>
                        <div class="username">
                            <input type="password" name="txtPasswordC" required>
                            <label>Repetir contraseña</label>
                        </div>
                        <button type="submit" name="btnContinuar">Continuar</button>
                    </form>
                </div>



            </body>
            <?php
        }
    }

?>