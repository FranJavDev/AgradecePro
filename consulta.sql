CREATE TABLE prueba_alumno (
    Id INT NOT NULL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    nombreJesuita VARCHAR(100) NOT NULL,
    img VARCHAR(255) NOT NULL,
    frase TEXT NOT NULL,
    webAlumno VARCHAR(255) UNIQUE
);

INSERT INTO prueba_alumno (id, nombre, passwd, nombreJesuita, img, frase, webAlumno)
VALUES 
(01, 'Juan Pérez García', '1234', 'Ignacio de Loyola', 'juan_perez.jpg', 'En todo amar y servir.', 'juanperez'),
(02, 'María Rodríguez López', 'admin123', 'Francisco Javier', 'maria_rod.jpg', 'Id y prended fuego al mundo.', 'mrodriguez'),
(03, 'Carlos Ruiz Zafón', 'qwerty', 'Alberto Hurtado', 'cruiz.jpg', 'Contento, Señor, contento.', 'zafonweb'),
(04, 'Ana Belén Cano', 'password', 'Pedro Arrupe', 'ab_cano.jpg', 'No me resigno a que el mundo sea así.', 'anacano'),
(05, 'Luis Miguel Herranz', '1111', 'San Estanislao', 'lherranz.jpg', 'Para la mayor gloria de Dios.', 'luismiguel');
