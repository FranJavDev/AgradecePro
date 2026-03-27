-- Para que os sirva el script de inserción masiva de alumnos.
-- Añado el campo foto, aunque no se use en la aplicación.
CREATE TABLE alumnos (
	equipo char(2) NOT NULL PRIMARY KEY,
	nombre varchar(40) NOT NULL,
	usuario varchar(20) NOT NULL UNIQUE, -- Nombre con el que se inicia sesión. Sin espacios
	password varchar(20) NOT NULL,
	nombreJesuita varchar(100) NOT NULL,
	infoJesuita varchar(250)NOT NULL,
	web varchar(30) NOT NULL UNIQUE, -- Nombre de la carpeta, que debe tener un archivo index.php, más el css y la imagen del jesuita.	
	foto varchar(20) NULL -- La añado para que os sirvan las inserciones masivas
);

CREATE TABLE agradecimientos (
    idAgradecimiento smallint unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
	mensaje varchar(300) NOT NULL,
	idEmisor char(2) NOT NULL,
	idReceptor char(2) NOT NULL,
	fecha_hora timestamp default NOW(),
	CONSTRAINT CK_diferentes CHECK (idEmisor!=idReceptor ),
	CONSTRAINT FK_emisor FOREIGN KEY (idEmisor) REFERENCES alumnos (equipo),
	CONSTRAINT FK_receptor FOREIGN KEY (idReceptor) REFERENCES alumnos (equipo)

);

CREATE UNIQUE INDEX IX_agradecimientoUnico ON agradecimientos(idEmisor,idReceptor);


