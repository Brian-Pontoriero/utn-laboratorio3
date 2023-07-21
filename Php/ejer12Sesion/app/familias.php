<?php

    include("../manejoSesion.php");
    
    include("./database.php");
    
    try
    {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $dbh = new PDO($dsn, $user, $password);

        $sql = "SELECT * FROM familias";
        $stmt = $dbh->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $familias=[];

        while($fila = $stmt->fetch()) {
            $objFamilia = new stdClass();
            $objFamilia->nombre=$fila['nombre'];
            $objFamilia->descripcion=$fila['descripcion'];

            array_push($familias,$objFamilia);
        }

        $objFamilias = new stdClass();
        $objFamilias->familias=$familias;
        $objFamilias->cuenta=count($familias);
        $salidaJson = json_encode($objFamilias);
        $dbh = null;

     
        echo $salidaJson;
    }
    catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\n" . $e->getMessage();
    }
    
?>


