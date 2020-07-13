<?php 
    ########################## LEMBRETE #########################################
    # Nome da classe :' mysqlConection                                          #
    # Objetivo : Criar conexao com banco de dados Mysql                         #
    # Data da criaçao: 06/07/2020                                               #
    # Autor: Ingrid Aparecida Pereira dos Santos 
    #
    # Data da modificação : 
    # Autor da modificação :
    # Conteudos Modificados : 
    #
    #
    #############################################################################

    # classe para conexao com banco mysql
    class mysqlConection {
        private $server;
        private $user;
        private $password;
        private $database;

        # metodo construtor php para instanciar os atributos da classe mae (acima)
        public function __construct(){
            $this->server = "localhost";
            $this->user = "root";
            $this->password = "bcd127";
            $this->database = "dbcontatos20201a";
        }

        # metodo para abrir a conexao com banco de dados 
        public function connectDatabase(){

            try{
                # estabelecendo a conexao com o banco
            $conexao = new PDO('mysql:host='.$this->server.';dbname='.$this->database,
            $this->user,$this->password);

            # retorna a conexao com banco
            return $conexao;

            }
            catch(PDOException $erro){
                echo('Erro ao abrir a conexao com banco De Dados
                <br> linha '.$erro->getLine().
                "<br> Mensagem de erro".$erro->getMessage());
            }
        }

        # encerra a conexao para que ela não fique aberta de forma desnecessaria 
        public function closeDatabase(){
            $conexao = null;
        }
    }
?>