<?php

if (isset($_GET['logout'])) {
    if ($_GET['logout'] == 'ok') {
        session_start();
        session_destroy();
        echo ("<script>alert('sessão finalizada!')</script>");
    }
}
// Abrindo a conexão com o banco
require_once("bd/conexao.php");
$conexao = conexaoMysql();

if (isset($_POST['btn_login'])) {
    $email = $_POST['txtUsuarioCms'];
    $senha = $_POST['txtSenhaCms'];

    $sqlLogin = "SELECT u.*, n.ativado FROM tbl_usuarios u INNER JOIN tbl_nivel_usuarios n ON u.id_nivel = n.id_nivel WHERE email ='" . $email . "' AND senha='" . $senha . "'";

    $selectLogin = mysqli_query($conexao, $sqlLogin);

    if ($rs = mysqli_fetch_array($selectLogin)) {
        if ($rs['ativado_usuario'] == 0) {
            echo ("<script>alert('Usuário desativado')</script>");
        } else {
            if ($rs['ativado'] == 1) {
                echo ("<script>alert('Usuário autenticado com sucesso.')</script>");
                // Ativando o recurso para variáveis de sessão
                session_start();

                // colocando as informações do SELECT em variáves de sessão
                $_SESSION['nome'] = $rs['nome'];
                $_SESSION['nivel'] = $rs['id_nivel'];
                $_SESSION['usuarioAutenticado'] = true;
                $_SESSION['idUsuarioAutenticado'] = $rs['id_usuario'];

                header('location: cms/home.php');
            } else {
                echo ("<script>alert('Nível desativado')</script>");
            }
        }
    } else {
        echo ("<script>alert('Usuário ou senha inválidos!')</script>");
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Delícia Gelada</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="stylesheet" href="./css/responsive_slider.css">
</head>

<body>
    <!-- Área do Cabeçalho -->
    <div id="caixa_cabecalho" class="transition">

        <!-- Logo -->
        <nav class="conteudo center transition" id="area_menu">
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
                <form id="frm_login" class="center" name="frm_login_cms" method="POST" action="home.php">
                    <div id="container_informacoes_frm_login">
                        <div class="linha_frm_login transition">
                            <label for="txtUsuarioCms">Usuário</label><br><input type="text" name="txtUsuarioCms">
                        </div>
                        <div class="linha_frm_login transition">
                            <label>Senha</label><br><input type="password" name="txtSenhaCms">
                        </div>
                    </div>
                    <div id="container_btn_frm_login" class="transition">
                        <input type="submit" value="Ok" name="btn_login">
                    </div>
                </form>
            </div>
        </nav>
    </div>

    <!--  Área do Slider -->

    <div id="conteudo_slide">
        <div id="container_slider" class="conteudo center">
            <div class="container">
                <header class="hide">
                    <p>SLIDE RESPONSIVO DEVMEAN</p>
                </header>
                <!-- Inicio do Slider -->
                <section class="slider">
                    <div class="slider_box">
                        <header class="hide">

                        </header>
                        <article class="slider_item active" data-slider-bg="images/jarros_suco_laranja_slide.jpg">


                        </article>

                        <article class="slider_item" data-slider-bg="images/frutas_variadas_slide.jpg">

                        </article>

                        <article class="slider_item" data-slider-bg="images/mexirica_slide.jpg">

                        </article>

                        <article class="slider_item" data-slider-bg="images/cereja_slide.jpg">

                        </article>

                    </div>
                    <div class="slider-prev"></div>
                    <div class="slider-next"></div>
                </section>
                <!-- Fim do Slider -->

            </div>
        </div>
    </div>

    <!-- Área do Conteúdo do Site -->



    <!-- Menu de categorias -->
    <div id="container_conteudo">
        <div class="conteudo center">
            <div id="caixa_teste">
                <div id="container_redes_sociais">
                    <div id="caixa_conteudo_redes_sociais"></div>
                    <div id="redes_sociais">
                        <div class="logo_rede_social">
                            <img src="images/logo_instagram.png" alt="Logo Instagram">
                        </div>
                        <div class="logo_rede_social">
                            <img src="./images/logo_twitter.png" alt="Logo Twitter">
                        </div>
                        <div class="logo_rede_social">
                            <img src="./images/logo_facebook.png" alt="Logo Facebook">
                        </div>
                    </div>
                </div>
            </div>
            <div id="caixa_conteudo" class="center">
                <div id="caixa_area_menu_categorias">
                    <div id="container_menu_categorias" class="center">
                        <div id="caixa_menu_categorias">
                            <?php
                            $sql = "SELECT * FROM tbl_categorias";
                            $select  = mysqli_query($conexao, $sql);

                            $cont = 1;
                            while ($rs = mysqli_fetch_array($select)) {
                                ?>

                                <div class="menu_categoria_item" data-id="<?= $cont ?>">
                                    <a><?= $rs['nome'] ?></a>
                                    <div class="submenu_categoria" id="submenu<?= $cont ?>">
                                        <?php
                                            $sql = "SELECT * FROM tbl_sub_categorias s LEFT JOIN tbl_categorias c ON s.id_sub_categoria = c.id WHERE id_categoria =" . $rs['id'];
                                            $select = mysqli_query($conexao, $sql);
                                            while ($rs = mysqli_fetch_array($select)) {
                                                ?>
                                            <div class="submenu_categoria_item">
                                                <a><?= $rs['nome_sub_categoria'] ?></a>
                                            </div>
                                        <?php
                                            }
                                            ?>
                                    <?php
                                        $cont++;
                                    }
                                    ?>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>


                <!-- Produtos -->
                <div id="caixa_produtos">
                    <div id="container_produtos">
                        <div id="container_sessao_produtos">
                            <?php
                            $sql = "SELECT * FROM tbl_produtos";
                            $select = mysqli_query($conexao, $sql);

                            while ($rs = mysqli_fetch_array($select)) {
                                ?>
                                <div class="produto">
                                    <div class="container_imagem_produto">
                                        <div class="imagem_produto center">
                                            <img src="cms_mvc/model/arquivos/<?= $rs['img_produto'] ?>" alt="suco de laranja">
                                        </div>
                                    </div>
                                    <div class="container_informacoes_produto">
                                        <div class="linha_informacao_produto">
                                            <div class="produto_nome">
                                                <span> <?= $rs['nome_produto'] ?>
                                                </span>
                                            </div>
                                            <div class="produto_preco">
                                                <h1>R$ <?= $rs['preco_produto'] ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="produto_descricao">
                                        <span> <?= $rs['descricao_produto'] ?>
                                        </span>
                                        <div class="container_btn_detalhes_produto">
                                            <button>Detalhes</button>
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
        </div>
    </div>

    <!-- Área do Rodapé -->

    <div id="caixa_rodape">
        <footer class="center conteudo">
            <div id="caixa_conteudo_rodape">
                <a href="cms_mvc/index.php?page=produtos">
                    <div id="container_btn_sistema_interno">
                        <input type="submit" value="Sistema Interno">
                    </div>
                </a>
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

    <!-- Scripts para o Slide -->
    <script src="js/jquery.js"></script>
    <script src="js/slider.js"></script>

    <!-- Script para o Menu de Categorias -->
    <script src="js/menu_categoria.js"></script>

    <!-- Script para o Menu Principal -->
    <script src="js/menu.js"></script>
</body>

</html>