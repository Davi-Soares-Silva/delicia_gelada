<!--
    Classe de manipulação do banco para a Classe de categorias
    Autor: Davi Soares da Silva
    Data de Criação: 12/12/2019
    Data de Modificação:
    Modificações realizadas: 
-->

<?php

class SubCategoriaDAO
{
    private $conexao;
    private $conexaoMysql;


    public function __construct()
    {

        // Fazendo o import da classe de conexão com o BD
        require_once('conexaoMysql.php');

        $this->conexaoMysql = new conexaoMysql();
        $this->conexao = $this->conexaoMysql->connectDatabase();
    }

    // Método para inserir uma subcategoria
    public function insertSubCategoria(SubCategoria $subCategoria)
    {
        $sql = "INSERT INTO tbl_sub_categorias (nome_sub_categoria, id_categoria, status_sub_categoria) VALUES (?, ?,1)";

        $statement = $this->conexao->prepare($sql);;
        $statement_dados = array(
            $subCategoria->getNome(),
            $subCategoria->getIdCategoria()
        );

        if ($statement->execute($statement_dados)) {
            return true;
        } else {
            echo($subCategoria->getNome().', '. $subCategoria->getIdCategoria());
        }
    }

    // Método para deletar uma subcategoria
    public function deleteSubCategoria($codigo)
    {
        $sql = "DELETE FROM tbl_sub_categorias WHERE id_sub_categoria =" . $codigo;

        if ($this->conexao->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    // Método para buscar todas as sub_categorias
    public function selectAllSubCategorias()
    {
        $sql = "SELECT * FROM tbl_sub_categorias INNER JOIN tbl_categorias ON tbl_sub_categorias.id_categoria = tbl_categorias.id;";
        $select  = $this->conexao->query($sql);

        $cont = 0;

        while ($rs = $select->fetch(PDO::FETCH_ASSOC)) {

            $subCategorias[] = new SubCategoria();

            $subCategorias[$cont]->setId($rs['id_sub_categoria']);
            $subCategorias[$cont]->setNome($rs['nome_sub_categoria']);
            $subCategorias[$cont]->setIdCategoria($rs['id_categoria']);
            $subCategorias[$cont]->setStatus($rs['status_sub_categoria']);
            $subCategorias[$cont]->setCategoria($rs['nome']);

            $cont++;
        }

        return $subCategorias;
    }

    //Método para selecionar uma sub_categoria específica por seu ID
    public function selectSubCategotiaById($codigo)
    {
        $sql = "SELECT * FROM tbl_sub_categorias WHERE id_sub_categoria=" . $codigo;
        $select = $this->conexao->query($sql);

        if ($rs = $select->fetch(PDO::FETCH_ASSOC)) {
            $subCategoria = new SubCategoria();

            $subCategoria->setId($rs['id_sub_categoria']);
            $subCategoria->setNome($rs['nome_sub_categoria']);
            $subCategoria->setIdCategoria($rs['id_categoria']);
            $subCategoria->setStatus($rs['status_sub_categoria']);

            return $subCategoria;
        }
    }

    // Método para atualizar uma SubCategoria
    public function updateCategoria(SubCategoria $subCategoria)
    {
        $sql = "UPDATE tbl_sub_categorias SET nome_sub_categoria = ?, id_categoria = ? WHERE id_sub_categoria = ?";

        $statement = $this->conexao->prepare($sql);

        $statement_dados = array(
            $subCategoria->getNome(),
            $subCategoria->getIdCategoria(),
            $subCategoria->getId()
        );

        if ($statement->execute($statement_dados)) {
            return true;
        } else {
            return false;
        }
    }

    // Método para mudar o status de uma subCategoria
    public function changeStatusSubCategoria($codigo, $status)
    {
        if ($status == 1) {
            $sql = "UPDATE tbl_sub_categorias SET status_sub_categoria = 0 WHERE id_sub_categoria =" . $codigo;
        } else {
            $sql = "UPDATE tbl_sub_categorias SET status_sub_categoria = 1 WHERE id_sub_categoria =" . $codigo;
        }

        if ($this->conexao->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    // public function selectAllSubCategoriasAndCategorias(){
    //     $sql = "SELECT * FROM tbl_sub_categorias INNER JOIN tbl_categorias ON tbl_sub_categorias.id_categoria = tbl_categorias.id";
    //     $select = $this->conexao->prepare($sql);
        
    //     $cont = 0;
    //     while($rs = $select->fetch(PDO::FETCH_ASSOC)){
    //         $subCategorias[] = new SubCategoria;

    //         $subCategorias[$cont]->setId($rs['id_sub_categoria']);
    //     }

    // }
}

?>