<?php
     /*função para iniciar uma sessão php, permitindo o uso de variáveis de sessão,
    que funcionam em diversas páginas diferentes*/
    session_start();

    if(!isset($_SESSION['CPF'])) {
        header('location: tela1.html');
        exit();
    }

    /*váriaveis criadas para armazenar informações para acessar
    e se conectar ao banco de dados*/
    $servername = "localhost";
    $username = "root";
    $password = "5566710";
    $dbname = "projeto_teste";

    /*Variáveis criadas para receber e armazenar os valores enviados pelo formulário
    de login via método POST*/
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    /*$conn para armazernar a ação de criar uma conexão mysql com os dados
    fornecidos pelas variáveis acima, com as informações para realizar o acesso
    e a conexão com o banco desejado*/
    $conn = new mysqli($servername, $username, $password, $dbname);

    /*Verifica se a conexão ao banco de dados foi bem-sucedida, se não for, exibe
    uma mensagem de erro e encerra o script*/
    if ($conn->connect_error) {
        die ("Falha na conexão: ".$conn->connect_error);
    }

    /*Variável com uma consulta SQL criada para verificar se o login e senha correspondem
    a um registro no banco de dados*/
    $sql = "SELECT  NOME, CPF, NOMEMAT FROM teste_usuarios WHERE LOGIN = '$login' AND SENHA = '$senha'";
    
    /*Executa a consulta SQL e armazena o resultado na variável $result*/
    $result = $conn->query($sql);

     //Fecha a conexão com o banco de dados quando a operação é concluída
    $conn->close();

    
    /*O IF verifica se a consulta retornou pelo menos uma linha, se retornar
    obviamente seu login foi bem-sucedido*/
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $_SESSION["CPF"] = $row["CPF"];
        $_SESSION["nome"] = $row["NOME"]; //<- Armazenam as informações da linha numa váriavel de sessão
        $_SESSION["nomematerno"] = $row["NOMEMAT"];
        
        header("location: autenticacao.php"); //<- Redireciona o usuário para a página de autenticação
    } else {
        echo "Login ou senha incorretos, falha na consulta ao banco.<a href='tela1.html'>Tentar novamente</a>";
    };

?>