<!-- 
    Classe Controller de Produtos
    Autor: Davi Soares da Silva
    Data de Criação: 09/12/2019
    Data de Modificação:
    Modificações realizadas:

-->

<?php

class ProdutoController
{
    private $produto;
    private $produtoDAO;


    public function __construct()
    {
        // Importe das classes de produto e produtoDAO
        // require_once("../model/DAO/produtoDAO.php");
        // require_once("../model/produtoClass.php");

        require_once(__DIR__ . '/../model/DAO/produtoDAO.php');
        require_once(__DIR__ . '/../model/produtoClass.php');


        $this->produtoDAO = new ProdutoDAO();
        $this->produto = new Produto();
        $file = (String) null;

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            

            // Enviando para os atributos da classe o post do form
            if(isset($_POST['txtNome'])){
                $this->produto->setNome($_POST['txtNome']);
            }
            if(isset($_POST['txtDescricao'])){
                $this->produto->setDescricao($_POST['txtDescricao']);
            }
            if(isset($_POST['txtPreco'])){
                $this->produto->setPreco($_POST['txtPreco']);
            }
            if(isset($_POST['txtDesconto'])){
                $this->produto->setDesconto($_POST['txtDesconto']);
            }
            if(isset($_POST['slcCategoria'])){
                $this->produto->setIdSubCategoria($_POST['slcCategoria']);
            }
            
            
            if(isset($_FILES['fileFoto'])){
               $imagem = $this->produtoDAO->uploadImagem($_FILES['fileFoto']);
               if($imagem != null){
                   $this->produto->setImagem($imagem);
               }else{
                   $this->produto->setImagem(null);
               }
            }
        }


        
    }

    // Método para inserir um novo produto
    public function novoProduto()
    {
        if ($this->produtoDAO->insertProduto($this->produto)) {
            header("location: index.php?page=produtos");
        } else {
            echo ("<script>alert('Olá meu, caro. Infelizmente ocorreu um erro em seu código.')</script>");
        }
    }

    // Método para deletar um produto
    public function deletarProduto($codigo, $imagem)
    {
        if ($this->produtoDAO->deleteProduto($codigo)) {
            unlink('model/arquivos/'.$imagem);
            header("location: index.php?page=produtos");
        } else {
            echo ("<script>('Olá meu, caro. Infelizmente ocorreu um erro em seu código.')</script>");
        }
    }

    // Método para buscar todos os produtos
    public function listarProdutos()
    {
        return $this->produtoDAO->selectAllProduto();
    }

    // Método para buscar um produto específico pelo seu ID
    public function buscarPorId($codigo)
    {
        $produtoDados = $this->produtoDAO->selectProdutoById($codigo);
        session_start();
        $_SESSION['page'] = 'produtos';
        require_once('index.php');
    }

    public function atualizarProduto($codigo){
        $this->produto->setCodigo($codigo);

        if($this->produtoDAO->updateProduto($this->produto)){
            header("location: index.php?page=produtos");
        }else{
            echo("<script>alert('Bora fi, ajeita isso aí!')</script>");
        }
    }

    // Método para desativar e ativar o produto
    public function alterarStatus($codigo, $status)
    {

        if ($this->produtoDAO->changeStatusProduto($codigo, $status)) {
            header("location: index.php?page=produtos");
        } else {
            echo ("<script>alert('Olá meu, caro. Infelizmente ocorreu um erro em seu código.')</script>");
        }
    }

    // Método para definir um produto do mês
    public function definirProdutoMes($codigo, $status){
        if($this->produtoDAO->updateProdutoMes($codigo, $status)){
            header("location: index.php?page=produto_mes");
        }else{
            echo('ah não, cara!');
        }
    }

    // Método para buscar o produto do mês
    public function buscarProdutoMes($codigo){
        $produtoDados = $this->produtoDAO->selectProdutoById($codigo);
        session_start();
        $_SESSION['page'] = 'produto_mes';
        require_once('index.php');
    }

    // Método para editar o produto do mês
    public function editarProdutoMes($codigo){
        $this->produto->setCodigo($codigo);
        if($this->produtoDAO->editProdutoMes($this->produto)){
            header("location: index.php?page=produto_mes");
        }else{
            echo('ah não, cara!');
        }
    }

    // Método para editar uma promoção
    public function editarPromocao($codigo){
        $this->produto->setCodigo($codigo);
        if($this->produtoDAO->editPromocao($this->produto)){
            header("location: index.php?page=promocoes");
        }else{
            echo('ah não, cara!');
        }
    }

    // Método para buscar uma promoção
    public function buscarPromocao($codigo){
        $produtoDados = $this->produtoDAO->selectProdutoById($codigo);
        session_start();
        $_SESSION['page'] = 'promocoes';
        require_once('index.php');
    }

    // Método para ativar e desativar uma promoção
    public function statusPromocao($codigo, $status){
        if($this->produtoDAO->changeStatusPromocao($codigo, $status)){
            header("location: index.php?page=promocoes");
        }else{
            echo('ah não, cara!');
        }
    }
}

?>