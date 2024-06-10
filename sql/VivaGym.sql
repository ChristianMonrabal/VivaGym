-- Crear la base de datos VivaGym
CREATE DATABASE VivaGym;
USE VivaGym;

-- Crear la tabla Establecimientos
CREATE TABLE Establecimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    ciudad VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL
);

-- Crear la tabla Tarifas
CREATE TABLE Tarifas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL
);

-- Crear la tabla Usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    dni VARCHAR(20) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    sexo ENUM('M', 'F', 'Otro') NOT NULL,
    numero_telefono VARCHAR(20),
    fecha_nacimiento DATE,
    pais VARCHAR(100),
    codigo_postal VARCHAR(10),
    ciudad VARCHAR(100),
    numero_tarjeta VARCHAR(20) NOT NULL,
    fecha_caducidad_tarjeta DATE NOT NULL,
    cvv_tarjeta VARCHAR(4) NOT NULL,
    establecimiento_id INT,
    FOREIGN KEY (establecimiento_id) REFERENCES Establecimientos(id)
);

-- Inserciones en la tabla Establecimientos
INSERT INTO Establecimientos (id, nombre, ciudad, direccion) VALUES
(1, 'VivaGym Madrid', 'Madrid', 'Calle de Alcalá, 200'),
(2, 'VivaGym Barcelona', 'Barcelona', 'Carrer de Balmes, 123'),
(3, 'VivaGym Valencia', 'Valencia', 'Calle de Colón, 42'),
(4, 'VivaGym Sevilla', 'Sevilla', 'Avenida de la Constitución, 15'),
(5, 'VivaGym Zaragoza', 'Zaragoza', 'Paseo de la Independencia, 24'),
(6, 'VivaGym Málaga', 'Málaga', 'Calle Larios, 8'),
(7, 'VivaGym Murcia', 'Murcia', 'Gran Vía Alfonso X el Sabio, 5'),
(8, 'VivaGym Palma', 'Palma', 'Avenida de Jaume III, 10'),
(9, 'VivaGym Bilbao', 'Bilbao', 'Gran Vía de Don Diego López de Haro, 22'),
(10, 'VivaGym Alicante', 'Alicante', 'Avenida de Maisonnave, 33'),
(11, 'VivaGym Córdoba', 'Córdoba', 'Calle Cruz Conde, 14'),
(12, 'VivaGym Valladolid', 'Valladolid', 'Calle Santiago, 21'),
(13, 'VivaGym Vigo', 'Vigo', 'Calle del Príncipe, 35'),
(14, 'VivaGym Gijón', 'Gijón', 'Calle Corrida, 25'),
(15, 'VivaGym A Coruña', 'A Coruña', 'Calle Real, 48'),
(16, 'VivaGym Granada', 'Granada', 'Calle Reyes Católicos, 17'),
(17, 'VivaGym Elche', 'Elche', 'Calle Reina Victoria, 8'),
(18, 'VivaGym Oviedo', 'Oviedo', 'Calle Uría, 20'),
(19, 'VivaGym Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 'Calle del Castillo, 32'),
(20, 'VivaGym Salamanca', 'Salamanca', 'Plaza Mayor, 12');

-- Inserciones en la tabla Tarifas
INSERT INTO Tarifas (nombre, precio) VALUES
('Básica', 25.00),
('Zone', 30.00),
('Premium', 35.00);
