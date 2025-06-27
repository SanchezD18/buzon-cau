-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS buzon_cau;
USE buzon_cau;

-- Crear la tabla de solicitudes
CREATE TABLE IF NOT EXISTS solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    asunto VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    urgente INT(1) DEFAULT 0,
    tiempo TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('pendiente', 'en_proceso', 'completada', 'rechazada') DEFAULT 'pendiente'
);

-- Insertar algunos datos de ejemplo
INSERT INTO solicitudes (nombre, asunto, descripcion, urgente) VALUES
('Juan Pérez', 'Solicitud de información', 'Necesito información sobre los trámites disponibles', 0),
('María García', 'Problema técnico', 'No puedo acceder al sistema de citas', 1),
('Carlos López', 'Consulta general', '¿Cuáles son los horarios de atención?', 0); 