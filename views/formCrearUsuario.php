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
                    <form method="post" action="/ProyectoDSW/controllers/controlAutenticarUsuario.php">
                        <div class="username">
                            <input type="text" name="txtUser" required >
                            <label>Nombres</label>
                        </div>
                        <div class="username">
                            <input type="text" name="txtUser" required >
                            <label>Apellidos</label>
                        </div>
                        <div class="username">
                            <input type="text" name="txtUser" required >
                            <label>Correo electrónico</label>
                        </div>
                        <div class="username">
                            <input type="password" name="txtPassword" required>
                            <label>Contraseña</label>
                        </div>
                        <div class="username">
                            <input type="password" name="txtPassword" required>
                            <label>Repetir contraseña</label>
                        </div>
                        <button type="submit" name="btnIniciar">Iniciar</button>
                    </form>
                </div>



            </body>
            <?php
        }
    }

?>