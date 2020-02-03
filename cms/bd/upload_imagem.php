<?php

function uploadImagem($file)
{
    // Variáveis para o upload de arquivos
    // Isso pode ser usado de uma maneira mais semântica como uma constante
    $diretorio = (string) "arquivos/";
    $tamanhoPermitido = (int) 1024;
    $arquivosPermitidos = array("image/jpeg", "image/png", "image/jpg");

    session_start();


    // Iremos recuperar a foto usando o $file['nome do elemento no html']
    $tipoArquivo = $file['type'];


    // Tratamento para o tipo de arquivo vazio
    if ($file['type'] != "") {

        // Tratamento para tamanho do arquivo vazio
        if ($file['size'] > 0) {
            // Permite buscar dentro de um array determinado conteúdo
            if (in_array($tipoArquivo, $arquivosPermitidos)) {

                // Resgata o tamanho do arquivo a ser upado para o servidor
                // Arredondando-o para pegar somente a parte inteira do número utilizando o round()
                $tamanhoArquivo = round(($file['size'] / 1024));

                if ($tamanhoArquivo <= $tamanhoPermitido) {

                    $nomeCompletoArquivo = $file['name'];
                    // pathinfo() - permite pegar qualquer parte do nome de um arquivo

                    // Utilizando o parâmeto PATHINFO_FILENAME pegamos apenas o nome
                    // Utilizando o parâmetro PATHINFO_EXTENSION pegamos a extensão do arquivo
                    $nomeArquivo = pathinfo($nomeCompletoArquivo, PATHINFO_FILENAME);
                    $extArquivo = pathinfo($nomeCompletoArquivo, PATHINFO_EXTENSION);

                    /* 

                        Algoritmos de criptografia do PHP:
                        MD5()
                        sha1()

                        hash(var, tipo do algoritmo)
                    
                         */

                    // Para gerar o nome do arquivo que nunca se repita usamos:
                    // uniqid() - que gera um valor aleatorio com base em informações de hardware da maquina e numero aleatório;
                    // md5() - para embaralhar os dados
                    // time() - que retorna hh:mm:ss

                    $nomeCriptografado = MD5(uniqid() . time() . $nomeArquivo);
                    $nomeFoto = $nomeCriptografado . "." . $extArquivo;

                    $arquivoTemp = $file['tmp_name'];

                    if (move_uploaded_file($arquivoTemp, $diretorio . $nomeFoto)) {

                        return $nomeFoto;

                    } else {
                        // Tratamento para ver se a imagem foi movida com sucesso
                        return null;
                        // echo ("<script>alert(Erro ao mover imagem)</script>");
                    }
                } else {
                    // Tratamento de tamanho acima do permitido
                    return null;
                    // echo ("<script>alert('Tamanho do arquivo selecionado não é suportado (1Mb)')</script>");
                }
            } else {
                // Tratamento do tipo de arquivo
                return null;
                // echo ("<script>alert('Tipo de arquivo selecionado não é suportado')</script>");
            }
        } else {
            // Tratamento para arquivo com tamanho = 0;
            return null;
            // echo ("<script>alert('Não é possível fazer upload de um arquivo sem tamanho')</script>");

        }
    } else {
        // Tratamento do type vazio
        return null;
        // echo ("<script>alert('Não é possível fazer upload de um tipo de arquivo inválido')</script>");
    }
}
