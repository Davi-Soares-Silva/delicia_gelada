<?php

// Importando o arquivo de conexão e iniciando a sessão
require_once("../../bd/conexao.php");

$conexao = conexaoMysql();
session_start();


// Verificando se o botão de salvar existe
if (isset($_POST['btnSalvarLoja'])) {

    $nomeLoja = $_POST['txtNomeLoja'];
    $telLoja = $_POST['txtTelefoneLoja'];
    $ruaLoja = $_POST['txtRuaLoja'];
    $cidadeLoja = $_POST['txtCidadeLoja'];
    $UfLoja = $_POST['txtUfLoja'];
    $cepLoja = $_POST['txtCepLoja'];
    $linkMapaLoja = $_POST['txtMapaLoja'];

    // Verificando se o botão de salvar é para inserir
    if ($_POST['btnSalvarLoja'] == "Salvar") {

// Declarando o sql para inserir
        $sql = "INSERT INTO tbl_nossas_lojas(nome, telefone, rua, municipio, uf, cep, link_mapa, status)
            VALUES ('" . $nomeLoja . "', '" . $telLoja . "', '" . $ruaLoja . "', '" . $cidadeLoja . "','" . $UfLoja . "', '" . $cepLoja . "','" . $linkMapaLoja . "', 1 )";

    // Verificando se o botão de salvar é para editar
    } elseif ($_POST['btnSalvarLoja'] == "Editar") {


// Declarando o sql para editar

        $sql = "UPDATE tbl_nossas_lojas SET
        nome = '" . $nomeLoja . "',
        telefone = '" . $telLoja . "',
        rua = '" . $ruaLoja . "',
        municipio = '" . $cidadeLoja . "',
        uf = '" . $UfLoja . "',
        cep = '" . $cepLoja . "',
        link_mapa = '" . $linkMapaLoja . "'
        WHERE id =" . $_SESSION['id_loja'];
    }

    // Executando no BD e exibindo caso haja erros a variável sql
    if (mysqli_query($conexao, $sql)) {
        echo ("fooooooooi");
    } else {
        echo ($sql);
    }
} elseif ($_GET['modo']) {

    // Verificando se o modo é excluir, ativar, ou desativar. Pegando o id pelo GET e Executando no BD
    $id_loja = $_GET['codigo'];

    if ($_GET['modo'] == "excluir") {
        $sql = "DELETE FROM tbl_nossas_lojas WHERE id =" . $id_loja;
    } elseif ($_GET['modo'] == "ativar") {
        $sql = "UPDATE tbl_nossas_lojas SET status = 1 WHERE id =" . $id_loja;
    } elseif ($_GET['modo'] == "desativar") {
        $sql = "UPDATE tbl_nossas_lojas SET status = 0 WHERE id =" . $id_loja;
    }

    if (mysqli_query($conexao, $sql)) {
        header("location: ../visualizar_nossas_lojas.php");
    } else {
        echo ($sql);
    }
}
