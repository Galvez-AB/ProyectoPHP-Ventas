<?php
    class formVerificacion{
        public function formVerificacionShow($usuario,$codigo){
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
                <script>
                    function regresar() {window.history.back();}
                </script>
            </head>
            <body>
                <div class="formulario">
                    <h1>Código de verificación</h1>
                    <form method="post" action="/ProyectoDSW/controllers/controlVerificacion.php">
                        <input type="hidden" name="txtCodigo" value="<?php echo $codigo; ?>">
                        <input type="hidden" name="nombre" value="<?php echo $usuario['nombre']; ?>">
                        <input type="hidden" name="apellido" value="<?php echo $usuario['apellido']; ?>">
                        <input type="hidden" name="txtCorreo" value="<?php echo $usuario['correo']; ?>">
                        <input type="hidden" name="txtPassword" value="<?php echo $usuario['password']; ?>">
                        <div>
                            Se ha enviado un código de verificación al correo: <?php echo $usuario['correo']; ?>
                        </div>
                        <div>
                            <label>Correo electrónico</label>
                            <input type="text" name="txtValidar" required>
                            
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