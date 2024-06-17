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
    establecimiento_id INT
);

-- Crear la tabla Candidatos
CREATE TABLE Candidatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cv LONGBLOB NOT NULL
);

-- Crear la tabla Buzón
CREATE TABLE Buzon (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    movil VARCHAR(15) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tipoConsulta VARCHAR(255) NOT NULL,
    establecimiento INT NOT NULL,
    consulta TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear tabla calendario
CREATE TABLE Calendario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    dia_semana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes') NOT NULL,
    hora TIME NOT NULL,
    actividad VARCHAR(100) NOT NULL,
    duracion INT NOT NULL, -- Duración en minutos
    monitor VARCHAR(100) NOT NULL,
    descripcion TEXT,
    capacidad INT NOT NULL
);

-- Crear la tabla Reservas
CREATE TABLE Reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    actividad VARCHAR(100) NOT NULL,
    dia_semana ENUM('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes') NOT NULL,
    hora TIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id) ON DELETE CASCADE
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
(20, 'VivaGym Salamanca', 'Salamanca', 'Plaza Mayor, 12'),
(21, 'VivaGym Madrid 2', 'Madrid', 'Gran Vía, 45'),
(22, 'VivaGym Madrid 3', 'Madrid', 'Calle Mayor, 75'),
(23, 'VivaGym Madrid 4', 'Madrid', 'Calle Princesa, 89'),
(24, 'VivaGym Madrid 5', 'Madrid', 'Calle Goya, 120'),
(25, 'VivaGym Barcelona 2', 'Barcelona', 'Rambla de Catalunya, 150'),
(26, 'VivaGym Barcelona 3', 'Barcelona', 'Carrer de la Diputació, 279'),
(28, 'VivaGym Barcelona 5', 'Barcelona', 'Carrer de la Marina, 205'),
(29, 'VivaGym Valencia 2', 'Valencia', 'Calle del Marqués de Sotelo, 5'),
(30, 'VivaGym Valencia 3', 'Valencia', 'Calle de las Barcas, 18'),
(31, 'VivaGym Valencia 4', 'Valencia', 'Avenida del Puerto, 50'),
(32, 'VivaGym Valencia 5', 'Valencia', 'Calle del Mar, 29'),
(33, 'VivaGym Sevilla 2', 'Sevilla', 'Calle San Fernando, 1'),
(34, 'VivaGym Sevilla 3', 'Sevilla', 'Calle Tetuán, 8'),
(35, 'VivaGym Sevilla 4', 'Sevilla', 'Calle Alemanes, 16'),
(36, 'VivaGym Sevilla 5', 'Sevilla', 'Calle Luis Montoto, 55'),
(37, 'VivaGym Zaragoza 2', 'Zaragoza', 'Calle del Coso, 100'),
(38, 'VivaGym Zaragoza 3', 'Zaragoza', 'Avenida de Valencia, 15'),
(39, 'VivaGym Zaragoza 4', 'Zaragoza', 'Calle Alfonso I, 40'),
(40, 'VivaGym Zaragoza 5', 'Zaragoza', 'Avenida de Goya, 18'),
(41, 'VivaGym Málaga 2', 'Málaga', 'Avenida de Andalucía, 13'),
(42, 'VivaGym Málaga 3', 'Málaga', 'Calle Martínez, 9'),
(43, 'VivaGym Málaga 4', 'Málaga', 'Calle Carretería, 40'),
(44, 'VivaGym Málaga 5', 'Málaga', 'Calle Salitre, 11'),
(45, 'VivaGym Murcia 2', 'Murcia', 'Calle Trapería, 22'),
(46, 'VivaGym Murcia 3', 'Murcia', 'Calle Platería, 15'),
(47, 'VivaGym Murcia 4', 'Murcia', 'Calle Sagasta, 28'),
(48, 'VivaGym Murcia 5', 'Murcia', 'Avenida de la Libertad, 12'),
(49, 'VivaGym Palma 2', 'Palma', 'Calle San Miguel, 50'),
(50, 'VivaGym Palma 3', 'Palma', 'Calle Sindicato, 45'),
(51, 'VivaGym Palma 4', 'Palma', 'Calle Olmos, 32'),
(52, 'VivaGym Palma 5', 'Palma', 'Calle Barón de Pinopar, 20'),
(53, 'VivaGym Bilbao 2', 'Bilbao', 'Calle Ercilla, 25'),
(54, 'VivaGym Bilbao 3', 'Bilbao', 'Calle Ibáñez de Bilbao, 6'),
(55, 'VivaGym Bilbao 4', 'Bilbao', 'Calle Máximo Aguirre, 15'),
(56, 'VivaGym Bilbao 5', 'Bilbao', 'Calle Ledesma, 18'),
(57, 'VivaGym Alicante 2', 'Alicante', 'Calle del Teatro, 11'),
(58, 'VivaGym Alicante 3', 'Alicante', 'Calle San Fernando, 34'),
(59, 'VivaGym Alicante 4', 'Alicante', 'Calle del Pintor Lorenzo Casanova, 8'),
(60, 'VivaGym Alicante 5', 'Alicante', 'Calle Italia, 15'),
(61, 'VivaGym Córdoba 2', 'Córdoba', 'Calle Gondomar, 5'),
(62, 'VivaGym Córdoba 3', 'Córdoba', 'Calle Jesús María, 7'),
(63, 'VivaGym Córdoba 4', 'Córdoba', 'Calle Concepción, 14'),
(64, 'VivaGym Córdoba 5', 'Córdoba', 'Avenida de Cervantes, 3'),
(65, 'VivaGym Valladolid 2', 'Valladolid', 'Calle Mantería, 14'),
(66, 'VivaGym Valladolid 3', 'Valladolid', 'Calle Teresa Gil, 9'),
(67, 'VivaGym Valladolid 4', 'Valladolid', 'Calle de Santiago, 34'),
(68, 'VivaGym Valladolid 5', 'Valladolid', 'Paseo de Zorrilla, 54'),
(69, 'VivaGym Vigo 2', 'Vigo', 'Calle del Conde de Torrecedeira, 17'),
(70, 'VivaGym Vigo 3', 'Vigo', 'Calle Colón, 26'),
(71, 'VivaGym Vigo 4', 'Vigo', 'Calle de Urzáiz, 33'),
(72, 'VivaGym Vigo 5', 'Vigo', 'Calle de García Barbón, 45'),
(73, 'VivaGym Gijón 2', 'Gijón', 'Calle Asturias, 11'),
(74, 'VivaGym Gijón 3', 'Gijón', 'Calle Uría, 35'),
(75, 'VivaGym Gijón 4', 'Gijón', 'Avenida de la Costa, 21'),
(76, 'VivaGym Gijón 5', 'Gijón', 'Calle de Menéndez Valdés, 15'),
(77, 'VivaGym A Coruña 2', 'A Coruña', 'Calle San Andrés, 45'),
(78, 'VivaGym A Coruña 3', 'A Coruña', 'Calle Riego de Agua, 34'),
(79, 'VivaGym A Coruña 4', 'A Coruña', 'Calle Federico Tapia, 20'),
(80, 'VivaGym A Coruña 5', 'A Coruña', 'Calle Juan Flórez, 33'),
(81, 'VivaGym Granada 2', 'Granada', 'Calle Mesones, 12'),
(82, 'VivaGym Granada 3', 'Granada', 'Calle Puentezuelas, 16'),
(83, 'VivaGym Granada 4', 'Granada', 'Calle San Antón, 32'),
(84, 'VivaGym Granada 5', 'Granada', 'Calle Recogidas, 25'),
(85, 'VivaGym Elche 2', 'Elche', 'Calle del Maestro Albéniz, 3'),
(86, 'VivaGym Elche 3', 'Elche', 'Calle Jorge Juan, 10'),
(87, 'VivaGym Elche 4', 'Elche', 'Avenida de la Libertad, 12'),
(88, 'VivaGym Elche 5', 'Elche', 'Calle de la Victoria, 8'),
(89, 'VivaGym Oviedo 2', 'Oviedo', 'Calle General Elorza, 21'),
(90, 'VivaGym Oviedo 3', 'Oviedo', 'Calle Melquiades Álvarez, 25'),
(91, 'VivaGym Oviedo 4', 'Oviedo', 'Calle Campoamor, 16'),
(92, 'VivaGym Oviedo 5', 'Oviedo', 'Calle de Cervantes, 30'),
(93, 'VivaGym Santa Cruz de Tenerife 2', 'Santa Cruz de Tenerife', 'Calle Suárez Guerra, 10'),
(94, 'VivaGym Santa Cruz de Tenerife 3', 'Santa Cruz de Tenerife', 'Avenida de Anaga, 18'),
(95, 'VivaGym Santa Cruz de Tenerife 4', 'Santa Cruz de Tenerife', 'Calle Viera y Clavijo, 22'),
(96, 'VivaGym Santa Cruz de Tenerife 5', 'Santa Cruz de Tenerife', 'Avenida de las Islas Canarias, 11'),
(97, 'VivaGym Salamanca 2', 'Salamanca', 'Calle Toro, 19'),
(98, 'VivaGym Salamanca 3', 'Salamanca', 'Calle Zamora, 10'),
(99, 'VivaGym Salamanca 4', 'Salamanca', 'Calle Prior, 6'),
(100, 'VivaGym Salamanca 5', 'Salamanca', 'Calle Meléndez, 14');

