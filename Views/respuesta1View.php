<div id="contenedorRespuesta" class="contenedorRespuesta">
    <div class="tituloTema">
        <h1>Nueva Respuesta</h1>
        <form id="formInsercionRespuesta" class="bloque3" method="POST">
            <input type="hidden" id="id_usu" name="id_usu" value="1"> <!-- Cambia según sesión -->
            <input type="hidden" id="id_pub" name="id_pub" value="10"> <!-- ID de la publicación -->
            <input type="text" id="textoInsercionAutor" name="textoInsercionAutor" required class="campo3" placeholder="Autor">
            <textarea id="textoInsercionMensaje" name="textoInsercionMensaje" required class="campoTextArea" placeholder="Comentario"></textarea>
            <input type="submit" id="botonRespuesta" name="botonRespuesta" value="Enviar" class="boton1">
        </form>
        <a href="publicacion.php" class="volver">VOLVER A LAS PUBLICACIONES</a>
    </div>
    <div id="contenedor2" class="contenedor2"></div>
</div>
