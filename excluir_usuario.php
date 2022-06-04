<?php # Rotina de checagem de sessão em duas partes, checa se a sessao existe e foi iniciada, logo apos testa se o numero coincide com o passado via GET NUM
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
    #Session Success

    #Conexao ao Banco
    include('conexao.php');
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

    <section id="main">
        <a href="gerenciamento.php?num=<?php echo $n1; ?> " target="self" class="btmenu" >Voltar</a> <!-- Sempre passando a variavel da sessao armazenada em num pelas paginas" -->
        <h1>Excluir Usuario</h1>
        <!-- PHP Rotina para o envio do formulario subsequente -->
        <?php

            if (isset($_GET['f_bt_excluir_colaborador'])) {
                $vid = $_GET['f_colaboradores'];
                $sql = "DELETE FROM tb_colaboradores WHERE id_colaborador=$vid";
                mysqli_query($con, $sql);
                $linhas = mysqli_affected_rows($con);
                if ($linhas >= 1) {
                    echo "<p>Colaborador Deletado</p>";
                } else {
                    echo "<p>Erro ao deletar</p>";
                }
            }
            
        ?>

        <form name="f_excluir_colaborador" action="excluir_usuario.php" class="f_colaborador" method="GET">
            <input type="hidden" name=num value="<?php echo $n1; ?>"> <!-- Campo Oculto que Passa A Variavel da Sessao -->
            <label for="">Selecione o Colaborador:</label>

            <select name="f_colaboradores" id="" size="10">

                 <!-- Rotina a ser puxada pelo php -->
                <?php
                $sql = "SELECT * FROM tb_colaboradores";
                $dados = mysqli_query($con, $sql); #Armazena em colaboradores os dados do banco
                
                while ($colaborador = mysqli_fetch_array($dados)) { #Extração de linhas do banco de dados em formato de vetor
                    //echo "<option value='" . $colaborador['id_colaborador'] . "'> "'. $colaborador['nome'] . "</option>""; 
                    echo "<option value='"  .$colaborador['id_colaborador'].  "'  >"   .    $colaborador['nome']    .   "</option>"; 
                          # String 1            #Indice 1 - Value              Indice 2 - Campo Option           
                        //<option value="                            ">                                          </option>       
                } 

                ?>
                
            </select>

            <input type="submit" name="f_bt_excluir_colaborador" class="btmenu" value="Excluir">

        </form>


    </section>



</body>

</html>