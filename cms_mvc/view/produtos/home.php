<?php
    $page = isset($_GET['page'])?$_GET['page']:null;
    if(isset($_SESSION['page'])){
        $page = $_SESSION['page'];
        session_destroy();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adm. Produtos</title>
    <link rel="stylesheet" href="../cms/css/cms.css">
    <link rel="stylesheet" href="view/css/home.css">
</head>

<body>
    <div id="container_cabecalho_cms">
        <div class="conteudo center">
            <div id="container_titulo_cabecalho_cms">
                <h1>CMS - <span>Sistema de Gerenciamento do Site</span></h1>
            </div>
            <div id="container_imagem_cabecalho_cms">
                <div id="imagem_cabecalho_cms" class="background">

                </div>
            </div>
        </div>
    </div>

    <!-- Área das opções de gerenciamento para o usuário -->
    <div id="container_opcoes_gerenciamento">
        <div class="conteudo center">
            <div id="container_adm_conteudo">
                <div class="imagem_opcao_gerenciamento adm_conteudo center background"></div>
                <div class="titulo_opcao_gerenciamento">
                    <a href="index.php?page=categorias" class="">Adm. Categorias</a>
                </div>
            </div>

            <div id="container_adm_fale_conosco">
                <div class="imagem_opcao_gerenciamento adm_fale_conosco center background">

                </div>
                <div class="titulo_opcao_gerenciamento">
                    <a href="index.php?page=sub_categorias" class="">Adm. Sub-Categorias</a>
                </div>
            </div>
            <div id="container_informacoes_usuario">

                <div id="container_nome_usuario">
                    <span><strong>Bem-Vindo</strong>, </span>
                </div>
                <div id="container_logout">
                    <a href="../home.php?logout=ok">Logout</a>
                </div>
            </div>
            <div id="container_adm_usuarios">
                <div class="imagem_opcao_gerenciamento adm_usuarios center background">
                </div>
                <div class="titulo_opcao_gerenciamento">
                    <a href="index.php?page=produtos" class="">Adm. Produtos</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Área do conteudo que será administrado no cms -->
    <div id="container_conteudo_cms">
        <div class="conteudo center">
            <?= require_once('view/'.$page.'/'.$page.'.php') ?>
        </div>
    </div>

    <!-- Rodapé de todas as páginas do CMS -->

    <div id="container_rodape_cms">
        <div class="conteudo center">
            <h1>Desenvolvido por <strong>Davi Soares</strong></h1>
        </div>
    </div>
</body>

</html>