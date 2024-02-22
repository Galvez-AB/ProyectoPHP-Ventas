<?php
    class formVerificacion{
        public function formVerificacionShow($codigo){
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
                <script>
                    function regresar() {window.history.back();}
                </script>
            </head>
            <body>
                <input type="hidden" name="txtCodigo" value="<?php echo $codigo; ?>">
                <div class="formulario">
                    <h1>Código de verificación</h1>
                    <form method="post" action="/ProyectoDSW/controllers/controlVerificacion.php">
                        <div>
                            Se ha enviado un código de verificación a su correo:
                        </div>
                        <div>
                            <input type="text" name="txtValidar" required>
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