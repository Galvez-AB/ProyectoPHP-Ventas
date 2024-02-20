<?php
class formAgregarProd{
    private $menuAdmin;


    public function __construct() {
        include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/admin/formMenuAdmin.php');
        $this->menuAdmin = new formMenuAdmin();
    }


    public function formAgregarProductosShow(){
        $this->menuAdmin->mostrarCabecera();
        $this->menuAdmin->mostrarBarraLateral();
        ?>
        
        <head>
            <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/agregarProducto.css">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src = "http://localhost/ProyectoDSW/public/js/regresar.js"></script>
            <script>
                function mostrarVistaPrevia(input) {
                    var vistaPrevia = document.getElementById('vistaPrevia');
                    var archivo = input.files[0];
                    var lector = new FileReader();
                    lector.onload = function(e) {
                        vistaPrevia.src = e.target.result;
                    };
                    lector.readAsDataURL(archivo);
                }
            </script>
        </head>
        <body>
            <div class="container-agregar-productos">
                <header>
                    <h1 class="h1">Agregar Productos</h1>
                </header>
                <div class="general">
                    <div class="container-form">
                        <div class="welcome">
                            <div class="hamburgesa"> 
                                <img class="images" src="http://localhost/ProyectoDSW/public/img/system/hamburguesaAgregar.png"> 
                            </div>
                        </div>
                        <div class="container">
                            <div class="formulario">
                                <form class="form" name="formAgregarProd" method="post" action="/ProyectoDSW/controllers/admin/controlAgregarProducto.php" enctype="multipart/form-data">
                                    <div class="seccion">
                                        <div>
                                            <label>Nombre</label>
                                            <input type="text" name="nombre">
                                        </div>
                                        <div>
                                            <label>Precio</label>
                                            <input type="number" name="precio">
                                        </div>
                                        <div>
                                            <label>Descripción</label>
                                            <input type="text" name="descripcion">
                                        </div>
                                        <div>
                                            <label>Imagen</label>
                                            <input class="archivo" type="file" name="imagen" onchange="mostrarVistaPrevia(this);">
                                            <div class="vista-previa">
                                                <div class="vista-previa-imagen">
                                                    <img id="vistaPrevia" src="#" alt="Vista previa de la imagen">
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <label>Estado</label>
                                            <select class="estad" name="estado">
                                                <option value="1">Disponible</option>
                                                <option value="0">No disponible</option>
                                            </select>
                                        </div>
                                        <div class="botones">
                                            <button id="btnguardar" class="b1" type="submit" name="btnguardar">Guardar</button>
                                            <button class="b2" type="button" name="btncancelar" onclick="regresar()" >Cancelar </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>  
                </div> 
            </div>
        </body>
        <?php
    }
}
?>
