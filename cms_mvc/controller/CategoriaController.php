<!-- 
    Classe Controller de Produtos
    Autor: Davi Soares da Silva
    Data de Criação: 12/12/2019
    Data de Modificação:
    Modificações realizadas:

-->

<?php

class CategoriaController
{
    private $categoria;
    private $categoriaDAO;

    public function __construct()
    {
        // Fazendo os imports das classes de Categoria e CategoriaDAO
        require_once('model/categoriaClass.php');
        require_once('model/DAO/categoriaDAO.php');

        $this->categoriaDAO = new CategoriaDAO();
        $this->categoria = new Categoria();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->categoria->setNome($_POST['txtNome']);
        }
    }

    // Método para inserir uma nova categoria
    public function inserirCategoria()
    {
        if ($this->categoriaDAO->insertCategoria($this->categoria)) {
            header('location: index.php?page=categorias');
        } else {
            echo ("<script>alert('Que decepção, tente de novo!')</script>");
        }
    }

    // Método para buscar todas as categorias cadastradas no BD
    public function listarTodas()
    {
        return $this->categoriaDAO->selectAllCategoria();
    }

    // Método para deletar categorias
    public function deletarCategoria($codigo)
    {
        if ($this->categoriaDAO->deleteCategoria($codigo)) {
            header('location: index.php?page=categorias');
        } else {
            echo ("<script>alert('Que decepção, tente de novo!')</script>");
        }
    }

    // Método para buscar Categorias pelo id
    public function buscarPorId($codigo)
    {
        $categoriaDados = $this->categoriaDAO->selectCategoriaById($codigo);
        session_start();
        $_SESSION['page'] = "categorias";
        require_once('index.php');
    }

    // Método para atualizar uma categoria
    public function atualizarCategoria($codigo)
    {
        $this->categoria->setId($codigo);
        if ($this->categoriaDAO->updateCategoria($this->categoria)) {
            header('location: index.php?page=categorias');
        } else {
            echo ("<script>alert('Que decepção, tente de novo!')</script>");
        }
    }

    // Método para ativar ou desativar uma categoria
    public function alterarStatus($codigo, $status)
    {
        if ($this->categoriaDAO->changeStatusCategoria($codigo, $status)) {
            header('location: index.php?page=categorias');
        } else {
            echo ("<script>alert('Que decepção, tente de novo!')</script>");
        }
    }
}

?>