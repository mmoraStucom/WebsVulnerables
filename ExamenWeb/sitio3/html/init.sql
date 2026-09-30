CREATE DATABASE IF NOT EXISTS enterprise;
USE enterprise;

CREATE TABLE crew (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    rank_title VARCHAR(50) NOT NULL,
    clearance VARCHAR(20) NOT NULL
);

INSERT INTO crew (name, rank_title, clearance) VALUES
('James T. Kirk', 'Captain', 'TOP SECRET'),
('Spock', 'Commander', 'SECRET'),
('Uhura', 'Lieutenant', 'CONFIDENTIAL'),
('Montgomery Scott', 'Chief Engineer', 'SECRET'),
('Leonard McCoy', 'Chief Medical Officer', 'SECRET'),
('Hikaru Sulu', 'Helmsman', 'CONFIDENTIAL'),
('Pavel Chekov', 'Navigator', 'CONFIDENTIAL');

CREATE TABLE ship_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stardate VARCHAR(20) NOT NULL,
    entry TEXT NOT NULL,
    author VARCHAR(100) NOT NULL
);

INSERT INTO ship_logs (stardate, entry, author) VALUES
('2266.1', 'Arrived at planet Vulcan for diplomatic mission.', 'Captain Kirk'),
('2266.3', 'Encountered Klingon warbird near the Neutral Zone.', 'Spock'),
('2266.5', 'Engine repairs completed. Warp drive back online.', 'Scotty'),
('2266.7', 'Medical bay reports all crew in good health.', 'Dr. McCoy');

-- Tabla para mensajes de tripulación (vulnerable a XSS stored)
CREATE TABLE crew_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    stardate VARCHAR(20) NOT NULL
);

INSERT INTO crew_messages (author, message, stardate) VALUES
('Spock', 'Análisis de sensores completado. No se detectan anomalías en el sector.', '2266.8'),
('Dr. McCoy', '¡Soy médico, no un ingeniero! Pero los sistemas médicos están operativos.', '2266.9');

-- Tabla de administradores (profesor)
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    session_token VARCHAR(64) DEFAULT NULL
);

INSERT INTO admin_users (username, password) VALUES
('kirk', 'Starfl33t#1701');
