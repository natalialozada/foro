<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FORO VIAJES | INICIO SESIÓN</title>
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
                    <h2>Iniciar Sesión</h2>
                    <form action="" id="formInicia">
                    <input type="text" name="correo" id="correo" placeholder="Correo Electrónico">
                    <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña">
                    <input type="submit" value="Iniciar Sesión" id="botonInicio">
                    <a href="registro.php">¿No tienes cuenta? Registrate</a>
                    <div id="resultadoInicia"></div>
                    </form>
                </div>
            </div>
           
        </div>
     </div>
  </body>
</html>
