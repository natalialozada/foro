<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}
?>

<div class="contenedorSesion">
    <div class="usuario">
        Hola, <?php echo $_SESSION["usuario"]; ?>
    </div>
    <a href="Views/cerrarSesion.php" class="cerrarSesion">Cerrar Sesión</a>
</div>

<div id="contenedor0" class="contenedor0">
    <div class="titulo">
        <img src="Assets/img/foro.png" alt="mapa" class="foto">
    </div>

    <div class="linkPublicacion">
        <a href="insertarTema.php" class="añadir">AÑADIR UN NUEVO TEMA ✏️ </a>
        <a href="borrarPublicacion.php" class="añadir">ELIMINAR PUBLICACIÓN ❌</a>
    </div>

    <div id="contenedor1" class="contenedor1">
        <form id="formInsercion2" class="bloque1"></form>
    </div>
    
    <div id="contenedor2" class="contenedor2"></div>
</div>
