<?php

// Importando o arquivo que tem a função para upload de imagem
    require_once("upload_imagem.php");

    // Colocando o arquivo numa variável
    $file = $_FILES["fileFotoSobre"];

    // Chamando a fução que move o arquivo para pasta e devolve o nome numa variavel
    $nomeFoto = uploadImagem($_FILES['fileFotoSobre']);

    // Colocando a variável na sessão para fazer o update
    $_SESSION['nomeFoto'] = $nomeFoto;

    // Retornando a img
    echo ("<img src = 'bd/arquivos/" . $nomeFoto . "'>");

?>