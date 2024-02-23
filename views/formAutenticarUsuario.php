<head>
    <link rel="stylesheet" href="http://localhost/ProyectoDSW/public/css/autenticarUsuario.css">
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
            <div class="recordar">
                <a href="">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" name="btnIniciar">Iniciar</button>
        </form>
        <form method="post" action="/ProyectoDSW/controllers/controlAutenticarUsuario.php">
            <button type="submit" name="btnRegistrar">Registrate</button>
        </form>
    </div>
</body>
