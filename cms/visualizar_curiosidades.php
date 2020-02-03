<?php

require_once("header.php");

$btnSalvar = "Adicionar";
$titulo = (string) null;
$descricao = (string) null;
$chkStatus = (string) null;
$exemploTitulo = (string) "Titulo";
$exemploDescricao = (string) "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere sapiente cupiditate blanditiis doloremque voluptatum culpa perferendis
                                commodi quisquam illo unde provident odit aliquid labore est, qui architecto laborum repellendus incidunt.";
$modoFormulario = (string) null;


if (isset($_GET['modo'])) {
    if ($_GET['modo'] == "editar") {

        $id = $_GET['codigo'];
        $sql = "SELECT * FROM tbl_curiosidades WHERE id =" . $id;
        $select = mysqli_query($conexao, $sql);


        if ($rs = mysqli_fetch_array($select)) {
            $titulo = $rs['titulo'];
            $descricao = $rs['descricao'];
            $chkStatus = $rs['status'] == 1 ? 'checked' : null;
        }

        $btnSalvar = "Editar";
        $modoFormulario = "editar";
        $exemploTitulo = $titulo;
        $exemploDescricao = $descricao;

        $_SESSION['id_curiosidade'] = $id;
    }
}




?>
<div id="container_modal_excluir">
    <div id="modal_excluir" class="center">

    </div>
</div>

<!-- Área do conteudo que será administrado no cms -->
<div id="container_conteudo_cms">
    <div class="conteudo center">
        <div id="container_titulo_adm_conteudo">
            <div id="container_titulo_mensagem_adms">
                <h1>Curiosidades</h1>
            </div>
        </div>

        <div id="container_btn_add_curiosidade">
            <button id="btn_adicionar_curiosidade">Adicionar <br>Curiosidade +</button>
        </div>
        <div id="container_formulario_curiosidade" class="<?= $modoFormulario ?>">
            <div id="modal_add_curiosidade" class="center">
                <div id="conteudo_modal_add_curiosidade">
                    <div id="container_preview_card_curiosidade">
                        <div class="card_curiosidade">
                            <div class="frente">
                                <div class="card_container_imagem">
                                    <div class="card_imagem center">

                                    </div>
                                </div>
                                <div class="card_titulo">
                                    <h1 id="titulo_preview_card_curiosidade"><?= $exemploTitulo ?></h1>
                                </div>
                            </div>
                            <div class="fundo">
                                <div class="descricao_curiosidade center">
                                    <span id="desc_preview_card_curiosidade">
                                        <?= $exemploDescricao ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="container_frm_add_curiosidade">
                        <form id="frm_add_curiosidade" name="frm_curiosidades" action="bd/crud_curiosidade.php" method="POST">
                            <div class="linha_frm_add_curiosidade txt status">
                                <label for="chkStatus">Ativado:</label> <input type="checkbox" id="chkStatusCuriosidade" name="chkStatus" <?= $chkStatus ?>>
                            </div>
                            <div class="linha_frm_add_curiosidade txt">
                                <input type="text" required class="txtTituloCuriosidade" value="<?= $titulo ?>" name="txtTituloCuriosidades" id="txt_titulo_curiosidade">
                                <label for="txt_titulo_curiosidade" id="lblTituloCuriosidade">Título</label>
                            </div>
                            <div class="linha_frm_add_curiosidade txt desc">
                                <textarea type="text" required id="txt_descricao_curiosidade" name="txtDescricaoCuriosidade"><?= $descricao ?></textarea>
                                <label for="txt_descricao_curiosidade" id="lblDescricaoCuriosidade">Descrição</label>
                            </div>

                            <div id="container_btn_modal_add_curiosidade">
                                <a id="btn_cancelar_curiosidade" href="visualizar_curiosidades.php">Cancelar</a> <input type="submit" value="<?= $btnSalvar ?>" name="btnSalvarCuriosidade">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="container_cards_curiosidades">

            <?php

            $sql = "SELECT * FROM tbl_curiosidades";
            $selectCuriosidades = mysqli_query($conexao, $sql);

            while ($rs = mysqli_fetch_array($selectCuriosidades)) {
                ?>

                <div class="card_curiosidade_adm">
                    <div class="container_excluir_card_curiosidade">
                        <img src="imagens/excluir_card_icon.png" alt="excluir_card" class="btn_excluir_curiosidade" onclick="excluirCuriosidade(<?= $rs['id'] ?>)">
                    </div>
                    <a href="visualizar_curiosidades.php?modo=editar&codigo=<?= $rs['id'] ?>">
                        <div class="container_img_card_adm">

                        </div>
                        <div class="container_titulo_card_curiosidades_adm">
                            <h1><?= $rs['titulo'] ?></h1>
                        </div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
</div>

<?php
require_once("footer.html");
?>