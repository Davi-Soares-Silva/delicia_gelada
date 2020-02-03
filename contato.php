<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/contato.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/additional-methods.min.js"></script>
    <script src="js/localization/messages_pt_BR.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script src="js/validacao.js"></script>
</head>

<body>
    <!-- Área do Cabeçalho -->
    <div id="caixa_cabecalho" class="fundo_branco">

        <!-- Logo -->
        <nav class="conteudo center" id="area_menu">
            <div id="nav_container_logo">
                <a href="home.html" class="center">
                    <div id="nav_logo" class="center">

                    </div>
                </a>
            </div>

            <!-- Menu -->
            <div id="nav_container_menu">
                <div id="menu" class="center">

                    <div class="menu_item">Empresa
                        <div class="submenu">
                            <div class="submenu_item"><a href="empresa.html">Sobre</a></div>
                            <div class="submenu_item"><a href="contato.php">Contato</a></div>
                        </div>
                    </div>


                    <div class="menu_item">Produtos
                        <div class="submenu">
                            <div class="submenu_item"><a href="produtos.html">itens</a></div>
                            <div class="submenu_item"><a href="curiosidades.html">Curiosidades</a></div>
                        </div>
                    </div>

                    <a href="onde_comprar.html">
                        <div class="menu_item" id="menu_item_onde_comprar">Onde Comprar?</div>
                    </a>
                    <a href="promocoes.html">
                        <div class="menu_item">Promoções</div>
                    </a>
                    <a href="produto_mes.html">
                        <div class="menu_item" id="menu_item_produto_mes">Produto do Mês</div>
                    </a>

                </div>
            </div>

            <!-- Formulário de Login -->
            <div id="nav_container_frm">
                <div id="frm_login" class="center">
                    <div id="container_informacoes_frm_login">
                        <div class="linha_frm_login">
                            <label>Usuário</label> <input type="text">
                        </div>
                        <div class="linha_frm_login">
                            <label>Senha</label> <input type="text">
                        </div>
                    </div>
                    <div id="container_btn_frm_login">
                        <input type="submit" value="Ok">
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Área do Formulário de contato -->

    <div id="container_formulario_contato">
        <div class="conteudo center">
            <form id="frm_contato" class="center" name="frmContato" action="bd/inserir_contato.php" method="POST">
                <div id="container_informacoes_frm_contato">
                    <div class="linha_frm_contato">
                        <input type="text" placeholder="Nome Completo" name="txtNome">
                    </div>
                    <div class="linha_frm_contato">

                        <input type="email" placeholder="E-mail" name="txtEmail">
                    </div>
                    <div class="linha_frm_contato">

                        <input type="text" placeholder="Telefone *Opcional*" name="txtTelefone" id="txt_telefone">
                    </div>
                    <div class="linha_frm_contato">

                        <input type="text" placeholder="Celular" name="txtCelular" id="txt_celular">
                    </div>
                    <div class="linha_frm_contato">

                        <input type="text" placeholder="Profissão" name="txtProfissao">
                    </div>
                    <div class="linha_frm_contato">

                        <input type="text" placeholder="Link Home Page *Opcional*" name="txtHomePage">
                    </div>
                    <div class="linha_frm_contato">

                        <input type="text" placeholder="Link Facebook *Opcional*" name="txtFacebook">
                    </div>

                    <div class="linha_frm_contato sexo">
                        <div class="coluna_sexo rd">
                            <input type="radio" name="rdoSexo" value="M" checked>
                        </div>
                        <div class="coluna_sexo">
                            <label>Masculino</label>
                        </div>
                        <div class="coluna_sexo rd">
                            <input type="radio" name="rdoSexo" value="F">
                        </div>
                        <div class="coluna_sexo">
                            <label>Feminino</label>
                        </div>
                    </div>
                </div>
                <div id="container_mensagem_frm_contato">
                    <div id="titulo_mensagem_frm_contato">
                        <h1>Mensagem</h1>
                    </div>
                    <div id="tipo_mensagem_frm_contato">
                        <div class="coluna_tipo_mensagem rd">
                            <input type="radio" name="rdoTipoMensagem" value="C">
                        </div>
                        <div class="coluna_tipo_mensagem">
                            <label>Crítica</label>
                        </div>
                        <div class="coluna_tipo_mensagem rd">
                            <input type="radio" name="rdoTipoMensagem" value="S">
                        </div>
                        <div class="coluna_tipo_mensagem">
                            <label>Sugestão</label>
                        </div>
                    </div>
                    <div id="mensagem_frm_contato">
                        <textarea id="" cols="30" rows="10" name="txtMensagem"></textarea>
                    </div>
                    <div id="container_btn_enviar_frm_contato">
                        <input type="submit" value="Enviar Mensagem" name="btnEnviar">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Área do rodapé -->
    <div id="caixa_rodape" class="contato">
        <footer class="center conteudo contato">
            <div id="caixa_conteudo_rodape" class="contato">
                <div id="container_btn_sistema_interno">
                    <input type="submit" value="Sistema Interno">
                </div>
                <div id="container_endereco">
                    <div id="endereco" class="center">
                        <h1>Avenida Engenheiro Luis Carlos Berrini, 666 São Paulo-SP</h1>
                    </div>
                </div>
                <div id="container_download_app">
                    <div id="container_imagem_app">
                        <div id="imagem_app" class="center">

                        </div>
                    </div>
                    <div id="container_btn_app">
                        <input type="button" value="Download App">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>