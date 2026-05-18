<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php if (isset($_POST["nombre"])) {
    ?>
        <h2>Hola <?= $_POST["nombre"] ?> elegiste el numero <?= $_POST["numero"] ?></h2>
        <a href="index.php"> Volver a la grilla</a><?php
                                                } else {

                                                    ?> <form action="index.php" method="post">
            <label for="idNombre">Ingrese su nombre: <input required type="text" name="nombre" id="idNombre"></label>

            <table>
                <?php
                                                    $impar = 1;
                                                    $par = 2;
                                                    for ($fila = 1; $fila < 11; $fila++) {
                ?> <tr> <?php for ($col = 1; $col  < 11; $col++) {

                                                            if ($fila % 2 == 0) {
                        ?> <td> <button type="submit" name="numero" value="<?= $par ?>"><?= $par ?></button></td><?php
                                                                                                                    $par += 2;
                                                                                                                } else { ?><td> <button type="submit" name="numero" value=<?= $impar ?>><?= $impar ?></button></td> <?php $impar += 2;
                                                                                                                                                                                                                }
                                                                                                                                                                                                                    ?>


                        <?php

                                                        }

                        ?>

                    </tr><?php
                                                    }
                            ?>

            </table>
        </form> <?php

                                                } ?>



</body>

</html>