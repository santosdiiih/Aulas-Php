<?php 
    ########################## LEMBRETE #########################################
    # Nome da classe :' Contato()                                               #
    # Objetivo : Manipular dados com o BD MSQL referente a contatos             #
    # Data da criaçao: 06/07/2020                                               #
    # Autor: Ingrid Aparecida Pereira dos Santos 
    #
    # Data da modificação : 
    # Autor da modificação :
    # Conteudos Modificados : 
    #
    #
    #############################################################################

    # atibutos da classe 
    class Contato{
        private $idContato;
        private $nome;
        private $endereco;   
        private $bairro;   
        private $cep;   
        private $idEstado;   
        private $telefone;   
        private $celular;   
        private $email;   
        private $dataNascimento;   
        private $obs; 
        private $sexo;
        

        public function __construct() {
            
        }
        #get IdContato 
        public function getIdContato(){
            return $this->idContato;
        }
        #set Id Contatos
        public function setIdContato($idContato){
            return $this->idContato = $idContato; 
        }

        #get IdContato 
        public function getNome(){
            return $this->nome;
        }
        #set Id Contatos
        public function setNome($nome){
            return $this->nome = $nome; 
        }

        #get IdContato 
        public function getEndereco(){
            return $this->endereco;
        }
        #set Id Contatos
        public function setEndereco($endereco){
            return $this->endereco = $endereco; 
        }

        #get IdContato 
        public function getBairro(){
            return $this->bairro;
        }
        #set Id Contatos
        public function setBairro($bairro){
            return $this->bairro = $bairro; 
        }

        #get IdContato 
        public function getCep(){
            return $this->cep;
        }
        #set Id Contatos
        public function setCep($cep){
            return $this->cep = $cep; 
        }

        #get IdContato 
        public function getIdEstado(){
            return $this->idEstado;
        }
        #set idEstado
        public function setIdEstado($idEstado){
            return $this->idEstado = $idEstado; 
        }

       #get telefone
         public function getTelefone(){
            return $this->telefone;
        }
        #set telefone
        public function setTelefone($telefone){
            return $this->telefone = $telefone; 
        }

        #get celular 
        public function getCelular(){
            return $this->celular;
        }
        #set celular
        public function setCelular($celular){
            return $this->celular = $celular; 
        }

        #get email 
        public function getEmail(){
            return $this->email;
        }
        #set email
        public function setEmail($email){
            return $this->email = $email; 
        }

        #get dataNascimento 
        public function getDataNascimento(){
            return $this->dataNascimento;
        }
        #set dataNascimento
        public function setDataNascimento($dataNascimento){
            return $this->dataNascimento = $dataNascimento; 
        }

        #get obs 
        public function getObs(){
            return $this->obs;
        }
        #set obs
        public function setObs($obs){
            return $this->obs = $obs; 
        }
        
         #get obs 
         public function getSexo(){
            return $this->obs;
        }
        #set obs
        public function setSexo($sexo){
            return $this->sexo = $sexo; 
        }
    }

?>
