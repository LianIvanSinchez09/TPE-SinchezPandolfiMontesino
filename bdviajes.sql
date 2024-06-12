CREATE DATABASE bdviajes; 
    /*los FOREIGN KEY () son utilizados como puentes entre las tablas para saber en que parte estan guardada su informacion completa
    Por ejemplo: Persona va tener un id y toda su informacion, cuando se quiere crear el responsable tendra como foranea el id,
    gracias a ese podremos saber donde esta su informacion dentro de la tabla persona
    Hay que hacer solo un test
    Al querer crear un hijo, primero debo crarlo en el padre y, si se puede, ahi recien creo al hijo con todos sus datos*/
CREATE TABLE empresa(
    idempresa bigint AUTO_INCREMENT,
    enombre varchar(150),
    edireccion varchar(150),
    PRIMARY KEY (idempresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

    CREATE TABLE persona (
    documento VARCHAR(15),
    nombre VARCHAR(150),
    apellido VARCHAR(150),
    PRIMARY KEY (documento)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE responsable (
    documento VARCHAR(15),
    rnumeroempleado bigint AUTO_INCREMENT,
    rnumerolicencia bigint, 
    PRIMARY KEY (rnumeroempleado),
    FOREIGN KEY (documento) REFERENCES persona (documento) ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

    CREATE TABLE pasajero (
    documento varchar(15),
	ptelefono int, 
	idviaje bigint,
    PRIMARY KEY (documento),
    FOREIGN KEY (documento) REFERENCES persona (documento) 
    ON UPDATE CASCADE ON DELETE CASCADE
	FOREIGN KEY (idviaje) REFERENCES viaje (idviaje)/*se hace por una relacion de 1:1,para saber en que viaje esta el pasajero*/	
    
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
	
    CREATE TABLE viaje (
    idviaje bigint AUTO_INCREMENT, /*codigo de viaje*/
	vdestino varchar(150),
    vcantmaxpasajeros int,
	idempresa bigint,
    numeroempleado bigint,
    vimporte float,
    PRIMARY KEY (idviaje),
    FOREIGN KEY (idempresa) REFERENCES empresa (idempresa),
	FOREIGN KEY (numeroempleado) REFERENCES responsable (numeroempleado)
    ON UPDATE CASCADE
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
  
