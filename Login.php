<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistema</title>
    <link rel="icon" type="image/png" href="Parte_Administrativa/IMG/SUKA.png">
    <link rel="stylesheet" href="Login.css">
</head>

<body>
    <img src="Parte_Administrativa/IMG/LOGO.png" alt="Logo" class="img-fluid" style="width: 20%; height: 20%;">
    <div class="login">
        <div class="login-screen">
            <div class="app-title">
                <h1>Iniciar sesión</h1>
            </div>

            <div class="login-form">
                <form id="loginForm" action="Validar.php" method="POST">
                    <div class="control-group">
                        <input type="text" class="login-field" name="username" placeholder="Nombre de usuario"
                            id="login-name">
                        <label class="login-field-icon fui-user" for="login-name"></label>
                        <div id="username-error" class="error-message"></div>
                    </div>

                    <div class="control-group">
                        <input type="password" class="login-field" name="password" placeholder="Contraseña"
                            id="login-pass">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                        <div id="password-error" class="error-message"></div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-large btn-block">Entrar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="Validacion.js"></script>
</body>

</html>