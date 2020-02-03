<!-- 
    Classe da modelagem dos sub_categorias
    Autor: Davi Soares da Silva
    Data de Criação: 12/12/2019
    Data de Modificação:
    Modificações realizadas:

-->

<?php

class SubCategoria{
    private $id;
    private $nome;
    private $idCategoria;
    private $status;
    private $categoria;
    

    public function __construct(){
        
    }

    public function getId(){
        return $this->id;
    }

    public function setId($codigo){
        $this->id = $codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getIdCategoria(){
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria){
        $this->idCategoria = $idCategoria;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
}
    

?>