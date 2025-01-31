<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOROVIAJES | REGISTRO</title>
    <link rel="stylesheet" href="Assets/css/style.css">
    <script src="Assets/js/motor.js" defer></script>
</head>

<body>
    <div class="contenedorPrincipal">
    <div class="titulo">
            <img src="Assets/img/foro.png" alt="mapa" class="logo">
        </div>
        <div class="menu">
            <div class="contenedorInicioSesion">
                <div class="contenedorDatos">
                    <h2>Regístrate</h2>
                    <form action="" id="formRegistro">
                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" >
                        <input type="text" name="correo" id="correo" placeholder="Correo Electrónico" >
                        <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" >
                        <input type="submit" value="Registrarse" id="botonRegistro">
                        <a href="index.php">Iniciar Sesión</a>
                        <div id="resultadoRegistro" class="resultadoRegistro"> </div>
                    </form>

                </div>
               
            </div>
            
        </div>
    </div>
    
</body>

</html>