<!-- 
    Classe da modelagem dos Produtos
    Autor: Davi Soares da Silva
    Data de Criação: 09/12/2019
    Data de Modificação:
    Modificações realizadas:

-->

<?php

    class Produto{

        private $codigo;
        private $nome;
        private $descricao;
        private $preco;
        private $porcentagem_desconto;
        private $imagem_produto;
        private $status;
        private $promocao;
        private $produto_mes;
        private $idSubCategoria;


        public function __construct()
        {
            
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function setCodigo($codigo){
            $this->codigo = $codigo;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function getPreco(){
            return $this->preco;
        }

        public function setPreco($preco){
            $this->preco = $preco;
        }

        public function getDesconto(){
            return $this->porcentagem_desconto;
        }

        public function setDesconto($valor_desconto){
            $this->porcentagem_desconto = $valor_desconto;
        }

        public function getImagem(){
            return $this->imagem_produto;
        }

        public function setImagem($imagem){
            $this->imagem_produto = $imagem;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getPromocao(){
            return $this->promocao;
        }

        public function setPromocao($promocao){
            $this->promocao = $promocao;

        }
        
        public function getProdutoMes(){
            return $this->produto_mes;
        }

        public function setProdutoMes($produto_mes){
            $this->produto_mes = $produto_mes;
        }

        public function getIdSubCategoria(){
            return $this->idSubCategoria;
        }

        public function setIdSubCategoria($idSubCategoria){
            $this->idSubCategoria = $idSubCategoria;
        }

    }


?>