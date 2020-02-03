<?php
require_once("header.php");
?>

<!-- container do modal de exclusao -->
<div id="container_modal_excluir">
    <div id="modal_excluir" class="center">

    </div>
</div>

<!-- Modal para salvar usuários -->
<div id="container_modal_adicionar_usuario">
    <div id="modal_adicionar_usuario" class="center">
        <div id="container_fechar_add_usuario">
            <div id="container_conteudo_fechar">

            </div>
            <div id="container_btn_fechar">

            </div>
        </div>
        <div id="conteudo_modal_add_usuario">
        </div>
    </div>
</div>

<!-- Área do conteúdo para visualizar os usuários -->
<div id="container_conteudo_cms">
    <div class="conteudo center visualizar_usuarios">
        <!-- titulo de visualizar Usuários -->
        <div id="container_titulo_visualizar" class="center">
            <h1>Usuários Cadastrados</h1>
        </div>

        <!-- Lista de todos os usuarios cadastrados -->
        <div id="tabela_usuarios_cadastrados" class="center">
            <div class="linha_tabela_usuarios">
                <div class="coluna_tabela_usuarios titulo">
                    <h1>Nome</h1>
                </div>
                <div class="coluna_tabela_usuarios titulo">
                    <h1>E-mail</h1>
                </div>

                <div class="coluna_tabela_usuarios titulo">
                    <h1>Nível</h1>
                </div>
            </div>

            <?php
            $sqlUsuarios = "SELECT tbl_usuarios.*, tbl_nivel_usuarios.nome n FROM tbl_usuarios INNER JOIN tbl_nivel_usuarios ON tbl_usuarios.id_nivel = tbl_nivel_usuarios.id_nivel WHERE id_usuario <> 1";
            $selectUsuarios = mysqli_query($conexao, $sqlUsuarios);

            while ($rs = mysqli_fetch_array($selectUsuarios)) {
                if ($rs['ativado_usuario'] == 1) {
                    $img_ativado = "imagens/ativado_icon.png";
                    $modo = "desativacao";
                } else {
                    $img_ativado = "imagens/desativado_icon.png";
                    $modo = "ativacao";
                }
                ?>
                <div class="linha_tabela_usuarios">
                    <div class="coluna_tabela_usuarios"><span><?= $rs['nome'] ?></span></div>
                    <div class="coluna_tabela_usuarios"><span><?= $rs['email'] ?></span></div>
                    <div class="coluna_tabela_usuarios"><span><?= $rs['n'] ?></span></div>
                    <div class="coluna_tabela_usuarios acoes_usuarios"><a href="#" onclick="carregarUsuario(<?=$rs['id_usuario']?>)" class="btn_editar_usuario"><img src="imagens/editar_icon64.png" alt=""></a></div>
                    <div class="coluna_tabela_usuarios acoes_usuarios excluir"><a href="#" class="btn_excluir_usuario" onclick="excluirUsuario(<?= $rs['id_usuario'] ?>)"><img src="imagens/excluir_icon64.png" alt=""></a></div>
                    <div class="coluna_tabela_usuarios acoes_usuarios "><a href="bd/crud_usuario.php?id_usuario=<?= $rs['id_usuario'] ?>&modo=<?= $modo ?>"><img src="<?= $img_ativado ?>" alt="status do usuario"></a></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<?php
require_once("footer.html")
?>