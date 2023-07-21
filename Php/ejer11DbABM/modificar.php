<?php 

    include ("./database.php");

    try {

        $dsn = "mysql:host=$host;dbname=$dbname"; 
        $dbh = new PDO($dsn, $user, $password);
        
        $codArt = $_POST["codArtModif"];
        $familia = $_POST["familiaModif"];
        $um = $_POST["umModif"];
        $descripcion = $_POST["descripcionModif"];
        $saldoStock = $_POST["saldoStockModif"];
        $fechaAlta = $_POST["fechaAltaModif"];
     

        $sql = "UPDATE articulos SET familia = :familia, um = :um, descripcion = :descripcion, saldoStock = :saldoStock, fechaAlta = :fechaAlta WHERE codArt = :codArt";
        $stmt = $dbh->prepare($sql);
        $respuesta_estado = $respuesta_estado . "\nPreparación exitosa.";
        $stmt->bindParam(':codArt', $codArt);
        $stmt->bindParam(':familia', $familia);
        $stmt->bindParam(':um', $um);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':saldoStock', $saldoStock);
        $stmt->bindParam(':fechaAlta', $fechaAlta);
        $respuesta_estado = $respuesta_estado . "\nBinding exitoso.";
        
        $stmt->execute();

        
        if(!isset($_FILES["pdfModif"]))
        {
            $respuesta_estado = $respuesta_estado . "\nNo se inicializó la variable FILES";
        }
        else
        {
            if(empty($_FILES["pdfModif"]["name"]))
            {
                $respuesta_estado = $respuesta_estado . "\nNo se eligieron archivos PDF.";
            }
            else
            {
                $respuesta_estado = $respuesta_estado . "\nBuscando documento asociado al codigo de artículo $codArt";
                $contenidoPDF = file_get_contents($_FILES["pdfModif"]["tmp_name"]);
                $sql = "UPDATE articulos SET archivo = :contenidoPdf WHERE codArt = :codArt";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(":contenidoPdf", $contenidoPDF);
                $stmt->bindParam(":codArt", $codArt);
                $stmt->execute();
            }
        }
        $respuesta_estado = $respuesta_estado . "\nEjecución exitosa.";
        $dbh = null;
        $respuesta_estado = $respuesta_estado . "\nSe ha modificado el artículo. Vuelva a cargar los datos para visualizar los cambios.";
        echo $respuesta_estado;
    }
    catch (PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\nERROR: \n" . $e->getMessage();
        echo $respuesta_estado;
    }

?>