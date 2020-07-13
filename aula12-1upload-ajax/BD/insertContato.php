<?php
    # veridica se a variavel modo exite 



if (isset($_GET['modo'])) {

        # verifica que o conteudo do modo é inserir
    if ($_GET['modo'] == 'inserir') {

        # CONEXAO COM O BANCO DE DADOS
        require_once('conexao.php');

        # recebe a funcao de conexao do bd
        $conex = conexaoMysql();


        #VERIFICANDO SE O BOTAO FOI SUBMETIDO
        if (isset($_POST['btnEnviar'])) {


        
        # RECEBENDO OS DADOS FORNECIDOS PELO USUARIO
            $nome = $_POST['txtNome'];
            $endereco = $_POST['txtEndereco'];
            $cep = $_POST['txtCep'];
            $bairro = $_POST['txtBairro'];
            $telefone = $_POST['txtTelefone'];
            $celular = $_POST['txtCelular'];
            $email = $_POST['txtEmail'];
        
            #CONVERSAO DA DATA PARA O PADRAO AMERICANO PARA ENVIAR AO BANCO
            $dataNascimento = explode("/", $_POST['txtNascimento']);
            $dtNascimentoAmericano = $dataNascimento[2]."-".$dataNascimento[1]."-".$dataNascimento[0];
        
            $observacao = $_POST['txtObs'];
            $sexo = $_POST['rdoSexo'];
            $idEstado = $_POST['sltEstados'];

            #ativa o uso da variavel de sessao e resgata o dado na variavel foto que vem do upload.php
            session_start();
            $foto = $_SESSION['nomeFoto'];

            $sql = "insert into tblContatos (nome, endereco, cep, bairro, telefone, celular, 
                            email, dtNascimento, obs, sexo, idEstado, imagem) 
                            values ( '".$nome."', '".$endereco."', '".$cep."', '".$bairro."', '".$telefone."', 
                            '".$celular."', '".$email."', '".$dtNascimentoAmericano."', '".$observacao."', '".$sexo."', ".$idEstado.", '".$foto."' )";
                    
                           # echo($sql); exit;
                
                    
                            # EXECUTANDO O INSERT NO BANCO DE DADOS
                            if (mysqli_query($conex, $sql)) {
                                echo("
                            <script> 
                                alert('registro inserido com sucesso'); 
                                location.href = '../index.php';
                            </script>");
                            } else {
                                echo("<script> 
                                alert('erro ao salvar '); 
                                location.href = '../index.php';
                                window.history.back();
                            </script>");
                            }
        }
    }
}


    # window.history.back() permite voltar a pagina anterior sem perder os dados do formulario
?>