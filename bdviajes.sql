/* CREATE DATABASE bdviajes; */
CREATE TABLE persona (
    documento varchar(15),
    nombre varchar(150), 
    apellido varchar(150), 
    PRIMARY KEY (documento)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE personaResponsable (    
    documentoR varchar(15),
    numeroEmpleado bigint AUTO_INCREMENT,    
    numeroLicencia bigint,
    PRIMARY KEY (numeroEmpleado),
    FOREIGN KEY (documentoR) REFERENCES persona (documento)
    ON UPDATE CASCADE ON DELETE CASCADE
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;	

    CREATE TABLE empresa (
    idE bigint AUTO_INCREMENT,
    nombre varchar(150),
    direccion varchar(150),
    PRIMARY KEY (idE)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

    CREATE TABLE viaje (
    idV bigint AUTO_INCREMENT,
	destino varchar(150),
    cantMaxPasajeros int,
    numeroEmpleadoResponsable bigint,
    idEmpresa bigint,
    costoIndividualPasajero float,
    importeTotalPasajeros float,
    PRIMARY KEY (idV),
    FOREIGN KEY (idEmpresa) REFERENCES empresa (idE),
    FOREIGN KEY (numeroEmpleadoResponsable) REFERENCES personaResponsable (numeroEmpleado)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;
    
    CREATE TABLE pasajero (
    idP bigint AUTO_INCREMENT,
    documentoP varchar(15),	
	idViaje bigint,
    telefono int,
    numeroAsiento varchar(4),
    numeroTickect varchar(10),
    PRIMARY KEY (idP),
    FOREIGN KEY (documentoP) REFERENCES persona (documento)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idViaje) REFERENCES viaje (idV)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1; 

    CREATE TABLE standard (
    idPasajero bigint,
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (idPasajero) REFERENCES pasajero (idP)
    ON UPDATE CASCADE ON DELETE CASCADE	
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE vip (
    idPasajero bigint,	
    numeroViajeroFecuente int,
    cantidadMillas int,
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (idPasajero) REFERENCES pasajero (idP)
    ON UPDATE CASCADE ON DELETE CASCADE	
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;

    CREATE TABLE especial (
    idPasajero bigint,   
    requiereSillasRuedas varchar(10),
    requiereAsistencia varchar(10),
    requiereComidaEsecial varchar(10),
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (idPasajero) REFERENCES pasajero (idP) 
    ON UPDATE CASCADE ON DELETE CASCADE	   
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;