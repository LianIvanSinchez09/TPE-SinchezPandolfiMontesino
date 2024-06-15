/* CREATE DATABASE bdviajes; */

CREATE TABLE persona (
    documento varchar(15) ,
    nombre varchar(150), 
    apellido varchar(150), 
    PRIMARY KEY (documento)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE personaresponsable (    
    documento varchar(15),
    numeroEmpleado bigint AUTO_INCREMENT,    
    numeroLicencia bigint,
    PRIMARY KEY (numeroEmpleado),
    FOREIGN KEY (documento) REFERENCES persona (documento)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT = 1;

CREATE TABLE empresa (
    idEmpresa BIGINT AUTO_INCREMENT,
    nombre VARCHAR(150),
    direccion VARCHAR(150),
    PRIMARY KEY (idEmpresa)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

    CREATE TABLE viaje (
    idViaje BIGINT AUTO_INCREMENT,
    destino VARCHAR(150),
    cantMaxPasajeros INT,
    numeroEmpleado BIGINT,
    idEmpresa BIGINT,
    importe FLOAT,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES empresa(idEmpresa),
    FOREIGN KEY (numeroEmpleado) REFERENCES personaresponsable(numeroEmpleado)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1
    
    CREATE TABLE pasajero (
    idPasajero BIGINT AUTO_INCREMENT,
    documento VARCHAR(15),
    idViaje BIGINT AUTO_INCREMENT,
    telefono INT,
    PRIMARY KEY (idPasajero),
    FOREIGN KEY (documento) REFERENCES persona(documento)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idViaje) REFERENCES viaje(idViaje)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;