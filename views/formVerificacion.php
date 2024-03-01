<?php
if (session_status() == PHP_SESSION_NONE)
    session_start();

if (!isset($_SESSION['candidato'])) {
    session_destroy();
    header("Location: /ProyectoDSW/views/formAutenticarUsuario.php");
    exit();
}

?>
<head>
    <link rel="stylesheet" href="/ProyectoDSW/public/css/autenticarCrearUsuario.css">
    <script>
        function validarFormulario() {
            var numero = document.getElementById('numero').value;
            if (isNaN(numero) || numero.length !== 5) {
                alert('El código debe tener 5 dígitos.');
                return false; 
            }
            return true;
        }
    </script>
</head>
<body>
    <div class="formulario">
        <h1>Código de verificación</h1>
        <form method="post" action="/ProyectoDSW/controllers/controlVerificacion.php" onsubmit="return validarFormulario()">
            <div>
                Se ha enviado un código de verificación al correo: <?= $_SESSION['candidato']['correo'] ?>
            </div>
            <div>
                <label>Código de verificación: </label>
                <input type="text" name="txtCodigo" pattern="\d{5}" title="El código debe tener 5 dígitos." required>
            </div>
            <button type="submit" name="btnVerificar">Verificar</button>
            <button type="button" name="btnRegresar"  onclick="history.back()" >Regresar</button>
        </form>
    </div>
</body>