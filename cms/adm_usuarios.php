<?php
// Importando todo o cabeçalho do cms
require_once("header.php");
?>

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
            <div id="container_titulo_adicionar_usuario">
                <h1>Cadastro de Usuários</h1>
            </div>
            <form action="bd/crud_usuario.php" id="frm_add_usuario" name="frmAddUsuario" method="POST">
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtNomeUsuario"> <label for="txtNomeUsuario">Nome</label>
                    </div>
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtDataNascimentoUsuario"> <label for="txtDataNascimentoUsuario">Data de Nascimento</label>
                    </div>
                </div>
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtEmailUsuario"> <label for="txtEmailUsuario">Email</label>
                    </div>
                    <div class="coluna_frm_add_user">
                        <select name="slcNivel" id="">
                            <option value="">Selecione um nível de usuário</option>

                            <?php

                            $conexao = conexaoMysql();
                            $sqlNiveis = "SELECT id_nivel, nome FROM tbl_nivel_usuarios WHERE id_nivel <> 9";

                            $selectNiveis = mysqli_query($conexao, $sqlNiveis);

                            while ($rs = mysqli_fetch_array($selectNiveis)) {
                                ?>
                                <option value="<?= $rs['id_nivel'] ?>"><?= $rs['nome'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados" name="txtSenhaUsuario"> <label for="txtSenhaUsuario">Senha</label>
                    </div>
                    <div class="coluna_frm_add_user sexo">
                        <div class="coluna_sexo"><input type="radio" name="rdoSexoUsuario" value="M"></div>
                        <div class="coluna_sexo titulo"><span for="">Masculino</span></div>
                        <div class="coluna_sexo"><input type="radio" name="rdoSexoUsuario" value="F"></div>
                        <div class="coluna_sexo titulo"><span for="">Feminino</span></div>
                    </div>
                </div>
                <div class="linha_frm_add_user center">
                    <div class="coluna_frm_add_user">
                        <input type="text" required class="dados"> <label for="">Confirmar Senha</label>
                    </div>
                    <div class="coluna_frm_add_user btn_adicionar">
                        <input type="submit" value="Adicionar" name="btn_salvar_usuario">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Adicionar ou Editar Níveis de Usuários -->
<div id="container_modal_niveis">
    <div id="modal_nivel_usuario" class="center">
        <div id="container_fechar_modal_nivel">
            <div id="conteudo_fechar_modal_nivel"></div>
            <div id="container_btn_fechar_modal_nivel"></div>
        </div>
        <div id="container_conteudo_modal_nivel">
            <div id="container_titulo_modal_nivel">
                <h1>Cadastro de Níveis de Usuário</h1>
            </div>
            <form id="frm_nivel_usuario" name="frmNivelUsuario" method="POST" action="bd/crud_nivel.php">
                <div class="linha_frm_nivel_usuario nome">
                    <input type="text" name="txtNomeNivel" required> <label for="txtNomeNivel" class="nome_nivel">Nome do Nível</label>
                </div>
                <div class="linha_frm_nivel_usuario subtitulo">
                    <h1>Permissões de admininistração para:</h1>
                </div>
                <div class="linha_frm_nivel_usuario">
                    <div class="coluna_frm_nivel_usuario">
                        <h2 class="one">Conteúdo</h2>
                    </div>
                    <div class="coluna_frm_nivel_usuario opt"><input type="checkbox" name="chkConteudo"></div>
                    <div class="coluna_frm_nivel_usuario">
                        <h2>Fale Conosco</h2>
                    </div>
                    <div class="coluna_frm_nivel_usuario opt"><input type="checkbox" name="chkFaleConosco"></div>
                    <div class="coluna_frm_nivel_usuario">
                        <h2>Usuários</h2>
                    </div>
                    <div class="coluna_frm_nivel_usuario opt"><input type="checkbox" name="chkUsuarios"></div>
                </div>
                <div class="linha_frm_nivel_usuario"></div>
                <div class="linha_frm_nivel_usuario btn_adicionar_nivel">
                    <input type="submit" value="Adicionar" name="btnSalvarNivel">
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Conteudo do cms na área de administração de usuários -->
    <div id="container_conteudo_cms">
        <div class="conteudo center usuarios">
            <div id="container_opcoes_adm_usuarios" class="center">
                <div class="card_opcao_adm_usuario">
                    <div class="container_imagem_opcao_adm_usuario">
                    </div>
                    <div class="container_descricao_opcao">
                        <h1>Adm. Usuários</h1>
                    </div>
                    <div class="container_gerenciar_usuarios">
                        <div class="container_btn_acoes_adm_usuarios">
                            <a href="#" id="btn_modal_add_usuario"><img src="imagens/adicionar_icon.png" alt="Adicionar usuário"></a>
                            <a href="visualizar_usuarios.php"><img src="imagens/visualizar_icon64.png" alt="Editar usuário"></a>
                        </div>
                    </div>
                </div>
                <div class="card_opcao_adm_usuario">
                    <div class="container_imagem_opcao_adm_usuario niveis">

                    </div>
                    <div class="container_descricao_opcao">
                        <h1>Adm. Niveis de Usuário</h1>
                    </div>
                    <div class="container_gerenciar_usuarios">
                        <div class="container_btn_acoes_adm_usuarios">
                            <a href="#" id="btn_modal_nivel_usuario"><img src="imagens/adicionar_icon.png" alt="Adicionar usuário"></a>
                            <a href="visualizar_niveis.php"><img src="imagens/visualizar_icon64.png" alt="Editar usuário"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Importando o rodapé do CMS -->
    <?php
    require_once("footer.html");
    ?>