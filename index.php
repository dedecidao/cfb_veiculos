<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/estilo.css">
    <title>CFB Veiculos</title>
</head>

<body>
    <header>
        <?php
        include "topo.php";
        ?>
    </header>

    <section class="container" id="slider">
        <?php
        include "slider.html";
        ?>
    </section>

    <section class="container" id="buscador">
        <?php
        include "buscador.php";
        ?>
    </section>

    
    <section class="container" id="destaques">
        <?php
        include "destaques.html";
        ?>
    </section>

    <footer class="container">
        <?php
        include "rodape.html";
        ?>
    </footer>

</body>

</html>