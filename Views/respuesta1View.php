<?php
session_start(); 
?>

<div id="contenedorRespuesta" class="contenedorRespuesta">
    <div class="tituloTema">
        <h1>Nueva Respuesta</h1>
        <form id="formInsercionRespuesta" class="bloque3" method="POST">
        <input type="text" id="textoInsercion1" name="textoInsercion1" required class="campo4"  value="<?php echo $_SESSION['usuario']; ?>" readonly>
            <textarea id="textoInsercionMensaje" name="textoInsercionMensaje" required class="campoTextArea" placeholder="Comentario"></textarea>
            <input type="submit" id="botonRespuesta" name="botonRespuesta" value="Enviar" class="boton1">
        </form>
        <a href="publicacion.php" class="volver">VOLVER A LAS PUBLICACIONES</a>
    </div>
    
</div>
<div id="contenedor2" class="contenedor2"></div>

</table>

