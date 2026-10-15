<?php
$host    = "localhost";
$db_name = "toko";
$user    = "root";        
$pass    = "210207";            
$charset = "utf8mb4";
 
try {
    $dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>