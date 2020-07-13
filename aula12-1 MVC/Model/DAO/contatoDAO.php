<?php 
    ########################## LEMBRETE #########################################
    # Nome da classe :' ContatoDAO                                              #
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

    class ContatoDAO{

        # metodo construtor da classe
        public function __construct(){

        }

        # metodo de insert na pagina de contato
        public function insertContato(Contato $contato){
            $sql = "insert into tblContatos (nome, endereco, cep, bairro, telefone, celular, 
                            email, dtNascimento, obs, sexo, idEstado) 
                            values ( '".$contato->getNome()."', 
                            '".$contato->getEndereco()."', 
                            '".$contato->getCep()."', 
                            '".$contato->getBairro()."', 
                            '".$contato->getTelefone()."', 
                            '".$contato->getCelular()."', 
                            '".$contato->getEmail()."', 
                            '".$contato->getDataNascimento()."', 
                            '".$contato->getObs()."', 
                            '".$contato->getSexo()."', 
                            ".$contato->getIdEstado().")";
        }

        # metodo update na pagina de contato
        public function updateContato(){

        }

        # metodo para deletar um contato
        public function deletContato(){

        }

        public function selectAllContato(){

        }
        public function selectByIdContato(){
            
        }
        
    }


?>