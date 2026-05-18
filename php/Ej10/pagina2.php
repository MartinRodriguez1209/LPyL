<?php
$visitas = isset($_COOKIE["visitasSeccion2"]) ? $_COOKIE["visitasSeccion2"] : 0;
$visitas++;
$imagenes = [
    1 => "imagenLunes.jpg",
    2 => "imagenMartes.jpg",
    3 => "imagenMiercoles.jpg",
    4 => "imagenJueves.jpg",
    5 => "imagenViernes.jpg",
    6 => "imagenSabado.jpg",
    7 => "imagenDomingo.jpg"
];

$imagenDelDia = $imagenes[date("N")];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Bienvenido a la seccion 2</h1>
    <h2>Esta es su visita numero: <?php echo $visitas; ?></h2>
    <img src="" alt="<?php echo $imagenDelDia; ?>">
</body>

</html>

<?php
setcookie("visitasSeccion2", $visitas) ?>