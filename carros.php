<?php 
    include "conexao.php";
?>

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

    <section>
        <?php 
            $sql = "SELECT * from tb_carros";
            $res = mysqli_query($con, $sql);
            while($exibe = mysqli_fetch_array($res)){
                echo " Cod do carro " . $exibe['id_carro'] . "<br>" . 
                " marca do carro " . $exibe['id_marca'] . "<br>" . 
                " modelo do carro " . $exibe['id_modelo'] . "<br>" . 
                " versao do carro " . $exibe['versao'] . "<br>" . 
                " ano fav do carro " . $exibe['ano_fab'] . "<br>" . 
                " ano mod do carro " . $exibe['ano_mod'] . "<br>" . 
                " obs do carro " . $exibe['obs'] . "<br>" .
                //number_format(valor, casas_decimais, separador_dec. separador_milhar)
                " valor do carro R$" . number_format($exibe['valor'], 2, ',' ,'.')  . "<br>" . 
                " foto 1 do carro " . $exibe['foto1'] . "<br>" . 
                " foto 2 do carro " . $exibe['foto2'] . "<br>" . 
                " mini 1 do carro " . $exibe['mini1'] . "<br>" . 
                " mini 2 do carro " . $exibe['mini2'] . "<br>" . 
                " opc 1 do carro " . $exibe['opc1'] . "<br>" . 
                " opc 2 do carro " . $exibe['opc2'] . "<br>" . 
                " opc 3 do carro " . $exibe['opc3'] . "<br>" . 
                " carro foi vendido " . $exibe['vendido'] . "<br>" . 
                " carro foi bloqueado " . $exibe['bloqueado'] . "<hr>" ;
            }


        ?>
    </section>

    <footer class="container">
        <?php
        include "rodape.html";
        ?>
    </footer>

</body>

</html>