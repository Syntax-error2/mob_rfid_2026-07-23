<?php
define('DB_HOST2', '127.0.0.1');
define('DB_NAME2', 'mob_rfid_dtr');
define('DB_USER2', 'root');
define('DB_PASS2', '');
define('DB_CHARSET2', 'utf8mb4');

try {
    $conn2 = new PDO(
        'mysql:host='.DB_HOST2.';dbname='.DB_NAME2.';charset='.DB_CHARSET2,
        DB_USER2,
        DB_PASS2,
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
