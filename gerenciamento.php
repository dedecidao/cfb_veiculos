<?php   # Rotina de checagem de sessão em duas partes, checa se a sessao existe e foi iniciada, 
        # logo apos testa se o numero coincide com o passado via GET NUM.
    session_start();
    if (isset($_SESSION['numLogin']) && !empty($_SESSION['numLogin']) ) {
        $n1 = $_GET["num"]; 
        $n2 = $_SESSION['numLogin'];

        if ($n1 != $n2) {
            echo "Operação não permitida";
            exit;
        }
    } else {
        echo "Operação não permitida, sessão não foi iniciada";
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/estilo.css">
    <title>CFB Veiculos</title>
    <!-- JQuery -->
    <script src="jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <?php
        include "topo.php";
        ?>
    </header>

    <section>
        <p>Menu de gerenciamento</p>
    </section>

    <!-- Um tipo de estilo de menu DROP DOWN! -->
    <!-- Um Id para cada botão principal para que ele mostre de fato os links -->
    <!-- Dropdown com varios links -> Formatação completa no arquivo CSS -->
    <nav>

        <div class="btmenu_adm">
            <button id="btcar"class="btmenu">Carros</button>
            <div id="car_drop" class="menudrop">
                <a href="novo_carro.php?num=<?php echo $n1 ?>">Novo</a>
                <a href="">Editar</a>
                <a href="">Excluir</a>
                <a href="marcas_modelos.php?num=<?php echo $n1 ?>">Marcas  /  Modelos</a>
            </div>
        </div>

        <div class="btmenu_adm">
            <button id="btslider" class="btmenu">Slider</button>
            <div id="slider_drop" class="menudrop">
                <a href="">Configurar</a>
            </div>
        </div>
        <!-- Acesso do ADM aos PAINEL COLABORES se SEU ACESSO == 0 !! -->
        <?php if($_SESSION['acesso'] == 0): ?>
            <div class="btmenu_adm">
                <button id="btusers" class="btmenu">Usuarios</button>
                <div id="users_drop" class="menudrop">
                    <a href="novo_usuario.php?num=<?php echo $n1; ?> ">Novo</a>
                    <a href="editar_usuario.php?num=<?php echo $n1; ?>">Editar</a>
                    <a href="excluir_usuario.php?num=<?php echo $n1; ?>">Excluir</a>
                </div>
            </div>
        <?php endif; ?> 

        <div class="btmenu_adm">
            <button id="btlogoff"class="btmenu">Logoff</button>
            <div id="logoff_drop" class="menudrop">
                <a href="">Sair</a>
            </div>
        </div>


    </nav>

    <!-- Jquery para controle de cliques dos botões do menu gerenciamento -->
    <script>
        $(document).ready(function () {
            $(".menudrop").css("visibility" , "hidden");
            // Cliques nos menus
            $("#btcar").click(function () {
                $(".menudrop").css("visibility" , "hidden");
                $("#car_drop").css("visibility" , "visible");
            });

            $("#btslider").click(function () {
                $(".menudrop").css("visibility" , "hidden");
                $("#slider_drop").css("visibility" , "visible");
            });

            $("#btusers").click(function () {
                $(".menudrop").css("visibility" , "hidden");
                $("#users_drop").css("visibility" , "visible");
            });

            $("#btlogoff").click(function () {
                $(".menudrop").css("visibility" , "hidden");
                $("#logoff_drop").css("visibility" , "visible");
            });
            // End Clicks Menu


            //Mouse in - Mouse Over Efeito
            $(".menudrop").mouseover(function () {
                $(this).css("visibility" , "visible");
            });
            $(".menudrop").mouseout(function () {
                $(this).css("visibility" , "hidden");
            });


        }); //End jQuery Ready
    </script>


</body>

</html>