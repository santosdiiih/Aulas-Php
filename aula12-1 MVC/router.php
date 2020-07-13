<?php
    # variveis que serao encaminhadas pela view
    # valiavel que identifica qual controller sera instanciada
    $controller = null;
    # identifica a acao do controller (inserir, excluir, atualizar)
    $model = null;

    # valida se a controller esta chegando pelo get
    if(isset($_GET['controller'])){
        # recebe oque chegar na controller
        $controller = strtoupper($_GET['controller']);

        switch ($controller){
            case 'CONTATOS' : 
                # verifica se modo existe 
                if(isset($_GET['modo'])){
                    # recebe o modo que foi enviado pela view
                    $modo  = strtoupper($_GET['modo']); 

                    # import do arquivo controler
                    require_once('controller/contatosController.php');

                    $contatoController = new ContatoController();

                    switch($modo){
                        case 'INSERIR':
                            echo('modo INSERIR');
                            # chama o metodo para inserir contato
                            $contatoController->inserirContato(); 
                            break;
                        case 'EDITAR':
                            # chama o metodo para editar um contato 
                            $contatoController->atualizarContato(); 
                            break;
                        case 'EXCLUIR':
                            # chama o metodo para excluir o contato 
                            $contatoController->deletarContato();
                            break;
                    }
                }
            break;  
        }

    }

?>