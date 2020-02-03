<!--
    Classe de manipulação do banco para a Classe de produtos
    Autor: Davi Soares da Silva
    Data de Criação: 09/12/2019
    Data de Modificação:
    Modificações realizadas: 
-->

<?php

class ProdutoDAO
{

    private $conexao;
    private $conexaoMysql;

    public function __construct()
    {
        // Importando o arquivo de conexão MySQL
        require_once("conexaoMysql.php");

        // Instanciando o objeto de conexão com o BD
        $this->conexaoMysql = new conexaoMysql();

        // Abrindo a conexão com o BD
        $this->conexao = $this->conexaoMysql->connectDatabase();
    }

    // Função para inserir um Produto no Banco
    public function insertProduto(Produto $produto)
    {
        $sql = "INSERT INTO tbl_produtos (nome_produto, descricao_produto, preco_produto, porcentagem_desconto, img_produto, id_sub_categoria, status, promocao, produto_mes)
                    VALUES (?, ?, ?, ?, ?, ?, 1, 0, 0)";

        $statement = $this->conexao->prepare($sql);

        $statement_dados = array(
            $produto->getNome(),
            $produto->getDescricao(),
            $produto->getPreco(),
            $produto->getDesconto(),
            $produto->getImagem(),
            $produto->getIdSubCategoria()

        );

        if ($statement->execute($statement_dados)) {
            return true;
        } else {
            var_dump($produto);
        };
    }

