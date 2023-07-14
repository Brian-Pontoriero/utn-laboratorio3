<?php
$dbname = "beehkr99hkml66vltjbj";
$host = "beehkr99hkml66vltjbj-mysql.services.clever-cloud.com";
$user = "uav7jlcswtvjsre2";
$password = "OpNTUfCa8bhSi2DAKwBm";
$respuesta_estado = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>