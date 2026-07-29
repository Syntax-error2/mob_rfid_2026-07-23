
<?php

date_default_timezone_set('Asia/Manila');

$host = '127.0.0.1';
$db   = 'mob_rfid_dtr';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $conn = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
     throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$sf_query = $conn->prepare("SELECT * FROM school_preferences");
$sf_query->execute();
$sf_row = $sf_query->fetch();
        
?>

