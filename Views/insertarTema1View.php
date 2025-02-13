
<?php
session_start(); 
?>

<div id="contenedorTema" class="contenedorTema">
    <div class="tituloTema">
        <h1>Nueva Publicación</h1>   
    </div>
    <form id="formSubidaArchivos" class="bloque3" method="POST">
    <input type="text" id="textoInsercion1" name="textoInsercion1" required class="campo4"  value="<?php echo $_SESSION['usuario']; ?>" readonly>
        <input type="text" id="titulo" name="titulo" required class="campo3" placeholder="Título">
        <textarea id="mensaje" name="mensaje" required class="campoTextArea" placeholder="Descripción"></textarea>
        <input type="date" id="fecha" name="fecha" required class="campoFecha">
        <input type="file" id="ficheroInsercion1" name="ficheroInsercion1" accept=".jpg, .jpeg, .png" required class="campoArchivo1">
        <input type="submit" id="botonInsercion2" name="botonInsercion2" value="Enviar" class="boton1">
    </form>
    <a href="publicacion.php" class="volver">VOLVER AL ÍNDICE</a>
</div>
<div id="contenedor2" class="contenedor2"></div>


