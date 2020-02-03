<!--
    Classe de manipulação do banco para a Classe de categorias
    Autor: Davi Soares da Silva
    Data de Criação: 12/12/2019
    Data de Modificação:
    Modificações realizadas: 
-->

<?php

class CategoriaDAO
{
    private $conexao;
    private $conexaoMysql;

    public function __construct()
    {
        // Importando o arquivo de conexão com o BD
        require_once('conexaoMysql.php');

        //Instanciando e abrindo a conexão com o BD
        $this->conexaoMysql = new conexaoMysql();
        $this->conexao = $this->conexaoMysql->connectDatabase();
    }

    // função para inserir uma categoria no banco
    public function insertCategoria(Categoria $categoria)
    {
        $sql = "INSERT INTO tbl_categorias (nome, status) VALUES (?, 1)";

        $statement = $this->conexao->prepare($sql);
        $statement_dados = array($categoria->getNome());

        if ($statement->execute($statement_dados)) {
            return true;
        } else {
            return false;
        }
    }

    // função para deletar uma categoria
    public function deleteCategoria($codigo)
    {
        $sql = "DELETE FROM tbl_categorias WHERE id=" . $codigo;

        if ($this->conexao->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    // função para listar todas as categorias cadastradas
    public function selectAllCategoria()
    {
        $sql = "SELECT * FROM tbl_categorias";
        $select = $this->conexao->query($sql);

        $cont = 0;

        while ($rs = $select->fetch(PDO::FETCH_ASSOC)) {
            // Criando uma collection para armazenar todos as categorias
            $categorias[] = new Categoria();

            $categorias[$cont]->setId($rs['id']);
            $categorias[$cont]->setNome($rs['nome']);
            $categorias[$cont]->setStatus($rs['status']);

            $cont++;
        }

        return $categorias;
    }

    // função para buscar apenas uma categoria
    public function selectCategoriaById($codigo)
    {
        $sql = "SELECT * FROM tbl_categorias WHERE id=" . $codigo;
        $select = $this->conexao->query($sql);

        if ($rs = $select->fetch(PDO::FETCH_ASSOC)) {
            $categoria = new Categoria();

            $categoria->setId($rs['id']);
            $categoria->setNome($rs['nome']);
            $categoria->setStatus($rs['status']);

            return $categoria;
        }
    }

    // função para editar uma categoria
    public function updateCategoria(Categoria $categoria)
    {
        $sql = "UPDATE tbl_categorias SET nome = ? WHERE id = ?";

        $statement = $this->conexao->prepare($sql);
        $statement_dados = array($categoria->getNome(), $categoria->getId());

        if ($statement->execute($statement_dados)) {
            return true;
        } else {
            return false;
        }
    }

    // Função para mudar o status de uma categoria
    public function changeStatusCategoria($codigo, $status)
    {
        if ($status == 0) {
            $sql = "UPDATE tbl_categorias SET status = 1 WHERE id = " . $codigo;
        } else {
            $sql = "UPDATE tbl_categorias SET status = 0 WHERE id = " . $codigo;
        }

        if ($this->conexao->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

}

?>