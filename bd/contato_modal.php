<?php

require_once("../bd/conexao.php");
$nome = (string) null;
$email = (string) null;
$profissao = (string) null;
$tipoMensagem = (string) null;
$sexo = (string) null;
$telefone = (string) null;
$celular = (string) null;
$homepage = (string) null;
$link_facebook = (string) null;
$mensagem = (string) null;
$modo = (string) null;
$optCriticaSel = (string) null;
$optSugestaoSel = (string) null;


$conexao = conexaoMysql();

if (isset($_POST["modo"])) {
    $modo = (isset($_POST["modo"]));
    if ($modo == 'visualizar') {
        $codigo = $_POST['codigo'];

        $sqlVisualizar = "SELECT * FROM tbl_contato WHERE codigo =" . $codigo;

        $selectVisualizar = mysqli_query($conexao, $sqlVisualizar);


        if ($rs = mysqli_fetch_array($selectVisualizar)) {
            $nome = $rs['nome'];
            $email = $rs['email'];
            $profissao = $rs['profissao'];
            $sexo = $rs['sexo'];
            $telefone = $rs['telefone'];
            $celular = $rs['celular'];
            $homepage = $rs['homepage'];
            $link_facebook = $rs['link_facebook'];
            $mensagem = $rs['mensagem'];

            if ($sexo == "M") {
                $sexo = "Homem";
            } else {
                $sexo = "Mulher";
            }

            if ($rs['tipo_mensagem'] == "S") {
                $tipoMensagem = "Sugestão";
            } else {
                $tipoMensagem = "Crítica";
            }
        }

        ?>

        <div id='container_cabecalho_conteudo_modal'>
            <div id='container_nome_cliente'>
                <h1><?= $nome ?></h1>
            </div>
            <div id='container_profissao_cliente'>
                <h2><?= $profissao ?></h2>
            </div>
            <div id='container_sexo_cliente'>
                <div id='texto_sexo_cliente'>
                    <span><?= $sexo ?></span>
                </div>
                <div id='container_imagem_sexo_cliente'>
                    <?php
                        if($sexo == "Homem"){
                    ?>
                    <img src='imagens/genero_masc_icon.png' alt="sexo">
                    <?php
                        }else{
                    ?>
                        <img src='imagens/genero_fem_icon.png' alt="sexo">
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id='container_email_cliente'>
            <span><?= $email ?></span>
        </div>
        <div id='container_numeros_telefone_cliente'>
            <span><?= $telefone ?></span><br>
            <span><?= $celular ?></span>
        </div>
        <div id='container_tipo_mensagem_cliente'>
            <h2><?= $tipoMensagem ?></h2>
        </div>
        <div id='container_mensagem_cliente'>
            <span><?= $mensagem ?></span>
        </div>

        <div id='container_paginas_cliente'>
            <?php
                    if ($homepage != null) {
                        ?>
                <div class='container_imagem_pag_cliente'>

                </div>

                <div class='container_link_pag_cliente'>
                    <span><?= $homepage ?></span>
                </div>

            <?php
                    }
                    if ($link_facebook != null) {
                        ?>
                <div class='container_imagem_pag_cliente facebook'>

                </div>
                <div class='container_link_pag_cliente'>
                    <span><?= $link_facebook ?></span>
                </div>
            <?php
                    }
                    ?>
        </div>
        <div id='container_acoes_adm'>
            <Button class='responder'>Responder</Button>
            <Button class='excluir'>Excluir</Button>
        <?php
            

        }
    }
    ?>