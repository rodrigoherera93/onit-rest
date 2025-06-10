<?php
// onit-rest/db.php

require_once __DIR__ . '/config.php';

/**
 * Establishes a database connection using PDO.
 *
 * @return PDO|null Returns a PDO connection object on success, or null on failure.
 */
function getDbConnection() {
    $host = DB_HOST;
    $db   = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Log the error or handle it as needed
        // For example, you might log to a file or display a generic error message
        error_log("Database Connection Error: " . $e->getMessage());
        // In a production environment, you might not want to expose detailed error messages.
        // Consider throwing a custom exception or returning null.
        return null;
    }
}
?>
