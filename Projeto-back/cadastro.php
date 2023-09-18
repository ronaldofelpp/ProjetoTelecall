<?php
     /*váriaveis criadas para armazenar informações para acessar
    e se conectar ao banco de dados*/
    $servername = "localhost";
    $username = "root";
    $password = "5566710";
    $dbname = "projeto_teste";

    /*$conn para armazernar a ação de criar uma conexão mysql com os dados
    fornecidos pelas variáveis acima, com as informações para realizar o acesso
    e a conexão com o banco desejado*/
    $conn = new mysqli($servername, $username, $password, $dbname);

    /*Verifica se a conexão ao banco de dados foi bem-sucedida, se não for, exibe
    uma mensagem de erro e encerra o script*/
    if ($conn->connect_error) {
        die ("Falha na conexão: ".$conn->connect_error);
     }

    /*Variáveis criadas para receber e armazenar os valores enviados pelo formulário
    de cadastro via método POST*/
    $nome = $_POST['nome'];
    $cpf = $_POST['CPF'];
    //código exemplo para filtrar o valor da variável $cpf, tirando caracteres como "." e "-".
    //$cpfFiltrado = str_replace(array('.', '-'), '', $cpf);
    $genero = $_POST['genero'];
    $data_nasc = $_POST['datanascimento'];
    $nomemat = $_POST['nomematerno'];
    $cel = $_POST['celular'];
    $tel = $_POST['telfixo'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cod_uf = $_POST['estado'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    //echo $nome, $cpf, $genero,$data_nasc,$nomemat,$cel,$tel,$cep,$rua,$numero,$bairro,$cidade,$cod_uf,$login,$senha;
    
    
    // Váriavel com consulta para verificar se o login ou o email já existem no banco de dados
    $sql_check = "SELECT CPF, LOGIN  FROM teste_usuarios WHERE CPF = '$cpf' or LOGIN = '$login' ";
    $result = mysqli_query($conn, $sql_check);
    /*Condição para verificar se na consulta o programa retornou mais de 0 linhas, se retornar,
    existem dados repetidos*/
    if (mysqli_num_rows($result) > 0){
        echo "CPF ou LOGIN já cadastrado em outra conta.<a href=errocadastro.html>Tentar novamente</a>";
    } else {
        /*Variável com uma consulta SQL criada para inserir novos registros na tabela desejada
        dentro do banco de dados*/
        $insert = "INSERT INTO teste_usuarios (NOME, CPF, GENERO, DTNASC, NOMEMAT, CEL, TEL, CEP, RUA, NUMERO, BAIRRO, CIDADE, COD_UF, LOGIN, SENHA, STAT, DTULTALT ) VALUES ('$nome','$cpf','$genero','$data_nasc','$nomemat','$cel','$tel','$cep','$rua','$numero','$bairro','$cidade','$cod_uf','$login','$senha','Ativo',current_timestamp())";
        
        /*Executa a consulta SQL e emite um feedback para o usuário, se foi realizado com sucesso
        ou foi falho*/
        if ($conn->query($insert) === TRUE ) {
            echo "Cadastro realizado com sucesso, <a href=tela1.html>iniciar sessão agora.</a>";
        } else {
            echo "Erro ao cadastrar: ".$conn->error;
        }
    };    
    //Fecha a conexão com o banco de dados quando a operação é concluída
    $conn->close();
?>