/* CREATE DATABASE bdviajes; */

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Crear tabla persona
    CREATE TABLE persona (
    documento VARCHAR(15),
    nombre VARCHAR(150), 
    apellido VARCHAR(150), 
    PRIMARY KEY (documento)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Crear tabla personaresponsable
    CREATE TABLE personaresponsable (
    documento VARCHAR(15),
    numeroEmpleado BIGINT,    
    numeroLicencia BIGINT,
    PRIMARY KEY (documento),
    FOREIGN KEY (documento) REFERENCES persona (documento)
    ON UPDATE CASCADE ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Crear tabla empresa
    CREATE TABLE empresa (
    idEmpresa BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150),
    direccion VARCHAR(150),
    PRIMARY KEY (idEmpresa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- Crear tabla viaje
    CREATE TABLE viaje (
    idViaje BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    destino VARCHAR(150),
    cantMaxPasajeros INT,
    numeroEmpleado BIGINT UNSIGNED,
    idEmpresa BIGINT UNSIGNED,
    importe FLOAT,
    PRIMARY KEY (idViaje),
    FOREIGN KEY (idEmpresa) REFERENCES empresa(idEmpresa)
    ON UPDATE CASCADE ON DELETE SET NULL,
    FOREIGN KEY (numeroEmpleado) REFERENCES personaresponsable(numeroEmpleado)
    ON UPDATE CASCADE ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

    
    CREATE TABLE pasajero (
    documento VARCHAR(15),
    idViaje BIGINT UNSIGNED,  -- Asegurar que este campo es UNSIGNED
    telefono BIGINT,
    PRIMARY KEY (documento),
    FOREIGN KEY (documento) REFERENCES persona(documento)
    ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (idViaje) REFERENCES viaje(idViaje)
    ON UPDATE CASCADE ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

COMMIT;