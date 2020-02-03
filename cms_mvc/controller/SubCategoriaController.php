<!-- 
    Classe Controller de Produtos
    Autor: Davi Soares da Silva
    Data de Criação: 12/12/2019
    Data de Modificação:
    Modificações realizadas:

-->

<?php

class SubCategoriaController
{
    private $subCategoria;
    private $subCategoriaDAO;

    public function __construct()
    {
        // Importando as classes SubCategoriaDAO e SubCategoria
        require_once('model/subCategoriaClass.php');
        require_once('model/DAO/subCategoriaDAO.php');

        $this->subCategoria = new SubCategoria();
        $this->subCategoriaDAO = new SubCategoriaDAO();

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $this->subCategoria->setNome($_POST['txtNome']);
            $this->subCategoria->setIdCategoria($_POST['slcCategoria']);
        }
    }

    // método para inserir uma subcategoria
    public function inserirSubCategoria()
    {
        if ($this->subCategoriaDAO->insertSubCategoria($this->subCategoria)) {
            header("location: index.php?page=sub_categorias");
        } else {
            echo ("<script>alert('Poxa vida, não foi dessa vez.')</script>");
        }
    }

    // Método para deletar uma subCategoria
    public function deletarSubCategoria($codigo)
    {
        if ($this->subCategoriaDAO->deleteSubCategoria($codigo)) {
            header("location: index.php?page=sub_categorias");
        } else {
            echo ("<script>alert('Não foi possível excluir, subcategoria em uso!')</script>");
            header("location: index.php?page=sub_categorias");
        }
    }

    // Método para buscar todas as subcategorias cadastradas no BD
    public function listarTodas()
    {
        return $this->subCategoriaDAO->selectAllSubCategorias();
    }

    // Método para buscar uma subCategoria específica por seu ID
    public function buscarSubCategoriaPorId($codigo)
    {
        $dadosSubCategoria = $this->subCategoriaDAO->selectSubCategotiaById($codigo);
        session_start();
        $_SESSION['page'] = "sub_categorias";
        require_once('index.php');
    }

    // Método para atualizar uma SubCategoria
    public function atualizarSubCategoria($codigo)
    {
        $this->subCategoria->setId($codigo);
        if ($this->subCategoriaDAO->updateCategoria($this->subCategoria)) {
            header("location: index.php?page=sub_categorias");
        } else {
            echo ("<script>alert('Poxa vida, não foi dessa vez.')</script>");
        }
    }

    // Método para ativar ou desativar uma subCategoria de acordo com seu status
    public function alterarStatus($codigo, $status)
    {
        if ($this->subCategoriaDAO->changeStatusSubCategoria($codigo, $status)) {
            header("location: index.php?page=sub_categorias");
        } else {
            echo ("<script>alert('Poxa vida, não foi dessa vez.')</script>");
        }
    }
}


?>