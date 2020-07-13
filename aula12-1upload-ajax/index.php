<?php
    # inicializa a variavel para não possua erro 
    $idEstado = 0;

    # inserindo o arquivo de conexao que esta dentro da pasta BD (referente ao banco de dados);
    include_once('BD/conexao.php');
    
    # recebe a funcao de conexao do bd
    $conex = conexaoMysql();
    
    #verificando se a conexao foi estabelecida (esse metodo retorna inroformacoes da conexao)
    # var_dump($conex);
    
                    # inicializa as variaveis para não dar erro ao inicializar a tela com erro
                    $nome = null;
                    $endereco = null;
                    $cep = null;
                    $bairro = null;
                    $telefone = null;
                    $celular = null;
                    $email = null;
                    $dataNascimentoPadraoBR = null;
                    $observacao = null;
                    $sexo = null;
                    
                    # variavel para ser colocado no action do form 
                    $action = 'BD/insertContato.php?modo=inserir';


    # verifica se a variavel (ela foi enviada no click do editar, na listagem dos dados)
   if(isset($_GET['modo'])){
       # valida se a acao de modo é para buscar um registro no BD 
    //    $sql = "select * from tblContatos where idContato = ".$id
       if($_GET['modo'] == 'consultaEditar'){
            # verifica se foi clicado no (botao) de editar 
            if(isset($_GET['id'])){
                # recebe o id enviado pela url
                $id = $_GET['id'];
                # lista as informacoes do banco 
                $sql = "SELECT tblcontatos.*, tblcontatos.nome as nomeContato, 
                     tblcontatos.email, tblestados.sigla, 
                    tblestados.nome as nomeEstado  
                    FROM tblcontatos, tblestados
                    where tblestados.idEstado = tblcontatos.idEstado and tblContatos.idContato = ".$id;

                

                $selectDados = mysqli_query($conex, $sql);


                if($rsListContatos = mysqli_fetch_assoc($selectDados)){
                    $id = $rsListContatos['idContato'];
                    $nome = $rsListContatos['nome'];
                    $endereco = $rsListContatos['endereco'];
                    $cep = $rsListContatos['cep'];
                    $bairro = $rsListContatos['bairro'];
                    $telefone = $rsListContatos['telefone'];
                    $celular = $rsListContatos['celular'];
                    $email = $rsListContatos['email'];

                    $dataNascimento = explode("-", $rsListContatos['dtNascimento']);
                    $dataNascimentoPadraoBR = $dataNascimento[2]."/".$dataNascimento[1]."/".$dataNascimento[0]; 

                    $observacao = $rsListContatos['obs'];
                    $sexo = strtoupper( $rsListContatos['sexo']);
                    $idEstado = $rsListContatos['idEstado'];
                    $nomeEstado = $rsListContatos['nomeEstado'];

                    # acao que envia o form para a pagina update e enviamos o id para la tambem
                    $action = "BD/upDateContato.php?modo=atualizar&id=".$rsListContatos['idContato'];
                    
                }
            }

       }
   }


