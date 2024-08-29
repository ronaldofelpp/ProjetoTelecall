<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/style-autentificacao.css">
</head>
<body>
    <div class="container">
        <img style="margin-bottom: 15px" src="imagens/imagens-tela1/logo-telecall.png" alt="Imagem do card"><br>
        <?php
            //Variáveis criadas armazenar as variáveis enviadas pelo formulário
            $nome = $_POST['nome'];
            $cpf = $_POST['CPF'];
            //código para filtrar o valor da variável $cpf, tirando caracteres como "." e "-".
            $cpfFiltrado = str_replace(array('.', '-'), '', $cpf);

            $genero = $_POST['genero'];
            $data_nasc = $_POST['datanascimento'];
            $nomemat = $_POST['nomematerno'];
            $cel = $_POST['celular'];

            $celFiltrado = str_replace(array('(',')','-',' '), '', $cel);

            $tel = $_POST['telfixo'];

            $telFiltrado = str_replace(array('(',')','-',' '), '', $tel);

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
            $conn -> begin_transaction();

            try{
                $sql_check = "SELECT CPF FROM USUARIO WHERE CPF = ?"; // verifica se o cpf já existe
                $stmt = $conn->prepare($sql_check);
                // Verifica se a preparação da consulta foi bem-sucedida
                if ($stmt === false) {
                    die("Erro na preparação da consulta: " . $conn->error);
                }
                $stmt->bind_param("s", $cpfFiltrado);
                $stmt->execute(); // Executa a consulta
                $result = $stmt->get_result(); // Obtém resultados
                $stmt->close(); // Fecha a instrução preparada

                //checa se retornou mais de 0 linhas
                if (mysqli_num_rows($result) > 0){
                    echo '<label style="color: #b42936; font-size: 1.2rem; font-weight: bold;">❌ O CPF já foi cadastrado em outra conta</label><br> <input type="submit" onclick="history.back()" style="margin-top:1.5rem;" value="Retornar">';
                }else{
                    $sql_check = "SELECT LOGIN FROM USUARIO WHERE LOGIN = ?"; // verifica se o login já existe
                    $stmt = $conn->prepare($sql_check);
                    // Verifica se a preparação da consulta foi bem-sucedida
                    if ($stmt === false) {
                        die("Erro na preparação da consulta: " . $conn->error);
                    }
                    $stmt->bind_param("s", $login);
                    $stmt->execute(); // Executa a consulta
                    $result = $stmt->get_result(); // Obtém resultados
                    $stmt->close(); // Fecha a instrução preparada

                    //checa se retornou mais de 0 linhas
                    if (mysqli_num_rows($result) > 0){
                        echo '<label style="color: #b42936; font-size: 1.2rem; font-weight: bold;">❌ O Login escolhido já foi cadastrado em outra conta</label><br> <input type="submit" onclick="history.back()" style="margin-top:1.5rem;" value="Retornar">';
                    } else {
                        //insere dados na tabela endereço
                        $sql_endereco = "INSERT INTO ENDERECO (CEP, Rua, Numero, Bairro, Cidade, Cod_uf) VALUES (?, ?, ?, ?, ?, ?)";
                        $statement = $conn->prepare($sql_endereco);
                        $statement->bind_param("ssssss", $cepFiltrado, $rua, $numero, $bairro, $cidade, $cod_uf);

                        if ($statement->execute()) {
                            
                            $idEndereco = $statement->insert_id; // Recupera o ID do endereço recém-inserido
                    
                            // Insere dados na tabela contato
                            $sql_contato = "INSERT INTO CONTATO (cel1, cel2) VALUES (?, ?)";
                            $statement = $conn->prepare($sql_contato);
                            $statement->bind_param("ss", $celFiltrado, $telFiltrado);
                            if ($statement->execute()) {
                                
                                $idContato = $statement->insert_id; // Recupera o ID de contato recém-inserido
                                
                                //insere dados na tabela usuario
                                $sql_usuario = "INSERT INTO USUARIO (Nome, CPF, Genero, DataNasc, NomeMat, Login, Senha, Status, DataInclu, DataUltAlt, idENDERECO, idCONTATO, idTIPO) VALUES (?, ?, ?, ?, ?, ?, ?, 'Ativo', current_timestamp(),current_timestamp(),? ,? , 1)";
                                $statement = $conn->prepare($sql_usuario);
                                $statement->bind_param("sssssssii", $nome, $cpfFiltrado, $genero, $data_nasc, $nomemat, $login, $senha, $idEndereco, $idContato);
                                if ($statement->execute()) {
                                    $conn->commit(); //confirma a transação
                                    echo '<label style="color: #b42936; font-size: 1.2rem; font-weight: bold;">✅ Cadastro realizado com sucesso!</label><br> <a href = tela1.html><input type="submit" style="margin-top:1.5rem;" value="Iniciar Sessão"><a>';
                                    
                                } else {
                                    throw new Exception("insert na tabela usuário");
                                }
                            } else {
                                throw new Exception("insert na tabela contato");
                            }
                        } else {
                            throw new Exception("insert na tabela endereco");
                        }
                    };
                }
            } catch (Exception $erro) {
                $conn->rollback();
                echo "Erro na transação: ". $erro->getMessage();
            }        
                    //Fecha a conexão com o banco de dados quando a operação é concluída
                    $conn->close();
            
            



        ?>
    </div>
</body>
</html>

