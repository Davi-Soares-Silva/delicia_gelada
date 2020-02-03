<?php
    // Verificando se o modo que chegou foi o excluir
    if(isset($_GET['modo'])){
        // Criando uma variável para receber o codigo passado pela outra pagina
        $codigo = $_GET['codigo'];
        // echo("O codigo do contato é ". $codigo);

        // Criando o script para deleter o contato no bd;
        $sql = "DELETE FROM tbl_contato WHERE codigo = ".$codigo;

        // Abrindo a conexão no BD
        require_once("conexao.php");
        $conexao = conexaoMysql();
        
        if(mysqli_query($conexao, $sql)){
            // header('location:../cms/adm_fale_conosco.php');
            echo("Mensagem deletada com sucesso");
            
        }else{
            echo("Mensagem não pode ser deletada");
            echo($sql);
        }

    }

?>