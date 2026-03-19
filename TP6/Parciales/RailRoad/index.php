<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <section>
        <article>
            <?php
            include 'funciones.php';
            cargaPagina();
            ?>
            <div id="contenedor-servicios" class="oculto tabla-scroll-contenedor">
                <table class="tabla-moderna">
                    <caption id="titulo-tabla"></caption>
                    <thead id="header-tabla"></thead>
                    <tbody id="cuerpo-tabla"></tbody>
                </table>
            </div>
        </article>
    </section>

    <script src="script.js"></script>
</body>

</html>