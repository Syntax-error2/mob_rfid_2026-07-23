<?php
define('DB_HOST3', '127.0.0.1');
define('DB_NAME3', 'mob_rfid_dtr');
define('DB_USER3', 'root');
define('DB_PASS3', '');
define('DB_CHARSET3', 'utf8mb4');

try {
    $conn3 = new PDO(
        'mysql:host='.DB_HOST3.';dbname='.DB_NAME3.';charset='.DB_CHARSET3,
        DB_USER3,
        DB_PASS3,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed.");
}
?>
