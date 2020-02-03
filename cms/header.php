<?php
// Abrindo a conexão com o BD
require_once("../bd/conexao.php");
$conexao = conexaoMysql();

// Criando as váriaveis para tatar os erros
$statusConteudo = (string) null;
$linkConteudo = (string) null;
$linkFaleConosco = (string) null;
$linkUsuario = (string) null;
$statusFaleConoscoo = (string) null;
$statusUsuario = (string) null;

// Iniciando a sessão para recuperar as variáveis que estão nela
session_start();

if ($_SESSION['usuarioAutenticado'] == true) {
    // header("location: ../home.php");
    // echo("<script>alert('Usuário autenticado com sucesso.')</script>");
    // echo ($_SESSION['nivel']);
} else {
    header("location: ../home.php");
}

// Criando a variável de sessão do nivel do usuario para fazer um select na tabela de níveis
$id_nivel = $_SESSION['nivel'];

// Fazendo o SELECT do nível no BD
$sqlNivelUsuario = "SELECT * FROM tbl_nivel_usuarios WHERE id_nivel = " . $id_nivel;
$selectNivel = mysqli_query($conexao, $sqlNivelUsuario);
if ($rs = mysqli_fetch_array($selectNivel)) {
    // echo ("<script>alert('Tá dando certo, uhuuuul')</script>");

    // Verificando se os adms estão checkeds no banco e assim dando suas respectivas permissões com as váriaveis no link
    if ($rs['adm_conteudo'] == 0) {
        $statusConteudo = "bloqueado";
        $linkConteudo = "#";
    } else {
        $linkConteudo = "adm_conteudo.php";
    }

    if ($rs['adm_fale_conosco'] == 0) {
        $statusFaleConoscoo = "bloqueado";
        $linkFaleConosco = "#";
    } else {
        $linkFaleConosco = "adm_fale_conosco.php";
    }

    if ($rs['adm_usuario'] == 0) {
        $statusUsuario = "bloqueado";
        $linkUsuario = "#";
    } else {
        $linkUsuario = "adm_usuarios.php";
    }

    // Verificando se algum erro ocorreu ao executar o comando no BD
} else {
    echo ("<script>alert('Tá dando errado :(')</script>");
    echo ($sqlNivelUsuario);
}
?>

