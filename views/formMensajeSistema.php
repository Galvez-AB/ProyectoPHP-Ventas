<?php
    class formMensajeSistema{
        public function formMensajeValidarDatosAdmin(){
            include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
            $menuAdmin = new formMenuAdmin();
            $menuAdmin->mostrarCabecera();
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/mensajeSistema.css">  
                <script>
                    function regresar() {window.history.back();}
                </script>
            </head>
            <body>
                <div class="container-mensaje-sistema">
                    <div class="modal">
                        <h1>Mensaje del Sistema</h1>
                        <img src="http://localhost/ProyectoDSW/public/img/system/alerta.jpg">
                        <p class="texto">¡ACCION NO PERMITIDA!</p>
                        <p> Hubo un problema al validar los datos </p>
                        <button id="aceptar" type="button" onclick="regresar()" >Aceptar</button>
                    </div> 
                </div>            
            </body><?php
            $menuAdmin->mostrarBarraLateral();
        }


        public function formMensajeProcesoCompleto($mensaje){?>
            <head>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '<?php echo $mensaje; ?>',
                        showConfirmButton: false,
                        timer: 2200
                    });
                </script>
            </body><?php
        }    


        public function formMensajeProcesoCompletoAdvertencia($mensaje){?>
            <head>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            </head>
            <body>
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: '<?php echo $mensaje; ?>',
                        showConfirmButton: false,
                        timer: 2200
                    });
                </script>
            </body><?php
        }


        public function formMensajeLoginError($titulo, $texto) {
            ?>
            <head>
                <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
                <script>
                    function regresar() {window.history.back();}
                </script>
            </head>
            <body>
                <div class="formulario">
                    <h1><?php echo $titulo; ?></h1>
                    <div>
                        <?php echo $texto; ?>
                    </div>
                    <button id="aceptar" type="button" onclick="regresar()" >Inicio</button>
                </div>
            </body>
            <?php
        }
    }
?>




