-- Inserciones en la tabla Tarifas
INSERT INTO Tarifas (nombre, precio) VALUES
('Básica', 25.00),
('Zone', 30.00),
('Premium', 35.00);

-- Inserciones en la tabla Calendario
INSERT INTO Calendario (dia_semana, hora, actividad, duracion, monitor, descripcion, capacidad) VALUES
('Lunes', '08:00:00', 'Yoga', 60, 'Juan Pérez', 'Clase de yoga para principiantes.', 20),
('Lunes', '09:00:00', 'Pilates', 45, 'María Gómez', 'Pilates intermedio.', 15),
('Lunes', '10:00:00', 'Spinning', 50, 'Carlos López', 'Clase de spinning avanzada.', 25),
('Lunes', '11:00:00', 'CrossFit', 30, 'Ana Martínez', 'CrossFit para principiantes.', 20),
('Lunes', '12:00:00', 'Zumba', 60, 'Luis Rodríguez', 'Clase de Zumba divertida y energética.', 30),
('Lunes', '13:00:00', 'Body Pump', 45, 'Laura Sánchez', 'Entrenamiento de fuerza con pesas.', 20),
('Lunes', '14:00:00', 'Boxeo', 50, 'Miguel Fernández', 'Entrenamiento de boxeo.', 15),
('Lunes', '15:00:00', 'HIIT', 30, 'Sofía Ramírez', 'Entrenamiento de alta intensidad.', 25),
('Lunes', '16:00:00', 'Aeróbic', 60, 'Carlos González', 'Clase de aeróbic para todos los niveles.', 20),
('Lunes', '17:00:00', 'Kickboxing', 45, 'Patricia Torres', 'Entrenamiento de kickboxing.', 30),
('Lunes', '18:00:00', 'Bailes Latinos', 50, 'Diego Jiménez', 'Clase de bailes latinos.', 20),
('Lunes', '19:00:00', 'TRX', 30, 'Verónica Muñoz', 'Entrenamiento en suspensión TRX.', 15),
('Lunes', '20:00:00', 'Estiramientos', 60, 'Fernando Castro', 'Sesión de estiramientos y relajación.', 25),
('Lunes', '21:00:00', 'Yoga', 45, 'Juan Pérez', 'Clase de yoga para todos los niveles.', 20),

