-- Insertar 5 alumnos de ejemplo
INSERT INTO alumnos (equipo, nombre, usuario, password, nombreJesuita, infoJesuita, web, foto) VALUES
('01', 'Juan Perez', 'juanp', 'pass123', 'San Ignacio de Loyola', 'Fundador de la Compañía de Jesús.', 'juanperez', 'juan.jpg'),
('02', 'Maria Garcia', 'mariag', 'pass123', 'San Francisco Javier', 'Misionero en Asia.', 'mariagarcia', 'maria.jpg'),
('03', 'Carlos Ruiz', 'carlosr', 'pass123', 'Pedro Arrupe', 'General de la Compañía.', 'carlosruiz', 'carlos.jpg'),
('04', 'Laura Gomez', 'laurag', 'pass123', 'Ignacio Ellacuria', 'Mártir de El Salvador.', 'lauragomez', 'laura.jpg'),
('05', 'Daniel Soto', 'daniels', 'pass123', 'Papa Francisco', 'Primer Papa jesuita.', 'danielsoto', 'daniel.jpg');

-- Insertar 3 agradecimientos de ejemplo
INSERT INTO agradecimientos (mensaje, idEmisor, idReceptor) VALUES
('Gracias por tu ayuda con el proyecto, fue fundamental.', '01', '02'),
('Ha sido un placer trabajar contigo este trimestre.', '03', '04'),
('Aprecio mucho tus consejos para mejorar en programación.', '05', '01');
