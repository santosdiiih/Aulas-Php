<?php
    # veridica se a variavel modo exite 

use function PHPSTORM_META\type;

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



                # SCRIPT QUE RESGATA UMA IMAGEM ENVIADA PELO FORM 
                # valida se o campo da imagem é um arquivo valido e esta com as propriedades corretas
                if($_FILES['fleFoto'] > 0 && $_FILES['fleFoto']['type'] != "" ){
                    
                    # nome da pasta para os arquivos upados 
                    $diretorioArquivo = "arquivos/";
                    
                    
                    # variavel que possui o tamanho da imagem convertendo o tamanho para KB
                    $arquivoSize = round($_FILES['fleFoto']['size']/1024);

                    #extensôes que serao permitidas no arquivo de imagem
                    $arquivoPermitido = array("image/jpeg", "image/jpg", "image/png", "image/gif");

                    # guardando o tipo de arquivo 
                    $arquivoType = $_FILES['fleFoto']['type'];

                    # variavel que possui a imagem 
                    $arquivo = $_FILES['fleFoto'];

                    # valida se a extensao do arquivo é permitida no upload
                    if(in_array($arquivoType, $arquivoPermitido)){
                        # valida o tamanho do arquivo
                        if($arquivoSize <= 2000){

                            #resgata o nome do arquivo e separa ele da  extensao 
                            $nomeArquivo = pathinfo($_FILES['fleFoto']['name'], PATHINFO_FILENAME);
                            # resgatando a extensao do nome do arquivo 
                            $extensaoArquivo = pathinfo($_FILES['fleFoto']['name'], PATHINFO_EXTENSION);

                            # gerando um nome de arquivo unico para que não ocorra substituicao de imagem sem intençao 
                            $nomeArquivocrypt = md5($nomeArquivo) . uniqid(time());

                            # concatenando o nome e a extensão da imagem
                            $foto = $nomeArquivocrypt.".".$extensaoArquivo;

                            # pasta temporario que o form disponibiliza para o servidor para que o arquivo seja upado para o servidor
                            $arquivoTempo = $_FILES['fleFoto']['tmp_name'];

                            # move a imagem de uma pasta e coloca em outra
                            if(move_uploaded_file($arquivoTempo, $diretorioArquivo.$foto)){
                                
                                
                            # SCRIPTS PARA ENVIAR OS DADOS AO BD
                            $sql = "insert into tblContatos (nome, endereco, cep, bairro, telefone, celular, 
                            email, dtNascimento, obs, sexo, idEstado, imagem) 
                            values ( '".$nome."', '".$endereco."', '".$cep."', '".$bairro."', '".$telefone."', 
                            '".$celular."', '".$email."', '".$dtNascimentoAmericano."', '".$observacao."', '".$sexo."', ".$idEstado.", '".$foto."' )";
                    
                            #echo($sql); exit;
                
                    
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

                            }
                            else{
                                echo('erro ao mover o arquivo para o servidor');
                            }   

                        }
                        else{
                            echo('tamanho maior que 2MB!');
                        }
                    }
                    else {
                        echo('Extensao de arquivo não permitido pelo sistema');
                    }             
                }
                else {
                    echo('arquivo invalido na escolha da imagem');
                }


    # window.history.back() permite voltar a pagina anterior sem perder os dados do formulario
?>
