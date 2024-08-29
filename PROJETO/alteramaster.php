<?php
     /*função para iniciar uma sessão php, permitindo o uso de variáveis de sessão,
    que funcionam em diversas páginas diferentes*/
    session_start();

    include 'verificamaster.php';
    /*Variáveis criadas para receber e armazenar os valores enviados pelo formulário
    de cadastro via método POST*/
    $id = $_POST['idusuario'];
    $nome = $_POST['nome'];
    $cpf = $_POST['CPF'];
    //código exemplo para filtrar o valor da variável $cpf, tirando caracteres como "." e "-".
    $cpfFiltrado = str_replace(array('.', '-'), '', $cpf);

    $genero = $_POST['genero'];
    $cel1 = $_POST['celular'];

    $cel1Filtrado = str_replace(array('(',')','-',' '), '', $cel1);

    $cel2 = $_POST['telfixo'];

    $cel2Filtrado = str_replace(array('(',')','-',' '), '', $cel2);

    $datanasc = $_POST['datanascimento'];
    $nomemat = $_POST['nomematerno'];

    $cep = $_POST['cep'];

    $cepFiltrado = str_replace(array('-',' '), '', $cep);

    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $cod_uf = $_POST['estado'];

    $login = $_POST['login'];
    $senha = $_POST['senha'];



    include 'conexao.php';
    /*Variável com uma consulta SQL criada para verificar se o login e senha correspondem
    a um registro no banco de dados*/
    $sql = "SELECT IDENDERECO, IDCONTATO FROM USUARIO WHERE IDUSUARIO = '$id'";
    $result = $conn->query($sql);
     //Fecha a conexão com o banco de dados quando a operação é concluída
    $conn->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $idendereco = $row['IDENDERECO'];
        $idcontato = $row['IDCONTATO'];

    }


    include 'conexao.php';
    $conn->begin_transaction();

    try{

        $query1 = "UPDATE USUARIO SET NOME = ?, CPF = ? , DATANASC = ?, NOMEMAT = ?, GENERO = ?, LOGIN = ?, SENHA = ?, DATAULTALT = current_timestamp() WHERE IDUSUARIO = ?";

        $statement = $conn->prepare($query1);
        $statement->bind_param("sssssssi", $nome, $cpfFiltrado, $datanasc, $nomemat, $genero, $login, $senha, $id);

        if ($statement->execute()) {
            
            $query2 = "UPDATE ENDERECO SET CEP = ?, RUA = ?, NUMERO = ?, BAIRRO = ?, CIDADE = ?, COD_UF = ? WHERE IDENDERECO = ?";

            $statement = $conn->prepare($query2);
            $statement->bind_param("ssssssi", $cepFiltrado, $rua, $numero, $bairro, $cidade, $cod_uf, $idendereco);

            if ($statement->execute()) {

                $query3 = "UPDATE CONTATO SET CEL1  = ?, CEL2 = ? WHERE IDCONTATO = ?";
                $statement = $conn->prepare($query3);
                $statement->bind_param("ssi", $cel1Filtrado, $cel2Filtrado, $idcontato);

                if ($statement->execute()) {
                    $conn->commit(); //confirma a transação
                }else{
                    throw new Exception("insert na tabela contato");
                }
            }else{
                throw new Exception("insert na tabela endereço");
            }
        }else{
            throw new Exception("insert na tabela usuário.");
        }
            
        } catch (Exception $erro){
        $conn->rollback(); //rollback na transação
        echo "Erro na transação: ". $erro->getMessage();
    }
    //Fecha a conexão com o banco de dados quando a operação é concluída
     $conn->close();
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

    <div class="card-container">
        <div class="card">
            <img src="imagens/imagens-tela1/logo-telecall.png" alt="Imagem do card">
            <h2>✅ Concluído!</h2>
            <?php 
                //verifica se as três querys foram bem sucedidas
                if ($query1 && $query2 && $query3){
                    echo "<p>Dados de ".$nome." alterados com sucesso <a href=telaescolha.php>Voltar</a></p>";
                }
                else{
                    echo 'Erro3 - Problema no insert';
                }
            
            ?>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</body>
</html>