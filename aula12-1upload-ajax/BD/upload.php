<?php 
 #echo('teste'); exit;
    
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
                                
                                # variavel de sessao é uma variavel que só finaliza quando o google for fechado
                                
                                # elimina a variavel de sessao
                                # session_destroy();

                                # ativando uma variavel de sessao 
                                session_start();

                                # guarda o nome da foto que foi enviada para o servidor
                                $_SESSION['nomeFoto'] = $foto;

                                                                
                                
                                
                                # exibe a imagem no campo indicado
                                echo("<img src='BD/arquivos/".$foto."'>");
                                
                            # SCRIPTS PARA ENVIAR OS DADOS AO BD
                            
                        }
                    }
                    else{
                        echo('funcionnnnaaa ');
                    } 
                }
            }

                              

                        
                        
?>