<?php

require_once("upload_imagem.php");
require_once("../../bd/conexao.php");


$conexao = conexaoMysql();

session_start();

// Declarando as variáveis para tratar possíveis erros
$titulo = (string) "";
$descricao = (string) "";
$direcao = (string) "";


// Verifificando se o botão para salvar existe
if (isset($_POST['btnSalvarSobre'])) {
    $titulo = $_POST['txtTituloSobre'];
    $descricao = $_POST['txtDescricaoSobre'];
    $direcao = $_POST['rdDirecao'];
    $nomeFoto = $_SESSION['nomeFoto'];


    // Verificando se o botão é para salvar
    if ($_POST['btnSalvarSobre'] == "Salvar") {

        // Declarando a variável sql para inserir
        $sql = "INSERT INTO tbl_sobre (titulo_sessao, texto_sessao, img_sessao, sentido_animacao, status) 
           VALUES ('" . $titulo . "', '" . $descricao . "', '" . $nomeFoto . "', '" . $direcao . "',1)";

    // Verificando se o botão é para editar

    } elseif ($_POST['btnSalvarSobre'] == "Editar") {

        // Verificando se o nome foto não é nulo para fazer update sem a imagem
        if ($nomeFoto == null) {
            $sql = "UPDATE tbl_sobre SET 
            titulo_sessao = '" . $titulo . "',
            texto_sessao = '" . $descricao . "',
            sentido_animacao = '" . $direcao . "'
            WHERE id_sessao = " . $_SESSION['id_sobre'];

            // Fazendo o update com a imagem
        }else{
            $sql = "UPDATE tbl_sobre SET 
            titulo_sessao = '" . $titulo . "',
            texto_sessao = '" . $descricao . "',
            img_sessao = '". $_SESSION['nomeFoto']."',
            sentido_animacao = '" . $direcao . "'
            WHERE id_sessao = " . $_SESSION['id_sobre'];

// Excluindo a imagem antiga
            unlink("arquivos/".$_SESSION['fotoAntiga']);
        }
    }

    // Executando o script no BD
    if (mysqli_query($conexao, $sql)) {
        header('location: ../visualizar_sobre.php');
    } else {
        echo ($sql);
    }

    // Vendo se um modo via GET existe
} elseif (isset($_GET['modo'])) {
    $id_sessao = $_GET['codigo'];

    // Verificando se o modo é ativar, excluir, ou desativar e instanciando as variáveis sql
    if ($_GET['modo'] == "ativacao") {
        $sql = "UPDATE tbl_sobre SET status = 1 WHERE id_sessao =" . $id_sessao;

    } elseif ($_GET['modo'] == "desativacao") {
        $sql = "UPDATE tbl_sobre SET status = 0 WHERE id_sessao =" . $id_sessao;

    } elseif ($_GET['modo'] == "excluir") {
        $sql = "DELETE FROM tbl_sobre WHERE id_sessao =" . $id_sessao;
    
    }

    // Executando o script no BD
    if (mysqli_query($conexao, $sql)) {
        if(isset($_GET['img'])){
            // Excluindo a imagem
            unlink("arquivos/".$_GET['img']);
        }
        header("location: ../visualizar_sobre.php");
    } else {
        echo ($sql);
    }
} elseif (isset($_POST['modo'])) {
    $id_sessao = $_POST['codigo'];
    $_SESSION['id_sobre'] = $id_sessao;


    if ($_POST['modo'] == "carregarSobre") {
        $sql = "SELECT * FROM tbl_sobre WHERE id_sessao =" . $id_sessao;

        $select = mysqli_query($conexao, $sql);

        if ($rs = mysqli_fetch_array($select)) {

            $titulo = $rs['titulo_sessao'];
            $descricao = $rs['texto_sessao'];

            $rdDireita = $rs['sentido_animacao'] == "D" ? "checked" : null;
            $rdEsquerda = $rs['sentido_animacao'] == "E" ? "checked" : null;
            $foto = $rs['img_sessao'];

            ?>

<form id="container_frm_sobre" method="POST" action="bd/crud_sobre.php">
                <div id="container_textos_frm_sobre">
                    <div class="linha_frm_sobre txt">
                        <input type="text" name="txtTituloSobre" id="txt_titulo_curiosidade" required value="<?=$titulo?>">
                        <label for="txt_titulo_curiosidade">Título</label>
                    </div>
                    <div class="linha_frm_sobre descricao_sobre txt">
                        <textarea type="text" name="txtDescricaoSobre" id="txt_descricao_sobre" required><?=$descricao?></textarea>
                        <label for="txt_descricao_sobre">Descrição</label>
                    </div>
                    <div class="linha_frm_sobre rd">
                        <div id="titulo_coluna_frm_sobre">
                            <h1>Sentido da Animação</h1>
                        </div>
                        <div class="coluna_frm_sobre opt"><input type="radio" name="rdDirecao" value="E" <?=$rdEsquerda?>></div>
                        <div class="coluna_frm_sobre"><Label>Esquerda</Label></div>
                        <div class="coluna_frm_sobre opt"><input type="radio" name="rdDirecao" value="D" <?=$rdDireita?>></div>
                        <div class="coluna_frm_sobre"><Label>Direita</Label></div>
                    </div>
                    <div class="linha_frm_sobre btn">
                        <input type="submit" name="btnSalvarSobre" value="Editar">
                    </div>
                </div>
            </form>
            <div id="container_opcoes_frm_sobre">
                <div class="linha_frm_sobre img">
                    <form action="bd/preview_imagem.php" name="frmImagem" id="frm_foto" enctype="multipart/form-data" method="POST">
                        <input type="file" name="fileFotoSobre" id="fileFoto">
                        <label for="fileFoto"></label>
                        <div id="img_sobre" class="center"><img src="bd/arquivos/<?=$foto?>" alt="imagem da sessao"></div>
                    </form>
                </div>
            </div>

<?php
        }
    }
}
?>