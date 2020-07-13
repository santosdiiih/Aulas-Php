
<script>
            // ativa as funcoes js após o carregamento  do html
            $(document).ready(function(){
               $('.pesquisar').click(function(){
                    $('#modal').fadeIn(1000);
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

        <div id="modal" >
            <div id="modalConteudo"></div>
        </div>
        <div id="cadastro"> 
            <div id="cadastroTitulo"> 
                <h1> Cadastro de Contatos </h1>
            </div>
            <div id="cadastroInformacoes">
                <form action="router.php?controller=contatos&modo=inserir" name="frmCadastro" method="post" enctype="multipart/form-data">
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Nome: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNome" value="">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Cep: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCep" value="" id="cep" placeholder="Insira apenas numeros" required>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Endereço: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtEndereco" value="" id="endereco">
                            
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Bairro: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtBairro" value="" id="bairro">
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Estados: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <select name="sltEstados">
                                
                                
                                        <option value=""></option>
                                <!--  Também pode ser descrita dessa segunda forma -->

                                    
                            </select>
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Telefone: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtTelefone" value="">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Celular: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtCelular" value="">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Email: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="email" name="txtEmail" value="">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Data de Nascimento: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="text" name="txtNascimento" value="">
                        </div>
                    </div>
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Sexo: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <input type="radio" name="rdoSexo" value="F" > Feminino.
                            <input type="radio" name="rdoSexo" value="M" > Masculino.
                            <input type="radio" name="rdoSexo" value="O"> Outros.
                        </div>
                    </div>
                    
                    <div class="campos">
                        <div class="cadastroInformacoesPessoais">
                            <p> Observações: </p>
                        </div>
                        <div class="cadastroEntradaDeDados">
                            <textarea name="txtObs" cols="50" rows="7" ></textarea>
                        </div>
                    </div>
                    
                    <div class="enviar">
                        <div class="enviar">
                            <input type="submit" name="btnEnviar" value="Salvar">
                        </div>
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
                    
                    <td class="tblColunas"> Opções </td>
                    
                </tr>

                
                <tr id="tblLinhas">
                    <td class="tblColunas"></td>
                    <td class="tblColunas"></td>
                    
                    <td class="tblColunas"></td>
                    <td class="tblColunas">
                       <img src="" class="imagembd">
                    </td>
                    
                    <td class="tblColunas"> 
                        <div class="tblImagens">

                            <a onclick="return confirm('Deseja realmente excluir o registro?')" href="BD/deleteContato.php?modo=excluir&id=">
                                <div class="fechar"></div>
                            </a>
                            <div class="pesquisar" onclick="visualizarContato();"></div>

                            <a href="index.php?modo=consultaEditar&id=">
                                <div class="editar"></div>
                            </a>
                        </div>
                    </td>
                </tr>
                
               
               
            </table>

        </div>
        
   