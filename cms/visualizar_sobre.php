<?php
require_once('header.php');

$titulo = (string) null;
$descricao = (string) null;
$rdEsquerda = (string) null;
$rdDireita = (string) null;
$foto = (string) "default_image.jpg";
$btnFrmSobre = (string) "Salvar";
$classeModal = (string) null;

if (isset($_GET['modo'])) {
    if ($_GET['modo'] == "editar") {

        $id_sessao = $_GET['codigo'];
        $_SESSION['id_sobre'] = $id_sessao;

        $sql = "SELECT * FROM tbl_sobre WHERE id_sessao =" . $id_sessao;

        $select = mysqli_query($conexao, $sql);

        if ($rs = mysqli_fetch_array($select)) {

            $titulo = $rs['titulo_sessao'];
            $descricao = $rs['texto_sessao'];

            $rdDireita = $rs['sentido_animacao'] == "D" ? "checked" : null;
            $rdEsquerda = $rs['sentido_animacao'] == "E" ? "checked" : null;
            $foto = $rs['img_sessao'];

            $_SESSION['fotoAntiga'] = $foto;

        } else {
            echo ($sql);
        }

        $btnFrmSobre = "Editar";
        $classeModal = "aberto";
    }
}

?>

<!-- Modal para excluir -->
<div id="container_modal_excluir">

</div>

<!-- Modal para adicionar ou editar sobres da empresa -->
<div id="container_modal_sobre" class="<?=$classeModal?>">
    <div id="modal_sobre" class="center">
        <div id="container_btn_fechar_modal_sobre">

        </div>
        <div id="container_titulo_modal_sobre">
            <h1>Cadastro de Sessão do Sobre</h1>
        </div>
        <div id="conteudo_modal_sobre">
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
                        <input type="submit" name="btnSalvarSobre" value="<?=$btnFrmSobre?>">
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
        </div>


    </div>
</div>

<div id="container_conteudo_cms">
    <div class="conteudo center">
        <div id="container_titulo_mensagem_adms">
            <h1>Sobre a Empresa</h1>
        </div>
        <div id="container_btn_add_curiosidade">
            <button id="btn_adicionar_sobre">Adicionar <br>Sobre +</button>
        </div>
        <div id="container_tbl_sobre">
            <div id="tbl_sobre" class="center">
                <div class="linha_tbl_sobre titulo center">
                    <div class="coluna_tbl_sobre"><span>Título</span></div>
                    <div class="coluna_tbl_sobre"><span>Direção</span></div>
                    <div class="coluna_tbl_sobre"><span>Ações</span></div>
                </div>

                <?php
                $sql = "SELECT * FROM tbl_sobre";
                $select = (mysqli_query($conexao, $sql));

                while ($rs = mysqli_fetch_array($select)) {

                    if ($rs['sentido_animacao'] == "D") {
                        $direcao = "Direita";
                    } else {
                        $direcao = "Esquerda";
                    }

                    if ($rs['status'] == 1) {
                        $ativado = "imagens/ativado_icon.png";
                        $modo = "desativacao";
                    } else {
                        $ativado = "imagens/desativado_icon.png";
                        $modo = "ativacao";
                    }
                    ?>

                    <div class="linha_tbl_sobre center">
                        <div class="coluna_tbl_sobre"><span><?= $rs['titulo_sessao'] ?></span></div>
                        <div class="coluna_tbl_sobre"><span><?= $direcao ?></span></div>
                        <div class="coluna_tbl_sobre botoes">
                            <div class="coluna_tbl_sobre acoes">
                                <a href="#" onclick="excluirSobre(<?= $rs['id_sessao'] ?>, '<?=$rs['img_sessao']?>' )" class="excluir btnExcluirSobre"><img src="imagens/excluir_icon64.png" alt="excluir"></a>
                            </div>
                            <div class="coluna_tbl_sobre acoes">
                                <a href="visualizar_sobre.php?modo=editar&codigo=<?= $rs['id_sessao'] ?>" class="btnEditarSobre"><img src="imagens/editar_icon.png" alt=""></a>
                            </div>
                            <div class="coluna_tbl_sobre acoes">
                                <a href="bd/crud_sobre.php?modo=<?= $modo ?>&codigo=<?= $rs['id_sessao'] ?>"><img src="<?= $ativado ?>" alt="status"></a>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php

require_once('footer.html');

?>