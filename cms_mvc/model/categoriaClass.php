<!-- 
    Classe da modelagem dos Categorias
    Autor: Davi Soares da Silva
    Data de Criação: 12/12/2019
    Data de Modificação:
    Modificações realizadas:

-->

<?php

    class Categoria{
        private $id;
        private $nome;
        private $status;

        public function __construct()
        {
            
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

    }

?>
