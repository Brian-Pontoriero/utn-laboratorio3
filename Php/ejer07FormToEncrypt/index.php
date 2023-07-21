<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario para encriptar</title>
    <style>
        div{
            display: flex;
            justify-content: center;
            margin: 1%;
        }
        input{
            margin-left: 0.5%;
        }
    </style>
</head>
<body>
    <?php
        if (isset($_GET["clave"])){
            $variableAEncriptar = $_GET["clave"];

            echo "Clave: " . $variableAEncriptar . "<br><br>";
            echo "Clave encriptada en md5 (128 bits o 16 pares hexadecimales):<br>";

            $claveEncriptada = md5($variableAEncriptar);
            echo $claveEncriptada;

            echo "<br><br><br>";
            echo "Clave: " . $variableAEncriptar . "<br><br>";
            echo "Clave encriptada en sha1 (160 bits o 20 pares hexadecimales):<br>";
            
            $claveEncriptada = sha1($variableAEncriptar);
            echo $claveEncriptada;
        }
        else{
            echo "<form action='./index.php' method='get'>";
            echo "<div>";
            echo "<label for='clave'>Ingrese la clave a encriptar:</label>";
            echo "<input type='text' id='clave' name='clave' required>";
            echo "</div>";
            echo "<div>";
            echo "<button type='submit' id='enviar'>Obtener encriptación</button>";
            echo "</div>";
            echo "</form>";
        }
    ?>
</body>
</html>