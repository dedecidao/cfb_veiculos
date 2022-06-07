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
        <h1>Novo Carro</h1>
        <!-- PHP Rotina para o envio do formulario subsequente -->
        <?php

            
        ?>
        <!-- FORM COMPLETO PARA NOVO CARRO --> 
        <form  name="f_novo_carro" action="novo_carro.php" class="f_novo_carro" method="GET" enctype="">
            <input type="hidden" name=num value="<?php echo $n1; ?>"> <!-- Campo Oculto que Passa A Variavel da Sessao -->
            <label for="">Marca</label>
                <select name="f_marca" id="">
                    <option value=""></option>
                    <?php
                    $sql = "SELECT * FROM tb_marcas";
                    $res = mysqli_query($con,$sql);
                    while ($linha = mysqli_fetch_row($res)) {
                        echo "<option value='" . $linha[0] . "'> ". $linha[1] ." </option>";
                    };
                    ?>
                </select>

            <label for="">Modelo</label>
                <select name="f_modelo" id="">
                    <option value=""></option>
                    <?php
                    $sql = "SELECT * FROM tb_modelos";
                    $res = mysqli_query($con,$sql);
                    while ($linha = mysqli_fetch_row($res)) {
                        echo "<option value='" . $linha[0] . "'> ". $linha[1] ." </option>";
                    };
                    ?>
                </select>
            
            <label> Versão </label>
            <input type="text" name="f_versao" maxlength="50" size="50" required="required" >

            <label> ano Fab </label>
            <input type="text" name="f_anofab" maxlength="4" size="4" required="required" >
            <label> ano Modelo </label>
            <input type="text" name="f_anomod" maxlength="4" size="4" required="required" >

            <label> Obs </label>
            <input type="text" name="f_obs" rows="4" cols="50" required="required" >

            <label> Valor R$ </label>
            <input type="text" name="f_valor" maxlength="50" size="50" required="required" >

            <label> Foto 1 </label>
            <input type="file" name="f_foto_1" >
            <label> Foto 2 </label>
            <input type="file" name="f_foto_2" >
                <div>
                    <label>Opcional 1</label> 
                    <input type="checkbox" name="f_opc1" value="1">  
                    <label>Opcional 2</label>  
                    <input type="checkbox" name="f_opc2" value="1"> 
                    <label>Opcional 3</label>  
                    <input type="checkbox" name="f_opc3" value="1">
                    <br>
                </div>

            <input type="submit" name="f_bt_novo_colaborador" class="btmenu" value="Gravar">

        </form>


    </section>



</body>

</html>