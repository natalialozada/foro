<?php
session_start();
$id_pub = $_GET['id_pub'] ?? null; // Obtener id_pub desde la URL
?>

<div id="contenedorRespuesta" class="contenedorRespuesta">
    <div class="tituloTema">
        <h1>Nueva Respuesta</h1>
        <form id="formInsercionRespuesta" class="bloque3" method="POST">
            <input type="hidden" id="id_pub" name="id_pub" value="<?php echo htmlspecialchars($id_pub); ?>"> <!-- Campo oculto para id_pub -->
            <input type="text" id="textoInsercion1" name="textoInsercion1" required class="campo4" value="<?php echo $_SESSION['usuario']; ?>" readonly>
            <input type="date" id="textoInsercionFecha" name="textoInsercionFecha" required class="campoFecha">
            <textarea id="textoInsercionMensaje" name="textoInsercionMensaje" required class="campoTextArea" placeholder="Comentario"></textarea>
            <input type="submit" id="botonRespuesta" name="botonRespuesta" value="Enviar" class="boton1">
        </form>
        <a href="publicacion.php" class="volver">VOLVER A LAS PUBLICACIONES</a>
    </div>
</div>

<div id="contenedor2" class="contenedor2"></div>