('Martes', '08:00:00', 'Pilates', 45, 'María Gómez', 'Pilates para principiantes.', 20),
('Martes', '09:00:00', 'Zumba', 60, 'Luis Rodríguez', 'Clase de Zumba enérgica.', 30),
('Martes', '10:00:00', 'Spinning', 50, 'Carlos López', 'Clase de spinning intermedia.', 25),
('Martes', '11:00:00', 'CrossFit', 30, 'Ana Martínez', 'CrossFit avanzado.', 20),
('Martes', '12:00:00', 'Yoga', 60, 'Juan Pérez', 'Clase de yoga avanzada.', 20),
('Martes', '13:00:00', 'Body Pump', 45, 'Laura Sánchez', 'Entrenamiento de fuerza.', 20),
('Martes', '14:00:00', 'Boxeo', 50, 'Miguel Fernández', 'Clase de boxeo intermedia.', 15),
('Martes', '15:00:00', 'HIIT', 30, 'Sofía Ramírez', 'HIIT para todos los niveles.', 25),
('Martes', '16:00:00', 'Aeróbic', 60, 'Carlos González', 'Clase de aeróbic intermedia.', 20),
('Martes', '17:00:00', 'Kickboxing', 45, 'Patricia Torres', 'Kickboxing avanzado.', 30),
('Martes', '18:00:00', 'Bailes Latinos', 50, 'Diego Jiménez', 'Clase de bailes latinos.', 20),
('Martes', '19:00:00', 'TRX', 30, 'Verónica Muñoz', 'TRX intermedio.', 15),
('Martes', '20:00:00', 'Estiramientos', 60, 'Fernando Castro', 'Clase de estiramientos.', 25),
('Martes', '21:00:00', 'Yoga', 45, 'Juan Pérez', 'Yoga intermedio.', 20),

