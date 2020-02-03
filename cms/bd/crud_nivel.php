<?php

// Importando a conexaõ e iniciando a sessão
require_once("../../bd/conexao.php");
$conexao = conexaoMysql();
session_start();

// Verificando se o botão de salvar nivel existe
if (isset($_POST['btnSalvarNivel'])) {

    // Pegando os valores do POST
    $nomeNivel = $_POST['txtNomeNivel'];
    $chkConteudo = isset($_POST['chkConteudo']) ? 1 : 0;
    $chkFaleConosco = isset($_POST['chkFaleConosco']) ? 1 : 0;
    $chkUsuarios = isset($_POST['chkUsuarios']) ? 1 : 0;

    // Verificando se o botão é para salvar
    if ($_POST['btnSalvarNivel'] == "Adicionar") {
        

        // Declarando a variavel sql para inserir
        $sql = "INSERT INTO tbl_nivel_usuarios (nome, adm_conteudo, adm_fale_conosco, adm_usuario, ativado)
             VALUES ('" . $nomeNivel . "', " . $chkConteudo . ", " . $chkFaleConosco . ", " . $chkUsuarios . ", 1)";

        
// Verificando se o botão clicado é para editar
    }elseif($_POST['btnSalvarNivel'] == "Atualizar"){
        echo(("Tá indo"));

        // Declarando a variavel sql para editar
        $sql = "UPDATE tbl_nivel_usuarios SET
        nome = '".$nomeNivel."',
        adm_conteudo = $chkConteudo,
        adm_fale_conosco = $chkFaleConosco,
        adm_usuario = $chkUsuarios 
        WHERE id_nivel =" .$_SESSION['id_nivel'];
    }


    // executando o script no BD e exibindo mensagem de erro caso haja algum
    if (mysqli_query($conexao, $sql)) {
        header("location: ../visualizar_niveis.php");
    } else {
        echo ("Tem parada errada aí, mermão!");
        echo ($sql);
    }

    // Verificando se existe um modo via GET
} else if (isset($_GET['modo'])) {

    // Verificando se o modo é para ativar o nível
    if ($_GET['modo'] == "ativacao") {
        $id_nivel = $_GET['id_nivel'];

        // Declarando a variavel sql para ativar

        $sqlAtivacao = "UPDATE tbl_nivel_usuarios SET ativado = 1 WHERE id_nivel =" . $id_nivel;

    // executando o script no BD e exibindo mensagem de erro caso haja algum
        if (mysqli_query($conexao, $sqlAtivacao)) {
            header("location: ../visualizar_niveis.php");
        } else {
            echo ("Erroooo");
            echo ($sqlAtivacao);
        }

    // Verificando se o modo é para desativar o nível
    } elseif ($_GET['modo'] == "desativacao") {
        $id_nivel = $_GET['id_nivel'];

        // Declarando a variavel sql para desativar
        $sqlAtivacao = "UPDATE tbl_nivel_usuarios SET ativado = 0 WHERE id_nivel =" . $id_nivel;

        // Executando o script no BD
        if (mysqli_query($conexao, $sqlAtivacao)) {
            header("location: ../visualizar_niveis.php");
        } else {
            echo ("Erroooo");
            echo ($sqlAtivacao);
        }

        // Verificando se o modo é para excluir
    } elseif ($_GET['modo'] == 'excluir') {
        $id_nivel = $_GET['codigo'];

        // Declarando a variavel sql para desativar
        $sql = "DELETE FROM tbl_nivel_usuarios WHERE id_nivel =" . $id_nivel;

        // Executando o script no BD
        if (mysqli_query($conexao, $sql)) {
            header("location: ../visualizar_niveis.php");
        } else {
            echo ("Erroooooo");
        }
    }

    // Verificando se existe um modo via POST
} elseif (isset($_POST['modo'])) {

    // Pegando as variaveis do post e colocando o ID na sessão
    $id_nivel = $_POST['codigo'];
    $_SESSION['id_nivel'] = $id_nivel;

    // Verificando se o modo do post é para carregar um nível
    if ($_POST['modo'] == 'carregarNivel') {
        $sqlNivel = "SELECT * FROM tbl_nivel_usuarios WHERE id_nivel =" . $id_nivel;
        $selectCarregarNivel = mysqli_query($conexao, $sqlNivel);

        // Colocando as variáveis do select em locais para exibir no modal
        if ($rs = mysqli_fetch_array($selectCarregarNivel)) {
            $nomeNivel = $rs['nome'];
            $chkConteudo = $rs['adm_conteudo'] == 1 ? 'checked' : null;
            $chkFaleConosco = $rs['adm_fale_conosco'] == 1 ? 'checked' : null;
            $chkUsuarios = $rs['adm_usuario'] == 1 ? 'checked' : null;

            ?>
            
            <!-- Modal para edição do nivel -->
            <div id="container_titulo_modal_nivel">
                <h1>Cadastro de Níveis de Usuário</h1>
            </div>
            <form id="frm_nivel_usuario" name="frmNivelUsuario" method="POST" action="bd/crud_nivel.php">
                <div class="linha_frm_nivel_usuario nome">
                    <input type="text" name="txtNomeNivel" required value="<?=$nomeNivel?>"> <label for="txtNomeNivel" class="nome_nivel">Nome do Nível</label>
                </div>
                <div class="linha_frm_nivel_usuario subtitulo">
                    <h1>Permissões de admininistração para:</h1>
                </div>
                <div class="linha_frm_nivel_usuario">
                    <div class="coluna_frm_nivel_usuario">
                        <h2 class="one">Conteúdo</h2>
                    </div>
                    <div class="coluna_frm_nivel_usuario opt"><input type="checkbox" name="chkConteudo" <?=$chkConteudo?>></div>
                    <div class="coluna_frm_nivel_usuario">
                        <h2>Fale Conosco</h2>
                    </div>
                    <div class="coluna_frm_nivel_usuario opt"><input type="checkbox" name="chkFaleConosco" <?=$chkFaleConosco?>></div>
                    <div class="coluna_frm_nivel_usuario">
                        <h2>Usuários</h2>
                    </div>
                    <div class="coluna_frm_nivel_usuario opt"><input type="checkbox" name="chkUsuarios" <?=$chkUsuarios?>></div>
                </div>
                <div class="linha_frm_nivel_usuario"></div>
                <div class="linha_frm_nivel_usuario btn_adicionar_nivel">
                    <input type="submit" value="Atualizar" name="btnSalvarNivel">
                </div>
            </form>
<?php
        }
    }
 }
?>