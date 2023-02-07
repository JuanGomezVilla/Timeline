-- CREAR LA BASE DE DATOS
CREATE DATABASE rankingJuego CHARACTER SET utf8 COLLATE utf8_general_ci;

-- SELECCIONAR LA BASE
USE rankingJuego;

-- CREACIÓN DE TABLAS
CREATE OR REPLACE TABLE jugadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(3),
    puntos INT
) ENGINE=InnoDB;

CREATE OR REPLACE TABLE mazos (
    nombre VARCHAR(50) PRIMARY KEY,
    descripcion VARCHAR(200)
) ENGINE=InnoDB;

CREATE OR REPLACE TABLE cartas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mazo VARCHAR(50),
    tiempo INT,
    evento VARCHAR(50),    
    FOREIGN KEY cartas(mazo) REFERENCES mazos(nombre)
) ENGINE=InnoDB;


-- CREACIÓN DE PROCEDIMIENTOS


-- INSERTAR VALORES DE PRUEBA
INSERT INTO jugadores (nombre) VALUES ("AAA");
INSERT INTO jugadores (nombre) VALUES ("AAB");
INSERT INTO jugadores (nombre) VALUES ("AAC");
INSERT INTO jugadores (nombre) VALUES ("ABA");
INSERT INTO jugadores (nombre) VALUES ("ABB");
INSERT INTO jugadores (nombre) VALUES ("ABC");

INSERT INTO mazos VALUES ("Retamar", "Descripción del mazo con nombre Retamar");
INSERT INTO mazos VALUES ("Egipto", "Descripción del mazo con nombre Egipto");
INSERT INTO mazos VALUES ("Europa", "Descripción del mazo con nombre Europa");
INSERT INTO mazos VALUES ("Japuta", "Descripción del mazo con nombre Japuta");

INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2001, "Evento 1");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2002, "Evento 2");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2003, "Evento 3");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2004, "Evento 4");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2005, "Evento 5");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2006, "Evento 6");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2007, "Evento 7");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2008, "Evento 8");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Retamar", 2009, "Evento 9");

INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2001, "Evento 1");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2002, "Evento 2");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2003, "Evento 3");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2004, "Evento 4");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2005, "Evento 5");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2006, "Evento 6");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2007, "Evento 7");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2008, "Evento 8");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Egipto", 2009, "Evento 9");

INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2001, "Evento 1");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2002, "Evento 2");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2003, "Evento 3");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2004, "Evento 4");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2005, "Evento 5");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2006, "Evento 6");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2007, "Evento 7");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2008, "Evento 8");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Europa", 2009, "Evento 9");

INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2001, "Evento 1");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2002, "Evento 2");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2003, "Evento 3");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2004, "Evento 4");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2005, "Evento 5");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2006, "Evento 6");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2007, "Evento 7");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2008, "Evento 8");
INSERT INTO cartas (mazo, tiempo, evento) VALUES ("Japuta", 2009, "Evento 9");