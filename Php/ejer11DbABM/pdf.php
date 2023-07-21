<?php 

    include ("./database.php");

    try
    {
        $dsn = "mysql:host=$host;dbname=$dbname"; 
        $dbh = new PDO($dsn, $user, $password);

        $codArt = $_GET["codArt"];

        $sql = "SELECT archivo FROM articulos WHERE codArt = :codArt";

        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':codArt', $codArt);
        
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $fila = $stmt->fetch();
        $objArticulo = new stdClass;
        $objArticulo->documentoPDF = base64_encode($fila["archivo"]);
        $salidaJSON = json_encode($objArticulo, JSON_INVALID_UTF8_SUBSTITUTE);
        echo $salidaJSON;
        $dbh = null;

    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }

?>