<?php 
 ########################## LEMBRETE #########################################
# Nome da classe :' ContatoController()                                          
# Objetivo : Criar toda a regra de negiocio para o sistema( ela inermedia 
# entre a view e a model )                        
# Data da criaçao: 13/07/2020                                              
# Autor: Ingrid Aparecida Pereira dos Santos 
#
# Data da modificação : 
# Autor da modificação :
# Conteudos Modificados : 
#
#
#############################################################################

class ContatoController{
    # construtor da classe
    public function __construct() {
        
    }
    # inserir um novo contato
    public function inserirContato(){
        # valida qual metodo de requisicao estara chegando no HTTP (POST, GET)
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            # resgatando os dados do formulario
            $nome = $_POST['txtNome'];
            $endereco = $_POST['txtEndereco'];
            $cep = $_POST['txtCep'];
            $bairro = $_POST['txtBairro'];
            $telefone = $_POST['txtTelefone'];
            $celular = $_POST['txtCelular'];
            $email = $_POST['txtEmail'];
            $dataNascimento = explode("/", $_POST['txtNascimento']);
            $dtNascimentoAmericano = $dataNascimento[2]."-".$dataNascimento[1]."-".$dataNascimento[0];
    
            $observacao = $_POST['txtObs'];
            $sexo = $_POST['rdoSexo'];
            # $idEstado = $_POST['sltEstados'];
            require_once('model/contatoClass.php');

            $contato = new Contato();
            $contato->setNome($nome);
            $contato->setEndereco($endereco);
            $contato->setCep($cep);
            $contato->setBairro($bairro);
            $contato->setTelefone($telefone);
            $contato->setCelular($celular);
            $contato->setEmail($email);
            $contato->setDataNascimento($dtNascimentoAmericano);
            $contato->setObs($observacao);
            $contato->setSexo($sexo);
            $contato->setIdContato(1);

            require_once('model/DAO/contatoDAO.php');

            $contatoDAO = new ContatoDAO;

            $contatoDAO->insertContato($contato);

    };
    }

    # atualizar um novo contato
    public function atualizarContato(){}

    # deletar um novo contato
    public function deletarContato(){}

    # listar um novo contato
    public function listarContato(){}

    # buscar um novo contato
    public function buscarContato(){}

    # lisa contato em JSON
    public function listarContatoJson(){}
}

?>