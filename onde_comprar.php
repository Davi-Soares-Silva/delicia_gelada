<?php
require_once("bd/conexao.php");
$conexao = conexaoMysql();
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/onde_comprar.css">
    <script src="js/jquery.js"></script>
    <script src="./js/animacao_onde_comprar.js"></script>
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

    <!-- Área das Informações de onde comprar -->

    <!-- Imagem com o titulo onde estamos -->
    <div id="container_onde_estamos">
        <div class="conteudo center">
            <div id="caixa_texto_onde_estamos" class="center">
                <div class="linha_texto_onde_estamos">
                    <h1>Onde Estamos</h1>
                </div>
                <div class="linha_texto_onde_estamos m">
                    <h1>Atualmente?</h1>
                </div>
            </div>
        </div>
    </div>

    <?php
    $sql = "SELECT * FROM tbl_nossas_lojas WHERE status <> 0";

    $select = mysqli_query($conexao, $sql);

    while ($rs = mysqli_fetch_array($select)) {

        ?>

        <!-- Área das informações de localização da empresa -->
        <div id="container_informacoes_onde_estamos">
            <div class="conteudo center">
                <div id="container_imagem_informacao_localizacao">
                    <div id="imagem_localizacao" class="center">

                    </div>
                </div>
                <div id="container_descricao_informacoes">
                    <p>
                        <?=$rs['nome']?><br>
                        <?=$rs['telefone']?><br>
                        <?=$rs['rua']?><br>
                        <?=$rs['municipio']?> - <?=$rs['uf']?>  SP<br>
                        <?=$rs['cep']?>
                    </p>
                </div>
            </div>
        </div>

        <div id="container_mapa_localizacao">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.0585542545346!2d-46.69419408502147!3d-23.602232884662683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce5735c934cfbb%3A0x1c104064af0b9412!2sAv.%20Engenheiro%20Lu%C3%ADs%20Carlos%20Berrini%2C%20666%20-%20Itaim%20Bibi%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2004533-085!5e0!3m2!1spt-BR!2sbr!4v1569174456753!5m2!1spt-BR!2sbr" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>

    <?php
    }
    ?>


    <!-- Área do rodapé -->
    <div id="caixa_rodape">
        <footer class="center conteudo">
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