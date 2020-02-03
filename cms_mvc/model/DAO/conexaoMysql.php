<!-- 
    Classe de conexão com o banco de dados Mysql
    Autor: Davi Soares da Silva
    Data de Criação: 03/12/2019
    Data de Modificação:
    Modificações realizadas:


    Dessa vez utilizamos um nome de arquivo mais significativo
    pois poderiam haver mais tipos de conexão
-->

<?php

class conexaoMysql{
     // Declarando os atributos de classe para a conexão
     private $server;
     private $user;
     private $password;
     private $database;

    //  Construtor da nossa classe de conexão
     public function __construct(){
        
        $this->server = "localhost";
        $this->user = "root";
        $this->password = "bcd127";
        $this->database = "delicia_gelada";

     }


    //  Função que será utilizada para fazer a conexão com o database
     public function connectDatabase(){

        try{
            $conexao = new PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->user, $this->password);

            return $conexao;
        }

        catch(PDOException $erro){
            // Exibindo uma mensagem de erro caso a conexão com o banco falhe, informando a linha e as mensagens retornadas
            echo("Erro de conexão com o Banco de dados <br> Linha do Erro: ". $erro->getLine()." Mensagem do erro: ". $erro->getMessage());
        }
     }



}
   
    


?>