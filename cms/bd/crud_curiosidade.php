<?php
session_start();
// require_once("../header.php");
require_once("../../bd/conexao.php");
$conexao = conexaoMysql();


// Verificando se o botão salvar de curiosidades existe
if (isset($_POST['btnSalvarCuriosidade'])) {

    // pegando os valores do post do formulario
    $titulo = $_POST['txtTituloCuriosidades'];
    $descricao = $_POST['txtDescricaoCuriosidade'];
    $status = isset($_POST['chkStatus']) ? 1 : 0;

    // Verificando se o botão é para salvar
    if ($_POST['btnSalvarCuriosidade'] == "Adicionar") {

        // Declarando a variavel sql para inserir
        $sql = "INSERT INTO tbl_curiosidades (titulo, descricao, status)
            VALUES ('" . $titulo . "', '" . $descricao . "', $status)";


// Verificando se o botão é para editar
    } elseif ($_POST['btnSalvarCuriosidade'] == "Editar") {

        // Declarando a variavel sql para editar
        $sql = "UPDATE tbl_curiosidades SET titulo = '".$titulo."',
        descricao = '".$descricao."',
        status = '".$status."' WHERE id =" .$_SESSION['id_curiosidade'];

    }


    // Executando o sql no banco e exibindo o sql caso haja algum erro
    if (mysqli_query($conexao, $sql)) {
        header("location: ../visualizar_curiosidades.php");
        session_unset($_SESSION['id_curiosidade']);
    } else {
        echo ("Erro ao executar script no BD");
        echo ($sql);
    }
    

    // Verificando se o modo via GET existe e se ele é excluir
}elseif(isset($_GET['modo'])){
    if($_GET['modo'] == "excluir"){
        // echo('teste');
        $idCuriosidade = $_GET['codigo'];
        $sql = "DELETE FROM tbl_curiosidades WHERE id=".$idCuriosidade;

    // Executando o sql no banco e exibindo o sql caso haja algum erro

        if(mysqli_query($conexao, $sql)){
            header("location: ../visualizar_curiosidades.php");
        }else{
            echo($sql);
        }
    }
}
?>