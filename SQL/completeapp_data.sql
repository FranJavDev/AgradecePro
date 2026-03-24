USE completeapp;

-- pass is '123456' para todos los usuarios (texto plano por petición expresa)

INSERT INTO alumnos (id, nombre_completo, nickname, password, nombre_jesuita, imagen_jesuita, frase_jesuita, webalumno) VALUES
(1, 'Francisco Javier', 'fran', '123456', 'San Ignacio de Loyola', 'ignacio.jpg', 'En todo amar y servir', 'fran.com'),
(2, 'Maria Rodriguez', 'maria', '123456', 'San Francisco Javier', 'francisco.jpg', 'Da más el que da con amor', 'maria.com'),
(3, 'Carlos Martinez', 'carlos', '123456', 'Pedro Arrupe', 'arrupe.jpg', 'No me resigno a un mundo sin justicia', 'carlos.com'),
(4, 'Ana Garcia', 'ana', '123456', 'San Luis Gonzaga', 'luis.jpg', 'Quiero servir siempre', 'ana.com');

INSERT INTO agradecimientos (mensaje, idAlumnoEnvia, idAlumnoRecibe) VALUES
('Gracias por ayudarme con el código de base de datos ayer!', 1, 2),
('Eres la mejor, siempre dispuesta a echar una mano.', 3, 2),
('Excelente exposición, aprendí mucho.', 2, 1),
('Siempre me sacas una sonrisa, gracias.', 4, 3);
