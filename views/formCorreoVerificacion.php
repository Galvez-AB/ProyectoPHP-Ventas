<?php
    class formCorreoVerificacion{
        public function formCorreoValShow($codigo){
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
            </head>
            <body>
                <div class="formulario">
                    <h1>Código de verificación</h1>
                    <form method="post" action="/ProyectoDSW/controllers/controlAutenticarUsuario.php">
                        <div>
                            Se ha enviado un código de verificación a su correo:
                        </div>
                        <div class="username">
                            <input type="text" name="txtUser">
                            <label>Correo electrónico</label>
                        </div>
                        
                        
                        <button type="submit" name="btnVerificar">Verificar</button>
                        <button type="button" name="btnRegresar"  onclick="regresar()" >Regresar</button>
                    </form>
                </div>
            </body>
            <?php
        }
    }


?>