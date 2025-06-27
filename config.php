<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_PORT', '3306'); // Puerto por defecto de MySQL
define('DB_NAME', 'buzon_cau');
define('DB_USER', 'root');
define('DB_PASS', '');

// Función para conectar a la base de datos
function conectarDB() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8";
        $pdo = new PDO($dsn, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch(PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?> 