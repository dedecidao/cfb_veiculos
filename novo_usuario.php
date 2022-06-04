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
        <h1>Novo Usuario</h1>
        <!-- PHP Rotina para o envio do formulario subsequente -->
        <?php

            if (isset($_GET['f_bt_novo_colaborador'])) {
                # Armazena os dados passados em varivaves
                $vnome = $_GET['f_name'];
                $vuser = $_GET['f_username'];
                $vsenha = $_GET['f_senha'];
                $vacesso = $_GET['f_acesso'];
                #Sql
                $sql = "INSERT INTO tb_colaboradores (nome,username,senha,acesso) 
                VALUES ('$vnome', '$vuser', '$vsenha' , $vacesso)";
                mysqli_query($con , $sql);
                $linhas = mysqli_affected_rows($con);
                #Output
                if ($linhas == 0) {
                    echo "<p>Falha ao gravar colaborador</p>";
                } else {
                    echo "<p>Colaborador Salvo com Sucesso.</p>";
                };

            }
            
        ?>

        <form action="novo_usuario.php" name="f_novo_colaborador" action="novo_usuario.php" class="f_colaborador" method="GET">
            <input type="hidden" name=num value="<?php echo $n1; ?>"> <!-- Campo Oculto que Passa A Variavel da Sessao -->
            <label for="">Nome</label>
            <input type="text" name="f_name" maxlength="50" size="50" required="required"> 
            <label for="">UserName</label>
            <input type="text" name="f_username" maxlength="50" size="50" required="required"> 
            <label for="">Senha</label>
            <input type="text" name="f_senha" maxlength="50" size="50" required="required"> 
            <label for="">Tipo de Acesso</label>
            <input type="text" name="f_acesso" maxlength="50" size="50" required="required" pattern="[0-1]+$" placeholder="0 ou 1" title="0 ou 1"> 

            <input type="submit" name="f_bt_novo_colaborador" class="btmenu" value="Gravar">

        </form>


    </section>



</body>

</html>