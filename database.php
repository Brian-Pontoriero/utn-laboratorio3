<?php
    $dbname = "beehkr99hkml66vltjbj";
    $host = "beehkr99hkml66vltjbj-mysql.services.clever-cloud.com";
    $user = "uav7jlcswtvjsre2";
    $password = "OpNTUfCa8bhSi2DAKwBm";
    $respuesta_estado = "";

    try {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $dbh = new PDO($dsn, $user, $password); /*Database Handle*/
        $respuesta_estado = $respuesta_estado . "\nconexion exitosa";
    }
    catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }
        
?>