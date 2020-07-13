<?php 
    # funcao de cria a conexao com BD 
    function conexaoMysql(){
        
        $server = 'localhost';
        $user = 'root';
        $password = 'bcd127';
        $dataBase = 'dbContatos20201A';
        
        
        # conexao com o banco de dados 
        $conexao = mysqli_connect($server, $user, $password, $dataBase);

        # retorna todas as informações de conexao com o banco de dados
        # var_dump($conexao);
        
        return $conexao;
    }
    


?>