<!-- Cabeçalho de todas as páginas do CMS -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMS</title>
    <link rel="stylesheet" href="css/cms.css">
    <link rel="stylesheet" href="css/cms_fale_conosco.css">
    <link rel="stylesheet" href="css/cms_adm_usuarios.css">
    <link rel="stylesheet" href="css/cms_visualizar_usuarios.css">
    <link rel="stylesheet" href="css/cms_visualizar_niveis.css">
    <link rel="stylesheet" href="css/cms_adm_conteudo.css">
    <link rel="stylesheet" href="css/cms_visualizar_curiosidades.css">
    <link rel="stylesheet" href="css/cms_visualizar_sobre.css">
    <link rel="stylesheet" href="css/cms_visualizar_nossas_lojas.css">
    <script src="../js/jquery.js"></script>
    <script src="js/modal.js"></script>
    <script src="js/animacoes.js"></script>
    <script src="js/jquery.form.js"></script>


    <!-- <script src="js/fale_conosco_dados_modal.js"></script> -->

    <script>
        function visualizarDados(idItem) {
            $.ajax({
                type: "POST",
                url: "../bd/contato_modal.php",
                data: {
                    modo: 'visualizar',
                    codigo: idItem
                },
                success: function(dados) {
                    $('#conteudo_modal').html(dados);
                }
            });
        }

        function excluirMensagemCliente(idItem, nomeCliente) {
            $.ajax({
                type: "POST",
                url: "../bd/modal_excluir.php",
                data: {
                    modo: 'confirmarExclusao',
                    codigo: idItem,
                    tipo_exclusao: 'mensagem'
                },
                success: function(dados) {
                    $('#modal_excluir').html(dados);
                }
            });
        }

        function excluirUsuario(idItem) {
            $.ajax({
                type: "POST",
                url: "../bd/modal_excluir.php",
                data: {
                    modo: 'confirmarExclusao',
                    codigo: idItem,
                    tipo_exclusao: 'usuario'
                },
                success: function(dados) {
                    $('#modal_excluir').html(dados);
                }
            });
        }

        function carregarUsuario(idItem) {
            $.ajax({
                type: "POST",
                url: "bd/crud_usuario.php",
                data: {
                    modo: 'carregarUsuario',
                    codigo: idItem,
                },
                success: function(dados) {
                    $('#conteudo_modal_add_usuario').html(dados);
                }
            });
        }

        function excluirNivel(idItem) {
            $.ajax({
                type: "POST",
                url: "../bd/modal_excluir.php",
                data: {
                    modo: 'confirmarExclusaoNivel',
                    codigo: idItem,
                    tipo_exclusao: 'nivel'
                },
                success: function(dados) {
                    $('#container_modal_excluir').html(dados);
                }
            });
        }

        function carregarNivel(idItem) {
            $.ajax({
                type: "POST",
                url: "bd/crud_nivel.php",
                data: {
                    modo: 'carregarNivel',
                    codigo: idItem,
                },
                success: function(dados) {
                    $('#container_conteudo_modal_nivel').html(dados);
                }
            });
        }

        function visualizarCuriosidade(idItem) {
            $.ajax({
                type: "POST",
                url: "bd/crud_curiosidade.php",
                data: {
                    modo: 'carregarCuriosidade',
                    codigo: idItem
                },
                success: function(dados) {
                    $('#container_modal_visualizar_curiosidade').html(dados);
                }
            });

        }

        function excluirCuriosidade(idItem) {
            $.ajax({
                type: "POST",
                url: "../bd/modal_excluir.php",
                data: {
                    modo: 'confirmarExclusao',
                    codigo: idItem,
                    tipo_exclusao: 'curiosidade'
                },
                success: function(dados) {
                    $('#modal_excluir').html(dados);
                }
            });
        }



        function excluirSobre(idItem, imgItem) {
            $.ajax({
                type: "POST",
                url: "../bd/modal_excluir.php",
                data: {
                    modo: 'confirmarExclusao',
                    codigo: idItem,
                    tipo_exclusao: 'sobre',
                    img: imgItem
                },
                success: function(dados) {
                    $('#container_modal_excluir').html(dados);
                }
            });
        }

        // $('#file_foto').live('change', function(){

        //     // Ao entrar no evento live estamos forçando o submit no formulário e foto
        //     // $('#frm_foto').ajaxForm({

        //     //     // Call Back da foto para o preview(div)
        //     //     target: '#img_sobre'

        //     // }).submit();
        //     alert("teste");
        // });

        $(document).ready(function() {
            $('#fileFoto').change(function() {
                $('#frm_foto').ajaxForm({
                    target: '#img_sobre'
                }).submit();
            });
        });


        function carregarSobre(idItem) {
            $.ajax({
                type: "POST",
                url: "bd/crud_sobre.php",
                data: {
                    codigo: idItem,
                    modo: 'carregarSobre'
                },
                success: function(dados) {
                    $('#conteudo_modal_sobre').html(dados);
                }
            });
        }
    </script>
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
                <div class="imagem_opcao_gerenciamento adm_conteudo center background <?= $statusConteudo ?>"></div>
                <div class="titulo_opcao_gerenciamento">
                    <a href="<?= $linkConteudo ?>" class="<?= $statusConteudo ?>">Adm. Conteúdo</a>
                </div>
            </div>

            <div id="container_adm_fale_conosco">
                <div class="imagem_opcao_gerenciamento adm_fale_conosco center background <?= $statusFaleConoscoo ?>">

                </div>
                <div class="titulo_opcao_gerenciamento">
                    <a href="<?= $linkFaleConosco ?>" class="<?= $statusFaleConoscoo ?>">Adm. Fale Conosco</a>
                </div>
            </div>
            <div id="container_informacoes_usuario">

                <div id="container_nome_usuario">
                    <span><strong>Bem-Vindo</strong>, <?= $_SESSION['nome'] ?></span>
                </div>
                <div id="container_logout">
                    <a href="../home.php?logout=ok">Logout</a>
                </div>
            </div>
            <div id="container_adm_usuarios">
                <div class="imagem_opcao_gerenciamento adm_usuarios center background <?= $statusUsuario ?>">
                </div>
                <div class="titulo_opcao_gerenciamento">
                    <a href="<?= $linkUsuario ?>" class="<?= $statusUsuario ?>">Adm. Usuários</a>
                </div>
            </div>
        </div>
    </div>