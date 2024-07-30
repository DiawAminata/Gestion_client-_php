<?php
$host = 'localhost';
$db_name = 'clientele_gestion';
$username = 'root';
$password = '';
$db_port = 3306;

try {
    $db = new PDO("mysql:host=$host;port=$db_port;dbname=$db_name", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("SET NAMES utf8");
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
