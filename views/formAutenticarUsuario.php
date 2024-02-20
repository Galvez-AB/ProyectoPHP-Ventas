<?php
    class formAutenticarUsuario{
        public function formAutenticarUsuarioShow(){
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
                        <div class="username">
                            <input type="password" name="txtPassword" required>
                            <label>Contraseña</label>
                        </div>
                        <div class="recordar">
                            <a href="">¿Olvidaste tu contraseña?</a>
                        </div>
                        <button type="submit" name="btnIniciar">Iniciar</button>
                        <div class="registrarse">
                            <a href="">Registrate</a>
                        </div>
                    </form>
                </div>
            </body>
            <?php
        }
    }

?>