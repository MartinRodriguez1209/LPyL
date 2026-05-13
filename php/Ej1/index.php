<?php 
require "script.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <h2>Numero pares</h2>
    <?php foreach ($pares as $n ): 
    echo "<span> $n </span>";
        endforeach;
     ?>
     <h2>Numero impares</h2>
       <?php foreach ($impares as $n ): 
    echo "<span> $n </span>";
        endforeach;
     ?>
     <h2>Numeros primos</h2>
       <?php foreach ($primos as $n ): 
    echo "<span> $n </span>";
        endforeach;
     ?>
</body>
</html>