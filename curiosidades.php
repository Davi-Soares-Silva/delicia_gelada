<?php

require_once("bd/conexao.php");
$titulo = (string) null;
$descricao = (string) null;

$conexao = conexaoMysql();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Curiosidades</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/curiosidades.css">
    <script src="js/jquery.js"></script>
    <script src="js/animacao_curiosidades.js"></script>
</head>

<body>
    <!-- Área do Cabeçalho -->
    <div id="caixa_cabecalho">

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

    <!-- Título da área de curiosidades -->

    <div id="container_titulo_curiosidades">
        <div class="conteudo center">
            <h1>Curiosidades dos nossos produtos</h1>
        </div>
    </div>

    <!-- Área dos cards com as curiosidades -->
    <div id="container_curiosidades">
        <div class="conteudo center">
            <div id="caixa_curiosidades" class="center">
                <div class="linha_caixa_curiosidades">

                    <?php
                    // Select para trazer os dados da tabela de curiosidades
                    $sql = "SELECT * FROM tbl_curiosidades";

                    // Executando o script no BD e armazenando os dados em uma variável
                    $select = mysqli_query($conexao, $sql);

                    while ($rs = mysqli_fetch_array($select)) {
                        if($rs['status'] == 1){
                        ?>

                        <div class="card_curiosidade um">
                            <div class="frente">
                                <div class="card_container_imagem">
                                    <div class="card_imagem center">

                                    </div>
                                </div>
                                <div class="card_titulo">
                                    <h1><?= ($rs['titulo']) ?></h1>
                                </div>
                            </div>
                            <div class="fundo">
                                <div class="descricao_curiosidade center">
                                    <span>
                                        <?= ($rs['descricao']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>



                    <?php
                        }
                    }
                    ?>
                    <!-- <div class="card_curiosidade dois">
                        <div class="frente">
                            <div class="card_container_imagem">
                                <div class="card_imagem center">

                                </div>
                            </div>
                            <div class="card_titulo">
                                <h1>Saudável</h1>
                            </div>
                        </div>
                        <div class="fundo">
                            <div class="descricao_curiosidade center">
                                <span>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue
                                    massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero,
                                    sit amet commodo magna eros quis urna.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card_curiosidade tres">
                        <div class="frente">
                            <div class="card_container_imagem">
                                <div class="card_imagem center">

                                </div>
                            </div>
                            <div class="card_titulo">
                                <h1>Saboroso</h1>
                            </div>
                        </div>
                        <div class="fundo">
                            <div class="descricao_curiosidade center">
                                <span>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue
                                    massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero,
                                    sit amet commodo magna eros quis urna.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="linha_caixa_curiosidades">
                    <div class="card_curiosidade quatro">
                        <div class="frente">
                            <div class="card_container_imagem">
                                <div class="card_imagem center">

                                </div>
                            </div>
                            <div class="card_titulo">
                                <h1>Prático</h1>
                            </div>
                        </div>
                        <div class="fundo">
                            <div class="descricao_curiosidade center">
                                <span>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue
                                    massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero,
                                    sit amet commodo magna eros quis urna.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card_curiosidade natural">
                        <div class="frente">
                            <div class="card_container_imagem">
                                <div class="card_imagem center">

                                </div>
                            </div>
                            <div class="card_titulo">
                                <h1>Natural</h1>
                            </div>
                        </div>
                        <div class="fundo">
                            <div class="descricao_curiosidade center">
                                <span>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue
                                    massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero,
                                    sit amet commodo magna eros quis urna.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card_curiosidade seis">
                        <div class="frente">
                            <div class="card_container_imagem">
                                <div class="card_imagem center">

                                </div>
                            </div>
                            <div class="card_titulo">
                                <h1>Alegre</h1>
                            </div>
                        </div>
                        <div class="fundo">
                            <div class="descricao_curiosidade center">
                                <span>
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue
                                    massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero,
                                    sit amet commodo magna eros quis urna.
                                </span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>


    <!-- Área do Rodapé -->
    <div id="caixa_rodape">
        <footer class="center conteudo">
            <div id="caixa_conteudo_rodape">
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