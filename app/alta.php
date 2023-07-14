<?php 

    include("../manejoSesion.php");

    include ("./database.php");

    try {
        $dsn = "mysql:host=$host;dbname=$dbname"; 
        $dbh = new PDO($dsn, $user, $password);

        $codArt = $_POST["codArtAlta"];
        $familia = $_POST["familiaAlta"];
        $um = $_POST["umAlta"];
        $descripcion = $_POST["descripcionAlta"];
        $saldoStock = $_POST["saldoStockAlta"];
        $fechaAlta = $_POST["fechaAlta_Alta"];

        // Obtener el contenido del archivo PDF
        $contenidoPDF = null;
        if (isset($_FILES["pdfAlta"])) {
            if (!empty($_FILES["pdfAlta"]["name"])) {
                $contenidoPDF = file_get_contents($_FILES["pdfAlta"]["tmp_name"]);
            } else {
                // Manejo del caso en que no se seleccionó un archivo PDF
                $respuesta_estado = $respuesta_estado . "\nNo se eligió un archivo PDF.";
            }
        } else {
            // Manejo del caso en que la variable FILES no está inicializada
            $respuesta_estado = $respuesta_estado . "\nLa variable FILES no está inicializada.";
        }

        $sql = "INSERT INTO articulos (codArt, familia, um, descripcion, saldoStock, fechaAlta, archivo) 
                VALUES (:codArt, :familia, :um, :descripcion, :saldoStock, :fechaAlta, :archivo)";
        $stmt = $dbh->prepare($sql);

        $stmt->bindParam(':codArt', $codArt);
        $stmt->bindParam(':familia', $familia);
        $stmt->bindParam(':um', $um);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':saldoStock', $saldoStock);
        $stmt->bindParam(':fechaAlta', $fechaAlta);
        $stmt->bindParam(':archivo', $contenidoPDF, PDO::PARAM_LOB);

        $stmt->execute();

        if (!isset($_FILES["pdfAlta"])) {
            $respuesta_estado = $respuesta_estado . "\nNo se inicializó la variable FILES";
        } else {
            if (empty($_FILES["pdfAlta"]["name"])) {
                $respuesta_estado = $respuesta_estado . "\nNo se eligieron archivos PDF.";
            } else {
                $respuesta_estado = $respuesta_estado . "\nBuscando documento asociado al código de artículo $codArt";
                $contenidoPDF = file_get_contents($_FILES["pdfAlta"]["tmp_name"]);
                $sql = "UPDATE articulos SET archivo = :contenidoPdf WHERE codArt = :codArt";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(":contenidoPdf", $contenidoPDF);
                $stmt->bindParam(":codArt", $codArt);
                $stmt->execute();
                $respuesta_estado = $respuesta_estado . "\nPDF cargado";
            }
        }

        $dbh = null;
        $respuesta_estado = $respuesta_estado . "\nSe ha dado de alta al artículo. Vuelva a cargar los datos para visualizar los cambios.";
        echo $respuesta_estado;
    } 
    catch(PDOException $e) {
        $respuesta_estado = $respuesta_estado . "\nERROR: \n" . $e->getMessage();
        echo $respuesta_estado;
    }

?>