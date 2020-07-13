<?php 
    # VERIFICA SE A VARIAVEL MODO EXISTE 
    if(isset($_GET['modo'])){

        # VERIFICA SE O CONTEUDO DA VARIAVEL É PARA EXCLUIR 
        if($_GET['modo'] == 'excluir') {

            # inserindo o arquivo de conexao que esta dentro da pasta BD (referente ao banco de dados);
            include_once('conexao.php');
            
            # recebe a funcao de conexao do bd
            $conex = conexaoMysql();

            # VERIFICA SE O ID FOI ENVIADO PELO GET PARA CHAMAR O RESTANTE DO CODIGO
            if(isset($_GET['id'])){

                # RECEBENDO O ID 
                $id = $_GET['id'];

                

                # SCRIPT DELET A VARIAVEL ID RESGATA O ID DO CONTATO
                $sql = "delete from tblcontatos where idContato = " .$id;



                # MANDANDO AS INFORMAÇÕES PARA O BANCO
               if (mysqli_query($conex, $sql)){

                   # apaga um arquivo
                   unlink('arquivos/'.$_GET['imagem']);
                   
                   # REDIRECIONA PARA A PAGINA INICIAL QUANDO UM DADO FOR DELETADO
                   header('location:../index.php');
               }
            }
        }
    }

?>