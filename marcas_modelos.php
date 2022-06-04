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
include('conexao.php');
?>

<!-- 
    Codigos para exibição de formularios
    1 Add Marca
-->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>CFB Veiculos</title> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/estilo.css">
    <script>
        function add() {
            document.getElementById('f_add').style.display = "block";
            document.getElementById('f_del').style.display = "none";
        }
        function del() {
            document.getElementById('f_add').style.display = "none";
            document.getElementById('f_del').style.display = "block";
        }
    </script>        
</head>

<body>
    <header>
        <?php
        include "topo.php";
        ?>
    </header>
    <section id="main">
        <a href="gerenciamento.php?num=<?php echo $n1; ?> " target="self" class="btmenu">Voltar</a> <!-- Sempre passando a variavel da sessao armazenada em num pelas paginas" -->
        <h1>Marcas / Modelos</h1>


        <!-- Add um pouco de javascript Para Exibir os form de acordo com os botoes abaixo -->
        <button class="btmenu" onclick="add()">Adicionar</button>
        <button class="btmenu" onclick="del()">Deletar</button>
        <!-- A rotina abaixo se Refere a chamada de 4 Formularios baseado na chamada da propria pagina
        passada em um campo hidden pelos formularios a pagina se comportará
        de acordo:
            1 -- Nova.....Marca
            2 -- Novo.....Modelo
            3 -- Deletar..Marca
            4 -- Deletar..Modelo
        -->
        <?php
        if (isset($_GET["codigo"])) {
            $vcod = $_GET["codigo"];
            // Nova Marca
            if ($vcod == 1) {
                $vmarca = $_GET["f_marca"];
                $sql = "INSERT INTO tb_marcas (marca) VALUES ('$vmarca')";
                mysqli_query($con, $sql);
                $linhas = mysqli_affected_rows($con);
                if ($linhas >= 1) {
                    echo "<script>alert('Nova Marca Adicionada com Sucesso')</script>";
                } else {
                    echo "<script>alert('Erro ao adicionar nova marca')</script>";
                }
                // Novo Modelo            
            } else if ($vcod == 2) {
                $vmodelo = $_GET["f_modelo"];
                $vidmarca = $_GET["f_id_marca"];

                $sql = "INSERT INTO tb_modelos (modelo, id_marca) VALUES ('$vmodelo' , $vidmarca)";
                mysqli_query($con, $sql);
                $linhas = mysqli_affected_rows($con);
                if ($linhas >= 1) {
                    echo "<script>alert('Novo Modelo Adicioando com Sucesso')</script>";
                } else {
                    echo "<script>alert('Erro ao adicionar novo modelo')</script>";
                }
            }
            // Deletar Marca    
            else if ($vcod == 3) {
                $vidmarca = $_GET["f_marcas"];

                $sql = "DELETE FROM tb_marcas where id_marca = $vidmarca";
                mysqli_query($con, $sql);
                $linhas = mysqli_affected_rows($con);
                if ($linhas >= 1) {
                    echo "<script> alert('Marca deletada com sucesso.')</script>";
                } else {
                    echo "<script> alert('Ocorreu um erro ao deletar ')</script>";
                }
            }
            // Deletar modelo    
            else if ($vcod == 4) {
                $vidmodelo = $_GET["f_modelos"];
                $sql = "DELETE FROM tb_modelos where id_modelo = $vidmodelo";
                mysqli_query($con, $sql);
                $linhas = mysqli_affected_rows($con);
                if ($linhas >= 1) {
                    echo "<script> alert('Modelo deletado com sucesso.')</script>";
                } else {
                    echo "<script> alert('Ocorreu um erro ao deletar ')</script>";
                }
            }
        }
        ?>
        <!-- FORMS A SEREM EXECUTADOS ANTES DAS ROTINAS COM AÇÃO DE USUARIO -->

        <!-- FORM ADD MARCA COD 01 -->
        <div id="f_add" class="f_add_del">
            <form name="f_nova_marca" action="marcas_modelos.php" method="get" class="marcasmodelos">
                <input type="hidden" name="num" value="<?php echo $n1 ?>">
                <input type="hidden" name="codigo" value="1">
                <label for="">Nova marca</label>
                <input type="text" name="f_marca" maxlength="50" size="50" required>
                <input type="submit" value="Gravar" class="btmenu" name="f_bt_nova_marca">
            </form>
            <!-- FORM ADD MODELO COD 02 -->
            <form name="f_novo_modelo" action="marcas_modelos.php" method="get" class="marcasmodelos">
                <input type="hidden" name="num" value="<?php echo $n1 ?>">
                <input type="hidden" name="codigo" value="2">
                <label>Selecione uma marca</label>
                <br>
                <select name="f_id_marca" size="10" required>
                    <?php
                    $sql = "SELECT * FROM tb_marcas";
                    $col = mysqli_query($con, $sql);
                    //$total_col = mysqli_num_rows($col);
                    while ($exibe = mysqli_fetch_array($col)) {
                        echo "<option value='{$exibe['id_marca']}'> 
                                {$exibe['marca']}
                                </option>";
                    }
                    ?>
                </select>
                <br>
                <label for="">Novo Modelo</label>
                <input type="text" name="f_modelo" maxlength="50" size="50" required>
                <input type="submit" value="Gravar" class="btmenu" name="f_bt_novo_modelo">
            </form>
        </div>

        <!-- DELETA UMA MARCA COD 03 -->
        <div id="f_del" class="f_add_del">
            <form name="f_del_marcas" action="marcas_modelos.php" method="get" class="marcasmodelos">
                <input type="hidden" name="num" value="<?php echo $n1 ?>">
                <input type="hidden" name="codigo" value="3">
                <label>Selecione uma marca</label>
                <br>
                <select name="f_marcas" width="100px" size="10" required>
                    <?php
                    $sql = "SELECT * FROM tb_marcas";
                    $col = mysqli_query($con, $sql);
                    //$total_col = mysqli_num_rows($col);
                    while ($exibe = mysqli_fetch_array($col)) {
                        echo "<option value='{$exibe['id_marca']}'> 
                                    {$exibe['marca']}
                                </option>";
                    }
                    ?>
                </select>
                <input type="submit" value="Excluir" class="btmenu" name="f_bt_del_marca">
            </form>
            <!-- DELETA UMA MARCA COD 03 -->
            <div id="f_del" class="">
                <form name="f_del_modelo" action="marcas_modelos.php" method="get" class="marcasmodelos">
                    <input type="hidden" name="num" value="<?php echo $n1 ?>">
                    <input type="hidden" name="codigo" value="4">
                    <label>Selecione um modelo</label>
                    <br>
                    <select name="f_modelos" size="10" required>
                        <?php
                        $sql = "SELECT * FROM tb_modelos";
                        $col = mysqli_query($con, $sql);
                        //$total_col = mysqli_num_rows($col);
                        while ($exibe = mysqli_fetch_array($col)) {
                            echo "<option value='{$exibe['id_modelo']}'> 
                                            {$exibe['modelo']}
                                        </option>";
                        }
                        ?>
                    </select>
                    <input type="submit" value="Excluir" class="btmenu" name="f_bt_del_modelo">
                </form>
            </div>
        </div>
        <?php
            if (isset($_GET["codigo"])) {
                if(($vcod == 1) or ($vcod == 2)){
                    echo "<script>document.getElementById('f_add').style.display = 'block'</script>";
                } else if (($vcod == 3) or ($vcod == 4)){
                    echo "<script>document.getElementById('f_del').style.display = 'block'</script>";
                }
            }
        ?>
    </section>


</body>

</html>