<?php
// Importando o cabeçalho do CMS
require_once('header.php');

$adm_conteudo = (string) null;
$adm_fale_conosco = (string) null;
$adm_usuario = (string) null;
?>
<!-- container do modal de exclusao -->
<div id="container_modal_excluir" class='nivel'>

</div>
<div id="container_modal_niveis">
    <div id="modal_nivel_usuario" class="center">
        <div id="container_fechar_modal_nivel">
            <div id="conteudo_fechar_modal_nivel"></div>
            <div id="container_btn_fechar_modal_nivel"></div>
        </div>
        <div id="container_conteudo_modal_nivel">
            
        </div>
    </div>
</div>

<div id="container_conteudo_cms">
    <div class="conteudo center visualizar_usuarios">
        <!-- titulo de visualizar Usuários -->
        <div id="container_titulo_visualizar" class="center">
            <h1>Níveis Cadastrados</h1>
        </div>

        <!-- Lista de todos os usuarios cadastrados -->
        <div id="tabela_usuarios_cadastrados" class="center">
            <div class="linha_tabela_usuarios niveis">
                <div class="coluna_tabela_usuarios titulo niveis">
                    <h1>Nome</h1>
                </div>
                <div class="coluna_tabela_usuarios titulo niveis">
                    <h1>Adm. de Conteudo</h1>
                </div>

                <div class="coluna_tabela_usuarios titulo niveis">
                    <h1>Adm. de Fale Conosco</h1>
                </div>
                <div class="coluna_tabela_usuarios titulo niveis">
                    <h1>Adm. Usuários</h1>
                </div>
                
            </div>

            <?php
                $sqlNiveis = "SELECT * FROM tbl_nivel_usuarios WHERE id_nivel <> 9";
                $selectNiveis = mysqli_query($conexao, $sqlNiveis);

                while($rs = mysqli_fetch_array($selectNiveis)){
                    $rs['adm_conteudo'] == 1? $adm_conteudo = "imagens/checked.png": $adm_conteudo = "imagens/nao_checkado.png";
                    $rs['adm_fale_conosco'] == 1? $adm_fale_conosco = "imagens/checked.png": $adm_fale_conosco = "imagens/nao_checkado.png";
                    $rs['adm_usuario'] == 1? $adm_usuario = "imagens/checked.png": $adm_usuario = "imagens/nao_checkado.png";

                    if ($rs['ativado'] == 1) {
                        $img_ativado = "imagens/ativado_icon.png";
                        $modo = "desativacao";
                    } else {
                        $img_ativado = "imagens/desativado_icon.png";
                        $modo = "ativacao";
                    }
            ?>

                <div class="linha_tabela_usuarios">
                    <div class="coluna_tabela_usuarios niveis"><span><?=$rs['nome']?></span></div>
                    <div class="coluna_tabela_usuarios niveis"><img src="<?=$adm_conteudo?>" alt="permissao"></div>
                    <div class="coluna_tabela_usuarios niveis"><img src="<?=$adm_fale_conosco?>" alt="permissao"></div>
                    <div class="coluna_tabela_usuarios niveis"><img src="<?=$adm_usuario?>" alt="permissao"></div>
                    <div class="coluna_tabela_usuarios acoes_usuarios niveis"><a href="#" onclick = "carregarNivel(<?=$rs['id_nivel']?>)" class="btn_editar_nivel"><img src="imagens/editar_icon64.png" alt=""></a></div>
                    <div class="coluna_tabela_usuarios acoes_usuarios excluir niveis"><a href="#" class="btn_excluir_nivel" onclick="excluirNivel(<?=$rs['id_nivel']?>)"><img src="imagens/excluir_icon64.png" alt=""></a></div>
                    <div class="coluna_tabela_usuarios acoes_usuarios niveis"><a href="bd/crud_nivel.php?modo=<?=$modo?>&id_nivel=<?=$rs['id_nivel']?>"><img src="<?=$img_ativado?>" alt="status do usuario"></a></div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php
require_once('footer.html');
?>