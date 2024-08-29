<?php

    session_start(); //inicia sessão de usuário

    include 'verificacomum.php';

    $cpf = $_SESSION["CPF"];

    //variaveis para armazenar dados enviados pelo formulário
    $nome = $_POST['nome'];
    //código exemplo para filtrar o valor da variável $cpf, tirando caracteres como "." e "-".
    //$cpfFiltrado = str_replace(array('.', '-'), '', $cpf);
    $genero = $_POST['genero'];
    $cel1 = $_POST['celular'];

    $cel1Filtrado = str_replace(array('(',')','-',' '), '', $cel1);

    $cel2 = $_POST['telfixo'];

    $cel2Filtrado = str_replace(array('(',')','-',' '), '', $cel2);

    $cep = $_POST['cep'];

    $cepFiltrado = str_replace(array('-',' '), '', $cep);

    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cod_uf = $_POST['estado'];
    $senha = $_POST['senha'];

    include 'conexao.php';

    $sql = "SELECT IDENDERECO, IDCONTATO FROM USUARIO WHERE CPF = ?";
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $cpf);
    
    $stmt->execute(); // Executa a consulta
   
    $result = $stmt->get_result(); // Obtém resultados

    
    $stmt->close(); // Fecha a instrução preparada

    $conn->close(); //Fecha a conexão com o banco de dados

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $idendereco = $row['IDENDERECO'];
        $idcontato = $row['IDCONTATO'];

    }

    include 'conexao.php';
    
    $conn->begin_transaction();
    
    try{
        //query de update
        $query1 = "UPDATE USUARIO SET NOME = ?, GENERO = ?, DATAULTALT = current_timestamp() WHERE CPF = ?";

        $statement = $conn->prepare($query1);
        $statement->bind_param("sss", $nome, $genero, $cpf);

        if ($statement->execute()){
            //query de update
            $query2 = "UPDATE ENDERECO SET CEP = ?, RUA = ?, NUMERO = ?, BAIRRO = ?, CIDADE = ?, COD_UF = ? WHERE IDENDERECO = ?";

            $statement = $conn->prepare($query2);
            $statement->bind_param("ssssssi", $cepFiltrado, $rua, $numero, $bairro, $cidade, $cod_uf, $idendereco);

            if ($statement->execute()) {
                //query de update
                $query3 = "UPDATE CONTATO SET CEL1  = ?, CEL2 = ? WHERE IDCONTATO = ?";

                $statement = $conn->prepare($query3);
                $statement->bind_param("ssi", $cel1Filtrado, $cel2Filtrado, $idcontato);

                if ($statement->execute()) {
                    $conn->commit(); //confirma a transação se todas as querys forem bem sucedidas

                    echo     

                    '<div class="card-container">
                        <div class="card">
                            <img src="imagens/imagens-tela1/logo-telecall.png" alt="Imagem do card">
                            <h2>✅ Concluído!</h2>
                            <p>Dados alterados com sucesso, <a href=encerrasessao.php>acesse novamente na sua conta</a></p>
                        </div>
                    </div>';

                } else{
                    throw new Exception("insert na tabela contato");
                }
            } else {
                throw new Exception("insert na tabela endereço");
            }
        } else {
            throw new Exception("insert na tabela usuário");
        }
    } catch (Exception $erro) {
        $conn->rollback(); //rollback na transação se algum update der erro
        echo "Erro na transação: ". $erro->getMessage();
    };
    $conn->close(); //Fecha conexao com o banco
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUCESSO!</title>
    <link rel="stylesheet" href="css/alteradados.css">
</head>
<body>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>