    // Função para deletar um contato
    public function deleteProduto($codigo)
    {
        $sql = "DELETE FROM tbl_produtos WHERE codigo =" . $codigo;

        if ($this->conexao->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    // Função para buscar um produto único pelo seu ID
    public function selectProdutoById($codigo)
    {
        $sql  = "SELECT * FROM tbl_produtos WHERE codigo =" . $codigo;
        $select = $this->conexao->query($sql);

        if ($rs = $select->fetch(PDO::FETCH_ASSOC)) {

            $produto = new Produto();

            $produto->setCodigo($rs['codigo']);
            $produto->setNome($rs['nome_produto']);
            $produto->setDescricao($rs['descricao_produto']);
            $produto->setPreco($rs['preco_produto']);
            $produto->setDesconto($rs['porcentagem_desconto']);
            $produto->setImagem($rs['img_produto']);
            $produto->setStatus($rs['status']);
            $produto->setProdutoMes($rs['produto_mes']);
            $produto->setPromocao($rs['promocao']);
            $produto->setIdSubCategoria($rs['id_sub_categoria']);

            return $produto;
        }
    }

    // Função para selecionar todos os produtos cadastrados
    public function selectAllProduto()
    {
        $sql = "SELECT * FROM tbl_produtos";
        $select = $this->conexao->query($sql);

        $cont = 0;

        while ($rs = $select->fetch(PDO::FETCH_ASSOC)) {
            // Criando uma Collection com todos os produtos retornados pelo SQL
            $produtos[] = new Produto();



            $produtos[$cont]->setCodigo($rs['codigo']);
            $produtos[$cont]->setNome($rs['nome_produto']);
            $produtos[$cont]->setDescricao($rs['descricao_produto']);
            $produtos[$cont]->setPreco($rs['preco_produto']);
            $produtos[$cont]->setDesconto($rs['porcentagem_desconto']);
            $produtos[$cont]->setImagem($rs['img_produto']);
            $produtos[$cont]->setStatus($rs['status']);
            $produtos[$cont]->setProdutoMes($rs['produto_mes']);
            $produtos[$cont]->setPromocao($rs['promocao']);
            $produtos[$cont]->setIdSubCategoria($rs['id_sub_categoria']);

            $cont++;
        }
        return $produtos;
    }

    // Função para atualizar um produto
    public function updateProduto(Produto $produto)
    {
        if ($produto->getImagem() == null) {
            // Criando a variavel sql com statements como parâmetros
            $sql = "UPDATE tbl_produtos SET nome_produto = ?, descricao_produto = ?, preco_produto = ?, porcentagem_desconto = ?, id_sub_categoria = ? WHERE codigo = ?";

            // Criando o statement utilizando um prepare da conexao (atributo dessa classe) passando o sql criado
            $statement = $this->conexao->prepare($sql);

            // Criando os dados que serão passados para o statement por meio desse Array
            $statement_dados = array(
                $produto->getNome(),
                $produto->getDescricao(),
                $produto->getPreco(),
                $produto->getDesconto(),
                $produto->getIdSubCategoria(),
                $produto->getCodigo()

            );
        } else {
            // Criando a variavel sql com statements como parâmetros
            $sql = "UPDATE tbl_produtos SET nome_produto = ?, descricao_produto = ?, preco_produto = ?, porcentagem_desconto = ?, img_produto = ?, id_sub_categoria WHERE codigo = ?";

            // Criando o statement utilizando um prepare da conexao (atributo dessa classe) passando o sql criado
            $statement = $this->conexao->prepare($sql);

            // Criando os dados que serão passados para o statement por meio desse Array
            $statement_dados = array(
                $produto->getNome(),
                $produto->getDescricao(),
                $produto->getPreco(),
                $produto->getDesconto(),
                $produto->getImagem(),
                $produto->getIdSubCategoria(),
                $produto->getCodigo()

            );
        }


        if ($statement->execute($statement_dados)) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProdutoMes($codigo, $status)
    {

        if ($status == 0) {
            $sql = "UPDATE tbl_produtos SET produto_mes = 0";
            if ($this->conexao->query($sql)) {
                $sql = "UPDATE tbl_produtos SET produto_mes = 1 WHERE codigo =" . $codigo;
                if ($this->conexao->query($sql)) {
                    return true;
                } else {
                    return false;
                }
            }
        }else{
            $sql = "UPDATE tbl_produtos SET produto_mes = 0 WHERE codigo =".$codigo;
            if ($this->conexao->query($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function editProdutoMes(Produto $produto){
        $sql = "UPDATE tbl_produtos SET preco_produto = ?, descricao_produto = ? WHERE codigo = ?";
        $statement = $this->conexao->prepare($sql);

        $statement_dados = array(
            $produto->getPreco(),
            $produto->getDescricao(),
            $produto->getCodigo()
        );

        if($statement->execute($statement_dados)){
            return true;
        }else{
            echo($produto->getPreco());
        }
    }

    public function editPromocao(Produto $produto){
        $sql = "UPDATE tbl_produtos SET preco_produto = ?, porcentagem_desconto = ? WHERE codigo = ?";

        $statement = $this->conexao->prepare($sql);
        $statement_dados = array(
            $produto->getPreco(),
            $produto->getDesconto(),
            $produto->getCodigo()
        );

        if($statement->execute($statement_dados)){
            return true;
        }else{
            return false;
        }
    }

    public function changeStatusPromocao($codigo, $status){
        if($status == 1){
            $statusAlterado = 0;
        }else{
            $statusAlterado = 1;
        }

        $sql = "UPDATE tbl_produtos SET promocao =".$statusAlterado." WHERE codigo =". $codigo;

        if($this->conexao->query($sql)){
            return true;
        }else{
            return false;
        }
    }

    public function changeStatusProduto($codigo, $status)
    {
        if ($status == 1) {
            $statusAlterado = 0;
        } else {
            $statusAlterado = 1;
        }

        $sql = "UPDATE tbl_produtos SET status =" . $statusAlterado . " WHERE codigo =" . $codigo;
        if ($this->conexao->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function uploadImagem($file)
    {
        // Variáveis para o upload de arquivos
        // Isso pode ser usado de uma maneira mais semântica como uma constante
        $diretorio = (string) 'model/arquivos/';
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
}

?>