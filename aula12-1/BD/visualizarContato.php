<?php 
    if(isset($_POST['modo'])){
        if($_POST['modo'] == 'visualizar'){
            if (isset($_POST['id'])){

                 # inserindo o arquivo de conexao que esta dentro da pasta BD (referente ao banco de dados);
                include_once('conexao.php');
                
                # recebe a funcao de conexao do bd
                $conex = conexaoMysql();

                $id = $_POST['id'];
                $sql = "select tblContatos.*, tblEstados.nome as nomeEstado, tblEstados.sigla 
                from tblContatos, tblEstados 
                where tblEstados.idEstado = tblContatos.idEstado
                and tblContatos.idContato = ".$id;

                $selectContato = mysqli_query($conex, $sql);

                // echo($sql); exit;

                if($rsContatos = mysqli_fetch_assoc($selectContato)){
                    
                    $nome = $rsContatos['nome'];
                    $endereco = $rsContatos['endereco'];
                    $bairro  =  $rsContatos['bairro'];
                    $cep = $rsContatos['cep']; 
                    $estado =  $rsContatos['nomeEstado']. "-" . $rsContatos['sigla'] ;
                    $telefone = $rsContatos['telefone'];
                    $celular = $rsContatos['celular'];
                    $email = $rsContatos['email'];
                    $dtNascimento = explode("-", $rsContatos['dtNascimento']);
                    $dataNascimento = $dtNascimento[2]."/".$dtNascimento[1]."/".$dtNascimento[0];
                    $sexo = $rsContatos['sexo'];
                    $obs = $rsContatos['obs'] ;

                   
                }
            }
        }
    }

?>
<html>
    <head>
        <title> Visualizar Contatos</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script src="scripts/jquery.js"></script>
        <script>
             $(document).ready(function(){
               $('#fechar').click(function(){
                    $('#modal').fadeOut(1000);
               });
               

            });
        </script>
    </head>
    <body>
       <div id="visualizar">
           <a href="#" id="fechar">
               fechar
           </a>
             <table>
                 <tr class="titulo">
                     <td colspan="2"> Contatos </td>
                 </tr>
                <tr>
                    <td>
                        Nome:
                    </td>
                    <td><?=$nome?></td>
                </tr>
                <tr>
                    <td>
                        Endereço:
                    </td>
                    <td><?=$endereco?></td>
                </tr>
                <tr>
                    <td>
                        CEP:
                    </td>
                    <td><?=$cep?></td>
                </tr>
                <tr>
                    <td>
                        Bairro:
                    </td>
                    <td><?=$bairro?></td>
                </tr>
                <tr> 
                    <td> 
                        Estado:
                    </td>
                    <td><?=$estado?></td>
                </tr>
                <tr>
                    <td>
                        Telefone:
                    </td>
                    <td><?=$telefone?></td>
                </tr>
                <tr>
                    <td>
                        Celular:
                    </td>
                    <td><?=$celular?></td>
                </tr>
                <tr>
                    <td> 
                        Email:
                    </td>
                    <td><?=$email?></td>
                </tr>
                <tr>
                    <td> Data Nascimento: </td>
                    <td><?=$dataNascimento?></td>
                </tr>
                <tr>
                    <td>
                        Sexo:
                    </td>
                    <td><?=$sexo?></td>
                </tr>
                <tr>
                    <td>
                        Obs: 
                    </td>
                    <td><?=$obs?></td>
                </tr>
            </table>
       </div>
    </body>
</html>