<?php
    require_once("bd/conexao.php");

    $conexao = conexaoMysql();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/empresa.css">
    <title>Delícia Gelada</title>
</head>

<body>
    <!-- Área do cabeçalho -->
    <div id="caixa_cabecalho" class="empresa">

        <!-- Logo -->
        <nav class="conteudo center" id="area_menu_empresa">
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
                            <label>Usuário</label><br><input type="text">
                        </div>
                        <div class="linha_frm_login">
                            <label>Senha</label><br><input type="text">
                        </div>
                    </div>
                    <div id="container_btn_frm_login">
                        <input type="submit" value="Ok">
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- Área das Sessões -->


    <!-- Sessão da História da Empresa -->
    <div class="sessao_empresa">
        <div class="container_informacao_empresa conteudo center">
            <div class="titulo_sessao_empresa">
                <h1>História</h1>
            </div>
            <div class="descricao_sessao_empresa">
                <div class="container_texto_descricao center">
                    <p class="center">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor
                        congue massa. Fusce
                        posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna
                        eros
                        quis urna.
                        Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        Proin
                        pharetra nonummy pede. Mauris et orci.
                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor
                        congue massa. Fusce
                        posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna
                        eros
                        quis urna.
                        Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        Proin
                        pharetra nonummy pede. Mauris et orci.

                        Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                        Proin
                        pharetra nonummy pede. Mauris et orci.
                    </p>
                </div>
            </div>
            <div class="imagem_sessao_empresa">
                <div class="container_imagem_sessao_empresa center">
                    <img src="./images/plantacao_empresa.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    <?php
        $sql = "SELECT * FROM tbl_sobre WHERE status <> 0";
        $select = mysqli_query($conexao, $sql);

        while($rs = mysqli_fetch_array($select)){
    ?>

    <div class="sessao_empresa">
        <div class="container_informacao_empresa conteudo center direita">
            <div class="titulo_sessao_empresa">
                <h1><?=$rs['titulo_sessao']?></h1>
            </div>
            <div class="imagem_sessao_empresa icone_sessao">
                <div class="container_imagem_sessao_empresa center">
                    <img src="cms/bd/arquivos/<?=$rs['img_sessao']?>" alt="" class="imagem_esquerda">
                </div>
            </div>
            <div class="descricao_sessao_empresa icone_sessao">
                <div class="container_texto_descricao center">
                    <p class="center"><?=$rs['texto_sessao']?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
    ?>

    <!-- <div class="sessao_empresa">
        <div class="container_informacao_empresa conteudo center">
            <div class="titulo_sessao_empresa">
                <h1>Visão</h1>
            </div>

            <div class="descricao_sessao_empresa icone_sessao">
                <div class="container_texto_descricao center visao">
                    <p class="center">TORNAR-SE A MARCA DE SUCOS NATURAIS MAIS CONSUMIDA NO MERCADO NACIONAL, OFERECENDO
                        PRODUTOS DE ALTA QUALIDADE E DE SABOR INCOMPARÁVEL.
                    </p>
                </div>
            </div>
            <div class="imagem_sessao_empresa icone_sessao">
                <div class="container_imagem_sessao_empresa center">
                    <img src="./images/icone_visao.png" alt="" class="imagem_esquerda">
                </div>
            </div>
        </div>
    </div>

    <div class="sessao_empresa">
        <div class="container_informacao_empresa direita conteudo center">
            <div class="titulo_sessao_empresa">
                <h1>Valores</h1>
            </div>
            <div class="imagem_sessao_empresa icone_sessao">
                <div class="container_imagem_sessao_empresa center">
                    <img src="./images/icone_valores.png" alt="" class="imagem_esquerda">
                </div>
            </div>
            <div class="descricao_sessao_empresa icone_sessao">
                <div class="container_texto_descricao center valores">
                    <p class="center">INTEGRIDADE, TRANSPARÊNCIA, COMPROMETIMENTO, INOVAÇÃO E QUALIDADE.
                    </p>
                </div>
            </div>
        </div>
    </div> -->

    <div id="caixa_rodape" class="rodape_empresa">
        <footer class="center conteudo">
            <div id="caixa_conteudo_rodape_empresa">
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
    <script src="./js/jquery.js"></script>
    <script src="./js/animacao.js"></script>
</body>

</html>