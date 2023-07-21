<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requerimiento</title>
    <style>
        table,td{
            border-style:inset;
        }
    </style>
</head>
<body>
    <?php
        echo "<h2>En este ejemplo se utiliza la función require() que ubica código php en el archivo ejemplo2.inc :</h2>";
        echo "<h2>Antes de insertar el require las variables declaradas en el mismo no existen<br>Las variables son:</h2>";

        echo $arreglo1;
        echo $arreglo1;
        echo $arreglo1;

        echo $arreglo2;
        echo $arreglo2;
        echo $arreglo2;

        echo "<h2>La longitud de los arreglos es: 0</h2>";
        
        require("./ejemplo2.inc");

        echo "<h2>Aquí ya se ejecutó la funcion require(). Cuando se usa require ocurre que si el archivo 'inc' no existe,
        la función devuelve un exception fatal error y la ejecución termina.</h2>";

        echo "<h2>Las dos variables de tipo array asociativo en el .inc son:</h2>";

        echo "<table>";
        echo "<tr>";
        foreach ($arreglo1 as $elemento) {
            echo "<td>$elemento</td>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach ($arreglo2 as $elemento) {
            echo "<td>$elemento</td>";
        }
        echo "</tr>";
        echo "</table>";

        echo "<h2>La longitud de los arreglos es: " . count($arreglo1) . "</h2>";
    ?>
</body>
</html>