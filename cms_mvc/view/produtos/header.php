<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adm. Produtos</title>
    <?php
    if (isset($_GET['modo'])) {
        ?>
        <link rel="stylesheet" href="../cms/css/cms.css">
        <link rel="stylesheet" href="view/css/home.css">
    <?php
    } else {
        ?>
        <link rel="stylesheet" href="../../../cms/css/cms.css">
        <link rel="stylesheet" href="../css/home.css">
    <?php
    }
    ?>



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

            <div id="container_adm_conteudo" class="produtos">
                <div id="container_titulo_home">
                    <h1>Administração de Produtos</h1>
                </div>
                <div id="container_imagem_home">
                    <img src="../images/adm_produtos_home.png" alt="">
                </div>
            </div>
            <div id="container_informacoes_usuario">

                <div id="container_nome_usuario">
                    <span><strong>Bem-Vindo</strong>,</span>
                </div>
                <div id="container_logout">
                    <a href="../home.php?logout=ok">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Área do conteudo que será administrado no cms -->
    <div id="container_conteudo_cms">