?>
<!DOCTYPE>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title> Cadastro </title>
        <link rel="stylesheet" type="text/css" href="style/style.css">
        <script src="scripts/jquery.js"></script>
        <script src="scripts/jquery.form.js"></script>

        <script>
            // ativa as funcoes js após o carregamento  do html
            $(document).ready(function(){
               $('.pesquisar').click(function(){
                    $('#modal').fadeIn(1000);
               });
               
                //    fucao para upload de arquivo, visualizar antes que ela seja enviada ao banco
                $('#foto').live('change', function(){
                    // alert('heebhb');
                      $('#frmfoto').ajaxForm({
                          target: '#imagem'
                      }).submit();

                });

            });
            

            // funcao que abre um arquivo dentro da modal 
            function visualizarContato(idContato){
                // biblioteca que permite trabalhar com formulario
                $.ajax({
                    // chamada via post 
                    type: "POST", 
                    // chama a pagina que foi criada os elementos da modal
                    url: "BD/visualizarContato.php",
                    // variaveis que servirao enviadas a outra tela
                    data: {modo: "visualizar", id: idContato},
                    // se o resultado for de sucesso cria uma funcao que serve para retorno 
                    success: function (dados){
                        // implementa a funcao no html
                        $('#modalConteudo').html(dados);
                    }
                });

                
            }
        </script>
    </head>
    <body>
        <div id="modal" >
            <div id="modalConteudo"></div>
        </div>
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
            </div>
            <div id="cadastroInformacoes">

            
            
                <form action="<?=$action?>" name="frmCadastro" method="post" enctype="multipart/form-data">
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Nome: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="<?=$nome?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Cep: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCep" value="<?=$cep?>" id="cep" placeholder="Insira apenas numeros" required>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Endereço: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtEndereco" value="<?=$endereco?>" id="endereco">
                            
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Bairro: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtBairro" value="<?=$bairro?>" id="bairro">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Estados: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstados">
                                
                                <?php 

                                    if(isset($_GET['modo'])){
                                        if ($_GET['modo'] == 'consultaEditar'){
                                            ?>
                                            <option value="<?=$idEstado?>" selected>
                                                <?=$nomeEstado?>
                                            </option>
                                            <?php
                                        }    
                                    }
                                   else{
                                       ?>
                                       <option value="Item"> Selecione um Item</option>
                                        <?php
                                   }

                                    #variavel que lista as informações do BD o where indica que não ha repeticao
                                    $sql = "select * from tblEstados where idEstado <> ".$idEstado." order by nome";
                                    
                                    echo($sql);
                                    # Executa o script da variavel no BD 
                                    $selectEstados = mysqli_query($conex, $sql);
                                    
                                    # Estrutura de repeticao para carregar os estados 
                                    while ($rsEstados = mysqli_fetch_assoc($selectEstados))
                                    {
                                    ?>
                                        <option value="<?php echo($rsEstados['idEstado'])?>"><?php echo($rsEstados['nome'])?></option>
                                <!--  Também pode ser descrita dessa segunda forma -->
<!--                                  <option value=" <?= ($rsEstados['idEstado'])?>"><?= ($rsEstados['nome'])?></option>  -->
                                    <?php
                                        }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Telefone: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtTelefone" value="<?=$telefone?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Celular: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCelular" value="<?=$celular?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Email: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="<?=$email?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Data de Nascimento: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNascimento" value="<?=$dataNascimentoPadraoBR?>">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Sexo: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="radio" name="rdoSexo" value="F" <?php if($sexo == 'F') echo('checked') ?>> Feminino.
                            <input type="radio" name="rdoSexo" value="M" <?php echo $sexo == 'M' ? 'checked' : '' ?>> Masculino.
                            <input type="radio" name="rdoSexo" value="O"> Outros.
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Observações: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7" ><?=$observacao?></textarea>
                        </div>
                    </div>
                    <div class="campos">
                        <!--  formulario para upload da imagem com jquery -->
                        
                    </div>
                    
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
                    </div>
                </form>

                <form name="frmfoto" id="frmfoto" method="post" action="BD/upload.php" enctype="multipart/form-data">
                           
                           <div class="cadastroInformacoesPessoais"> 
                               <p> Imagem </p>
                           </div>
                           <div class="cadastroEntradaDeDados">
                               <input type="file" name="fleFoto" value="" accept="image/jpeg, image/png" id="foto">
                           </div>
                       
                       <div id="imagem">
                                   
                       </div>
                </form>
                
            </div>
        </div>
        <div id="consultaDeDados">
            <table id="tblConsulta" >
                <tr>
                    <td id="tblTitulo" colspan="6">
                        <h1> Consulta de Dados.</h1>
                    </td>
                </tr>
                <tr id="tblLinhas">
                    <td class="tblColunas"> Nome </td>
                    <td class="tblColunas"> Celular </td>
                    <td class="tblColunas"> Estado </td>
                    <td class="tblColunas"> Email </td>
                    <td class="tblColunas"> foto </td>
                    <td class="tblColunas"> Opções </td>
                    
                </tr>

                <?php 
                    # SCRIPT QUE SELECIONA OS DADOS NO BANCO 
                    $sql = "SELECT tblcontatos.idContato, tblcontatos.nome as nomeContato, 
                    tblcontatos.celular, tblcontatos.email, tblestados.sigla, 
                    tblestados.nome as nomeEstado, tblcontatos.imagem  
                    FROM tblcontatos, tblestados
                    where tblestados.idEstado = tblcontatos.idEstado order by tblcontatos.idContato desc";

                    # ENVIA O SCRIPT PARA O BANCO DE DADOS
                   $selectContato = mysqli_query($conex, $sql);
                    
                   # ESTRUTURA DE REPETICAO QUE LISTA OS CONTATOS NA LISTA 
                   # MYSQLI_FETCH_ASSOC TRANSFORMA O RESULTADO EM UM ARRAY LIST
                    while ($rsContatos = mysqli_fetch_assoc($selectContato)){

                ?>
                <tr id="tblLinhas">
                    <td class="tblColunas"><?=$rsContatos['nomeContato']?></td>
                    <td class="tblColunas"><?=$rsContatos['celular']?></td>
                    <td class="tblColunas"><?=$rsContatos['sigla'] ." - ".  $rsContatos['nomeEstado']?></td>
                    <td class="tblColunas"><?=$rsContatos['email']?></td>
                    <td class="tblColunas">
                       <img src="BD/arquivos/<?=$rsContatos['imagem']?>" class="imagembd">
                    </td>
                    
                    <td class="tblColunas"> 
                        <div class="tblImagens">

                            <a onclick="return confirm('Deseja realmente excluir o registro?')" href="BD/deleteContato.php?modo=excluir&id=<?=$rsContatos['idContato']?>&imagem=<?=$rsContatos['imagem']?>">
                                <div class="fechar"></div>
                            </a>
                            <div class="pesquisar" onclick="visualizarContato(<?=$rsContatos['idContato']?>);"></div>

                            <a href="index.php?modo=consultaEditar&id=<?=$rsContatos['idContato']?>">
                                <div class="editar"></div>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php 
                    }
                ?>
               
               
            </table>

        </div>
        <script src="scripts/script.js" ></script>
    </body>
</html>