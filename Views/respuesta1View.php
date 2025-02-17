<?php
if (isset($_GET['id_pub'])) {
    $idPublicacion = $_GET['id_pub'];
} else {
    echo "No se ha encontrado la publicación.";
    exit();
}
?>
<div id="contenedor1" class="contenedor1">
        <form id="formInsercionRespuesta" class="bloque1"></form>
    </div>
    

<div id="contenedorRespuesta" class="contenedorRespuesta">
    <div class="tituloTema">
        <h1>Nueva Respuesta</h1>
        <form id="formInsercionRespuesta" class="bloque3" method="POST">
            <input type="text" id="textoInsercionAutor" name="textoInsercionAutor" required class="campo3" placeholder="Autor">
            <textarea id="textoInsercionMensaje" name="textoInsercionMensaje" required class="campoTextArea" placeholder="Comentario"></textarea>
            <input type="submit" id="botonRespuesta" name="botonRespuesta" value="Enviar" class="boton1">
        </form>
        <a href="publicacion.php" class= "volver">VOLVER A LAS PUBLICACIONES</a>
    </div>
    <div id="contenedor2" class="contenedor2">
    </div>
</div>

    