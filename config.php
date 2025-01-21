<?php
$host = "localhost";
$dbname = "parc";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=parc", "root", "", array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ));
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
