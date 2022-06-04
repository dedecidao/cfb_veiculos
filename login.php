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
        <!-- Incluir arquivo do banco de dados que abre a conexão -->
        <?php
        include("conexao.php");
        ?>

        <!-- TESTE DE FORMULARIO ENVIADO PARA A PROPRIA PAGINA -->
        <?php
        if (isset($_POST["f_logar"])) { //Se o f_logar que é o botao existe na seção foi acionado, execute a rotina abaixo
            $user = $_POST["f_user"];
            $senha = $_POST["f_senha"];
            
            //Guarda os Envios via POST em Variaveis e prepara o SQL

            $sql = "SELECT * from tb_colaboradores WHERE username='$user' AND senha='$senha'";
            $res = mysqli_query($con, $sql); 
            $return = mysqli_fetch_array($res); #Retorno recebe um array dos resultados executados no Banco de Dados

            //Rotina acima return TRUE caso Encontre o usuario e senha coincidentes
            //Rotina abaixo cria uma chave alfanumerica para o usuario que obteve sucesso em logar

            if ($return == FALSE) {
                echo "<p id='loginError'>Login ou senha incorreta!</p>";
            } else {
                    // Rotina de criação de chave para armazenar a sessao
                    $chave1 = "abcdefghijklmnopqrstyvxwz";
                    $chave2 = strtoupper("abcdefghijklmnopqrstyvxwz");
                    $chave3 = "123456789";
                    $chave = str_shuffle($chave1 . $chave2 . $chave3); //Embaralhamento com o uso da função SHUFFLE
                    $tam = strlen($chave); 
                    $num = '';
                    $qtd = rand(20,50);
                    for ($i=0; $i < $qtd ; $i++) { 
                        $pos = rand(0, $tam);
                        $num .= substr($chave, $pos, 1); #Gerando uma nova chave randomica variavel de 20 a 50 char, e pegando um a um.
                    }
                    // Start SESSION
                    session_start();
                    $_SESSION['numLogin'] = $num;
                    $_SESSION['username'] = $user;
                    $_SESSION['acesso'] = $return['acesso']; // Segui a regra quando acesso 0 = Restrito // 1 = Acesso Total

                    //Reditect to ADM
                    header("Location:gerenciamento.php?num=$num");

            }
        }

        mysqli_close($con); //Close Connect
        ?>
        <!-- Fim Do Envio do Form -->


        <div id="form_elements">
            <!-- Formulario que chama pra propria pagina com o action enviando para a propria pagina -->
            <form action="login.php" method="post" name="f_login" id="f_login"> 
                <label for="f_user">Login:</label>
                <input type="text" name="f_user" id="f_user">
                
                <label for="f_senha">Senha:</label>
                <input type="password" name="f_senha" id="f_senha">
                <input type="submit" value="Login" name="f_logar"></input>
                <a href="">Esqueci minha senha</a>
            </form>
            
        </div>
    </section>


</body>

</html>