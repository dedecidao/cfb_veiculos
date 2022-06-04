<?php # Rotina de checagem de sessão em duas partes, checa se a sessao existe e foi iniciada, logo apos testa se o numero coincide com o passado via GET NUM
session_start();
if (isset($_SESSION['numLogin']) && !empty($_SESSION['numLogin'])) {
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
        <a href="gerenciamento.php?num=<?php echo $n1; ?> " target="self" class="btmenu">Voltar</a> <!-- Sempre passando a variavel da sessao armazenada em num pelas paginas" -->
        <h1>Editar Usuario</h1>



        <form name="f_editar_colaborador" action="editar_usuario.php" class="f_colaborador" method="GET">
            <input type="hidden" name="num" value="<?php echo $n1; ?>"> <!-- Campo Oculto que Passa A Variavel da Sessao -->
            <label for="">Selecione o Colaborador:</label>

            <select name="f_colaboradores" id="" size="10">

                <!-- Rotina a ser puxada pelo php -->
                <?php
                $sql = "SELECT * FROM tb_colaboradores";
                $dados = mysqli_query($con, $sql); #Armazena em colaboradores os dados do banco (tabela colaboradores)

                while ($colaborador = mysqli_fetch_array($dados)) { #Extração de linhas do banco de dados em formato de vetor
                    //echo "<option value='" . $colaborador['id_colaborador'] . "'> "'. $colaborador['nome'] . "</option>""; 
                    echo "<option value='"  . $colaborador['id_colaborador'] .  "'  >"   .    $colaborador['nome']    .   "</option>";
                    # String 1            #Indice 1 - Value              Indice 2 - Campo Option           
                    //<option value="                            ">                                          </option>       
                }

                ?>
            </select>
            
            <input type="submit" name="f_bt_editar_colaborador" class="btmenu" value="Editar">

        </form>

    </section>
    <section>

        <?php
        # Rotina que Gera o Formulario para o Update
        if (isset($_GET['f_colaboradores'])) {
            $vid = $_GET['f_colaboradores'];
            $sql = "SELECT * FROM tb_colaboradores WHERE id_colaborador=$vid";
            $colaborador = mysqli_query($con, $sql);
            $exibe = mysqli_fetch_array($colaborador);
            if ($exibe >= 1) {
                echo "

                <form name='f_edita_colaborador' action='editar_usuario.php' class='f_colaborador' method='GET'>
                <input type='hidden' name='num' value=$n1>
                <input type='hidden' name='f_id' value='". $exibe['id_colaborador']. "'>
                
                <label for=''>Nome</label>
                <input type='text' name='f_name' maxlength='50' size='50' required='required' value='". $exibe['nome']."'>
                <label for=''>UserName</label>
                <input type='text' name='f_username' maxlength='50' size='50' required='required' value='". $exibe['username']."'>
                <label for=''>Senha</label>
                <input type='text' name='f_senha' maxlength='50' size='50' required='required' value='". $exibe['senha']. "'>
                <label for=''>Tipo de Acesso</label>
                <input type='text' name='f_acesso' maxlength='50' size='50' required='required' pattern='[0-1]+$' placeholder='0 ou 1'  value='". $exibe['acesso']. "'> 
    
                <input type='submit' name='f_bt_update_colaborador' class='btmenu' value='Gravar'>
    
                </form>
                " ;           
            } 
        }
        ?>

        <!-- PHP Rotina para o UPDATE -->
        <?php

        if (isset($_GET['f_bt_update_colaborador'])) {
            #Input
            $vid = $_GET['f_id'];
            $vnome = $_GET['f_name'];
            $vusername = $_GET['f_username'];
            $vsenha = $_GET['f_senha'];
            $vacesso = $_GET['f_acesso'];
            $n1 = $_GET["num"];

            $sql = "UPDATE tb_colaboradores SET 
            nome = '$vnome' ,
            username = '$vusername' ,
            senha = '$vsenha',
            acesso = '$vacesso'
            
            WHERE id_colaborador=$vid";
            // Executando o sql Update
            $res = mysqli_query($con, $sql);
            $linhas = mysqli_affected_rows($con);
            var_dump($linhas);
            if ($linhas === 1) {
            echo '
                Usuario Atualizado
            ';   
            header('Location:editar_usuario.php?num='.$n1);
            } else {
                echo "<p>Falha ao atualizar dados do Colaborador</p>";
            }
            
        }

        ?>

    </section>

</body>

</html>