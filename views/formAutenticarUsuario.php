<head>
    <link rel="stylesheet" href="/ProyectoDSW/public/css/autenticarCrearUsuario.css">
</head>
<body>
    <div class="formulario">
        <h1>Inicio de sesión</h1>
        <form method="post" action="/ProyectoDSW/controllers/controlAutenticarUsuario.php">
            <div class="username">
                <input type="text" name="txtUser" required>
                <label>Correo electrónico</label>
            </div>
            <div class="username">
                <input type="password" name="txtPassword" required>
                <label>Contraseña</label>
            </div>
            <button class="boton" type="submit" name="btnIniciar">Iniciar</button>
        </form>
        <form method="post" action="/ProyectoDSW/controllers/controlAutenticarUsuario.php">
            <button class="boton" type="submit" name="btnRegistrar">Registrate</button>
        </form>
    </div>
</body>
