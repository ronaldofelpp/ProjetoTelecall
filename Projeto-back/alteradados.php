<?php
     /*função para iniciar uma sessão php, permitindo o uso de variáveis de sessão,
    que funcionam em diversas páginas diferentes*/
    session_start();

    /*váriaveis criadas para armazenar informações para acessar
    e se conectar ao banco de dados*/
    $servername = "localhost";
    $username = "root";
    $password = "5566710";
    $dbname = "projeto_teste";

    $cpf = $_SESSION["CPF"];

    /*Variáveis criadas para receber e armazenar os valores enviados pelo formulário
    de cadastro via método POST*/
    $nome = $_POST['nome'];
    //código exemplo para filtrar o valor da variável $cpf, tirando caracteres como "." e "-".
    //$cpfFiltrado = str_replace(array('.', '-'), '', $cpf);
    $genero = $_POST['genero'];
    $cel = $_POST['celular'];
    $tel = $_POST['telfixo'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cod_uf = $_POST['estado'];
    $senha = $_POST['senha'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    /*Verifica se a conexão ao banco de dados foi bem-sucedida, se não for, exibe
    uma mensagem de erro e encerra o script*/
    if ($conn->connect_error) {
        die ("Falha na conexão: ".$conn->connect_error);
    }

    /*Variável com uma consulta SQL criada para verificar se o login e senha correspondem
    a um registro no banco de dados*/
    $sql = "UPDATE teste_usuarios SET NOME = '$nome', GENERO = '$genero', CEL  = '$cel', TEL = '$tel', CEP = '$cep', RUA = '$rua', NUMERO = '$numero', BAIRRO = '$bairro', CIDADE = '$cidade', COD_UF = '$cod_uf', DTULTALT = current_timestamp() WHERE CPF = '$cpf'";
    
    if ($conn->query($sql) === TRUE ) {
        echo "Dados alterados com sucesso, <a href=tela3.php>Voltar para a página principal.</a>";
    }
     //Fecha a conexão com o banco de dados quando a operação é concluída
    $conn->close();

    
?>