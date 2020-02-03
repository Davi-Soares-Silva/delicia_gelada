<?php

    $nome = (string) null;
    $email = (string) null;
    $telefone = (string) null;
    $celular = (string) null;
    $profissao = (string) null;
    $sexo = (string) null;
    $tipoMensagem = (string) null;
    $mensagem = (string) null;
    $homepage = (string) null;
    $link_facebook = (string) null;


    if(isset($_POST['btnEnviar'])){
        require_once("conexao.php");


        $conexao = conexaoMysql();

        $nome = $_POST['txtNome'];
        $email = $_POST['txtEmail'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $profissao = $_POST['txtProfissao'];
        $sexo = $_POST['rdoSexo'];
        $tipoMensagem = $_POST['rdoTipoMensagem'];
        $mensagem = $_POST['txtMensagem'];
        $homepage = $_POST['txtHomePage'];
        $link_facebook = $_POST['txtFacebook'];

        if($nome == '' || $email == '' || $celular == '' || $profissao == '' || $sexo == '' || $mensagem == ''){
            echo ("Tem campo vazio aí, meu irmão!");
        }else{
            $sql = 
            "
            INSERT INTO tbl_contato(nome, email, telefone, 
            celular, profissao, sexo, tipo_mensagem, mensagem, homepage, link_facebook)

            VALUES ('".$nome."','".$email."','".$telefone."',
                    '".$celular."','".$profissao."','".$sexo."','".$tipoMensagem."',
                    '".$mensagem."', '".$homepage."', '".$link_facebook."');
            ";

            // echo($sql);

            if(mysqli_query($conexao, $sql)){
                header('location: ../contato.php');
            }else{
                echo($sql);
                echo("ERRO: problema de execução do script no banco de dados");
            }
        }

        

    }
