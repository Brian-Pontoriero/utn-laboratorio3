<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base</title>
    <style>
        html, body{
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }
        p{
            display: inline;
        }
        h1, h2, h3{
            margin: 1%;
        }
        table{
            border-collapse: collapse;
            margin: 1%;
        }
    </style>
</head>
<body>
    <h2>Todo lo escrito fuera de las marcas de php es entregado en la respuesta http sin pasar por el procesador php.</h2>
    <hr>
    <?php
        echo "<h2>Todo texto y/o html <p style='color:blue'>entregado por el procesador php</p> usando la sentencia echo.</h2>";
        echo "<hr>";

        $miVariable = "valor 1";

        echo "<h2>Sin usar concatenador <p style='color:blue'>\$miVariable = </p>$miVariable</h2>";
        echo "<h2>Usando concatenador <p style='color:blue'>\$miVariable = </p>" . "$miVariable</h2>";
        echo "<hr>";

        $miVariable = true;
        echo "<h2>Variable de tipo booleanas o lógicas (verdadero) <p style='color:blue'> \$miVariable: </p>$miVariable</h2>";
        $miVariable = false;
        echo "<h2>Variable de tipo booleanas o lógicas (falso) <p style='color:blue'> \$miVariable: </p>$miVariable</h2>";
        echo "<hr>";

        define("MICONSTANTE","valorConstante");
        echo "<h2><p style='color:blue'>MICONSTANTE: </p>" . MICONSTANTE . "</h2>";
        echo "<h2>Tipo de <p style='color:blue'>MICONSTANTE: </p>" . gettype(MICONSTANTE) . "</h2>";
        echo "<hr>";

        $aSaludos = ["Hola","Hello"];

        echo "<h2>Arreglos:</h2>";
        echo "<h2><p style='color:blue'>\$aSaludos: </p>" . $aSaludos[0] . "</h2>";
        echo "<h2><p style='color:blue'>\$aSaludos: </p>" . $aSaludos[1] . "</h2>";
        echo "<h2>Tipo de <p style='color:blue'>\$aSaludos: </p>" . gettype($aSaludos) . "</h2>";

        echo "<h2>Se agregan por programa dos elementos nuevos</h2>";
        array_push($aSaludos,"Ciao");
        array_push($aSaludos,"Bonjour");

        echo "<h2>Todos los elementos originales y agregados:</h2>";
        
        echo "<ul>";
        foreach ($aSaludos as $saludo) {
            echo "<li>$saludo</li>";
        }
        echo "</ul>";

        echo "<h2>Arreglo de dos dimensiones (diccionario)</h2>";
        
        $aDiccionarioBasico = [];
        echo "<h3>La variable \$aDiccionarioBasico tiene el siguiente tipo: " . gettype($aDiccionarioBasico) . "</h3>";

        $aDespedidas = ["Adios  ", "Good bye", "Arrivederci", "Au revoir"];
        $aHogares = ["Casa  ", "House", "Cà·sa", "Maison"];

        array_push($aDiccionarioBasico, $aSaludos);
        array_push($aDiccionarioBasico, $aDespedidas);
        array_push($aDiccionarioBasico, $aHogares);
        
        echo "<table>";
        echo "<thead>";
        echo "<th>Español</th>";
        echo "<th>Inglés</th>";
        echo "<th>Italiano</th>";
        echo "<th>Francés</th>";
        echo "</thead>";
        foreach ($aDiccionarioBasico as $diccionario) {
            echo "<tbody>";
            echo "<tr>";
            foreach ($diccionario as $elemento) {
                echo "<td style='border: solid; background-color:lightblue;'>$elemento</td>";
            }
            echo "</tr>";
            echo "</tbody>";
        }
        echo "</table>";
        echo "<h2>También así se puede expresar el valor de \$aDiccionarioBasico[1][3]: " . $aDiccionarioBasico[1][3] . "</h2>";
        echo "<h2>Cantidad de elementos de diccionario: " . count($aDiccionarioBasico) . "</h2>";
        echo "<h1>Variables tipo arreglo asociativo</h1>";

        $renglonDeLiquidacion = ["legEmpleado" => "c0001", "apellido" => "Pontoriero", "salarioBasico" => 200000, "fechaIngreso" => "24/06/2023"];

        echo "<h3>Legajo del empleado: " . $renglonDeLiquidacion["legEmpleado"] . "</h3>";
        echo "<h3>Apellido: " . $renglonDeLiquidacion["apellido"] . "</h3>";
        echo "<h3>Salario básico: $" . $renglonDeLiquidacion["salarioBasico"] . "</h3>";
        echo "<h3>Fecha de ingreso: " . $renglonDeLiquidacion["fechaIngreso"] . "</h3>";
        echo "<hr>";

        echo "<h3>Expresiones aritméticas</h3>";

        $x = 3;
        $y = 4;

        $z = ($x + $y);
        $m = $x * $y;
        $d = $x / $y;

        echo "<h3>La variable \$x tiene el siguiente valor: $x</h3>";
        echo "<h3>La variable \$y tiene el siguiente valor: $y</h3>";
        echo "<h3>La variable \$x tiene el siguiente tipo: " . gettype($x) . "</h3>";
        echo "<h3>La variable \$y tiene el siguiente tipo: " . gettype($y) . "</h3>";
        echo "<h3>Así se imprime una expresión aritmética, por ejemplo de suma: (\$x + \$y) = $z</h3>";
        echo "<h3>Así se imprime una expresión aritmética, por ejemplo de multiplicación: \$x * \$y = $m</h3>";
        echo "<h3>Así se imprime una expresión aritmética, por ejemplo de división: \$x / \$y = $d</h3>";
        echo "<br>";
    ?>
</body>
</html>