<?php
$host = 'localhost';
$dbname = 'uts_pemnet';
$username = 'root';  
$password = 'baguskeren77';      
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());  
}
?>
