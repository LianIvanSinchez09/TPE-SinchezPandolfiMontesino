/* CREATE DATABASE bdviajes; */
CREATE TABLE persona (
    documento varchar(15),
    nombre varchar(150), 
    apellido varchar(150), 
    PRIMARY KEY (documento)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE personaResponsable (    
    documento varchar(15),
    numeroEmpleado bigint AUTO_INCREMENT,    
    numeroLicencia bigint,
    PRIMARY KEY (numeroEmpleado),
    FOREIGN KEY (documento) REFERENCES persona (documento)
    ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;	

    CREATE TABLE empresa (
    idEmpresa bigint AUTO_INCREMENT,
    nombre varchar(150),
    direccion varchar(150),
    PRIMARY KEY (idEmpresa)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

    CREATE TABLE viaje (
    idViaje bigint AUTO_INCREMENT,
	destino varchar(150),
    cantMaxPasajeros int,
    numeroEmpleadoResponsable bigint,
    idEmpresa bigint,
    costoIndividualPasajero float,
    importeTotalPasajeros float,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES empresa (idEmpresa),
    FOREIGN KEY (numeroEmpleadoResponsable) REFERENCES personaResponsable (numeroEmpleado)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
    
    CREATE TABLE pasajero (
    idPasajero bigint AUTO_INCREMENT,
    documento varchar(15),	
	idViajeiaje bigint,
    telefono int,
    numeroAsiento varchar(4),
    numeroTickect varchar(10),
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (documento) REFERENCES persona (documento)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idViajeiaje) REFERENCES viaje (idViaje)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1; 

    CREATE TABLE standard (
    idPasajero bigint,
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (idPasajero) REFERENCES pasajero (idPasajero)
    ON UPDATE CASCADE ON DELETE CASCADE	
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE vip (
    idPasajero bigint,	
    numeroViajeroFecuente int,
    cantidadMillas int,
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (idPasajero) REFERENCES pasajero (idPasajero)
    ON UPDATE CASCADE ON DELETE CASCADE	
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE especial (
    idPasajero bigint,   
    requiereSillasRuedas varchar(10),/* No seria mejor una variable que se llame necesidad y de ahi escribir la necesidad?*/
    requiereAsistencia varchar(10),
    requiereComidaEsecial varchar(10),
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (idPasajero) REFERENCES pasajero (idPasajero) 
    ON UPDATE CASCADE ON DELETE CASCADE	   
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
