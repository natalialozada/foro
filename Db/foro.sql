CREATE DATABASE IF NOT EXISTS foroviajes;
USE foroviajes;

CREATE TABLE usuarios (
    id_usu INT AUTO_INCREMENT,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    contrasena VARCHAR(150),
    PRIMARY KEY (id_usu)
);

CREATE TABLE publicacion (
    id_pub INT AUTO_INCREMENT,
    titulo VARCHAR(100),
    fecha DATE,
    id_usu INT,
    contenido TEXT,
    num_respuestas INT DEFAULT 0,
    imagen VARCHAR(255),
    PRIMARY KEY (id_pub),
    FOREIGN KEY (id_usu) REFERENCES usuarios(id_usu) 
);

CREATE TABLE respuestas (
    id_res INT AUTO_INCREMENT,
    id_pub INT,  
    fecha DATE,
    id_usu INT,
    contenido TEXT,
    PRIMARY KEY (id_res),
    FOREIGN KEY (id_usu) REFERENCES usuarios(id_usu),
    FOREIGN KEY (id_pub) REFERENCES publicacion(id_pub) 
);