('Miércoles', '08:00:00', 'Zumba', 60, 'Luis Rodríguez', 'Zumba para principiantes.', 30),
('Miércoles', '09:00:00', 'Pilates', 45, 'María Gómez', 'Clase de pilates.', 20),
('Miércoles', '10:00:00', 'Spinning', 50, 'Carlos López', 'Spinning avanzado.', 25),
('Miércoles', '11:00:00', 'CrossFit', 30, 'Ana Martínez', 'Clase de CrossFit.', 20),
('Miércoles', '12:00:00', 'Yoga', 60, 'Juan Pérez', 'Clase de yoga.', 20),
('Miércoles', '13:00:00', 'Body Pump', 45, 'Laura Sánchez', 'Body Pump para todos los niveles.', 20),
('Miércoles', '14:00:00', 'Boxeo', 50, 'Miguel Fernández', 'Boxeo intermedio.', 15),
('Miércoles', '15:00:00', 'HIIT', 30, 'Sofía Ramírez', 'HIIT avanzado.', 25),
('Miércoles', '16:00:00', 'Aeróbic', 60, 'Carlos González', 'Clase de aeróbic.', 20),
('Miércoles', '17:00:00', 'Kickboxing', 45, 'Patricia Torres', 'Kickboxing para principiantes.', 30),
('Miércoles', '18:00:00', 'Bailes Latinos', 50, 'Diego Jiménez', 'Bailes latinos intermedio.', 20),
('Miércoles', '19:00:00', 'TRX', 30, 'Verónica Muñoz', 'Clase de TRX.', 15),
('Miércoles', '20:00:00', 'Estiramientos', 60, 'Fernando Castro', 'Estiramientos para todos.', 25),
('Miércoles', '21:00:00', 'Yoga', 45, 'Juan Pérez', 'Yoga avanzado.', 20),

('Jueves', '08:00:00', 'Spinning', 50, 'Carlos López', 'Spinning para principiantes.', 25),
('Jueves', '09:00:00', 'Pilates', 45, 'María Gómez', 'Clase de pilates intermedio.', 20),
('Jueves', '10:00:00', 'Zumba', 60, 'Luis Rodríguez', 'Clase de Zumba avanzada.', 30),
('Jueves', '11:00:00', 'CrossFit', 30, 'Ana Martínez', 'CrossFit intermedio.', 20),
('Jueves', '12:00:00', 'Yoga', 60, 'Juan Pérez', 'Yoga para principiantes.', 20),
('Jueves', '13:00:00', 'Body Pump', 45, 'Laura Sánchez', 'Clase de Body Pump.', 20),
('Jueves', '14:00:00', 'Boxeo', 50, 'Miguel Fernández', 'Boxeo avanzado.', 15),
('Jueves', '15:00:00', 'HIIT', 30, 'Sofía Ramírez', 'HIIT intermedio.', 25),
('Jueves', '16:00:00', 'Aeróbic', 60, 'Carlos González', 'Clase de aeróbic.', 20),
('Jueves', '17:00:00', 'Kickboxing', 45, 'Patricia Torres', 'Kickboxing para todos.', 30),
('Jueves', '18:00:00', 'Bailes Latinos', 50, 'Diego Jiménez', 'Bailes latinos avanzados.', 20),
('Jueves', '19:00:00', 'TRX', 30, 'Verónica Muñoz', 'TRX para principiantes.', 15),
('Jueves', '20:00:00', 'Estiramientos', 60, 'Fernando Castro', 'Clase de estiramientos.', 25),
('Jueves', '21:00:00', 'Yoga', 45, 'Juan Pérez', 'Clase de yoga avanzada.', 20),

('Viernes', '08:00:00', 'Yoga', 60, 'Juan Pérez', 'Yoga para todos los niveles.', 20),
('Viernes', '09:00:00', 'Pilates', 45, 'María Gómez', 'Pilates avanzado.', 20),
('Viernes', '10:00:00', 'Spinning', 50, 'Carlos López', 'Clase de spinning.', 25),
('Viernes', '11:00:00', 'CrossFit', 30, 'Ana Martínez', 'Clase de CrossFit avanzada.', 20),
('Viernes', '12:00:00', 'Zumba', 60, 'Luis Rodríguez', 'Clase de Zumba.', 30),
('Viernes', '13:00:00', 'Body Pump', 45, 'Laura Sánchez', 'Body Pump avanzado.', 20),
('Viernes', '14:00:00', 'Boxeo', 50, 'Miguel Fernández', 'Boxeo para principiantes.', 15),
('Viernes', '15:00:00', 'HIIT', 30, 'Sofía Ramírez', 'HIIT avanzado.', 25),
('Viernes', '16:00:00', 'Aeróbic', 60, 'Carlos González', 'Aeróbic para todos los niveles.', 20),
('Viernes', '17:00:00', 'Kickboxing', 45, 'Patricia Torres', 'Clase de kickboxing.', 30),
('Viernes', '18:00:00', 'Bailes Latinos', 50, 'Diego Jiménez', 'Bailes latinos para principiantes.', 20),
('Viernes', '19:00:00', 'TRX', 30, 'Verónica Muñoz', 'Clase de TRX avanzada.', 15),
('Viernes', '20:00:00', 'Estiramientos', 60, 'Fernando Castro', 'Estiramientos avanzados.', 25),
('Viernes', '21:00:00', 'Yoga', 45, 'Juan Pérez', 'Clase de yoga.', 20);
