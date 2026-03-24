CREATE DATABASE IF NOT EXISTS completeapp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE completeapp;

-- Tabla alumnos
CREATE TABLE IF NOT EXISTS alumnos (
    id INT NOT NULL, -- Número de puesto, clave principal, NO autoincrement
    nombre_completo VARCHAR(150) NOT NULL,
    nickname VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Hasheada
    nombre_jesuita VARCHAR(100) NOT NULL,
    imagen_jesuita VARCHAR(255) DEFAULT 'default_jesuita.png',
    frase_jesuita TEXT,
    webalumno VARCHAR(100) UNIQUE,
    PRIMARY KEY (id)
);

-- Tabla agradecimientos
CREATE TABLE IF NOT EXISTS agradecimientos (
    idagradecimiento INT AUTO_INCREMENT,
    mensaje TEXT NOT NULL,
    idAlumnoEnvia INT NOT NULL,
    idAlumnoRecibe INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (idagradecimiento),
    FOREIGN KEY (idAlumnoEnvia) REFERENCES alumnos(id) ON DELETE CASCADE,
    FOREIGN KEY (idAlumnoRecibe) REFERENCES alumnos(id) ON DELETE CASCADE,
    CONSTRAINT chk_diferente CHECK (idAlumnoEnvia <> idAlumnoRecibe),
    CONSTRAINT uk_agradecimiento UNIQUE (idAlumnoEnvia, idAlumnoRecibe) -- Solo 1 agradecimiento por alumno
);
