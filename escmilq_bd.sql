CREATE DATABASE escmilq_bd;

USE escmilq_bd;

CREATE TABLE mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    asunto VARCHAR(150) NOT NULL,
    mensaje TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE `contenido` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `programa_r` varchar(100) DEFAULT NULL,
  `programa_L` varchar(100) DEFAULT NULL,
  `id_materia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `faltas` (
  `id_profesor` int(11) DEFAULT NULL,
  `nom_materia` varchar(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `materia` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `NyA` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `contenido`
  ADD KEY `id_materia` (`id_materia`);
ALTER TABLE `faltas`
  ADD KEY `id_profesor` (`id_profesor`);

ALTER TABLE `contenido`
  ADD CONSTRAINT `contenido_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia` (`id`);
ALTER TABLE `faltas`
  ADD CONSTRAINT `faltas_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `profesores` (`id`);
