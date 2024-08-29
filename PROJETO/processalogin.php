<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style-autentificacao.css">
</head>
<body>
    <div class="container">
        <img style="margin-bottom: 15px" src="imagens/imagens-tela1/logo-telecall.png" alt="Imagem do card"><br>
        <?php
            //função para iniciar uma sessão, permitindo o uso de variáveis de sessão
            session_start();

            //Variáveis criadas para receber e armazenar os valores enviados pelo formulário pelo método POST
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            include 'conexao.php';
            // Verifica se existe login e senha correspondentes ao enviados pelo formulário
            $sql = "SELECT NOME, CPF, NOMEMAT, idTIPO, STATUS FROM USUARIO WHERE LOGIN = ? AND SENHA = ?";
            $stmt = $conn->prepare($sql);
            
            // Verifica se a preparação da consulta foi bem-sucedida
            if ($stmt === false) {
                die("Erro na preparação da consulta: " . $conn->error);
            }
            $stmt->bind_param("ss", $login, $senha);
            $stmt->execute(); // Executa a consulta
            $result = $stmt->get_result(); // Obtém resultados
            
            $stmt->close(); // Fecha a instrução preparada
            $conn->close(); //Fecha a conexão com o banco de dados quando a operação é concluída

            
            //O IF verifica se a consulta retornou pelo menos uma linha
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $status = $row['STATUS'];
                if($status == 'Ativo'){
                    include 'conexao.php';
                    
                    // Verifica se existe login e senha correspondentes ao enviados pelo formulário
                    $sql = "SELECT NOME, CPF, NOMEMAT, idTIPO, STATUS FROM USUARIO WHERE LOGIN = ? AND SENHA = ?";
                    $stmt = $conn->prepare($sql);
                    
                    // Verifica se a preparação da consulta foi bem-sucedida
                    if ($stmt === false) {
                        die("Erro na preparação da consulta: " . $conn->error);
                    }
                    $stmt->bind_param("ss", $login, $senha);
                    $stmt->execute(); // Executa a consulta
                    $result = $stmt->get_result(); // Obtém resultados
                    
                    $stmt->close(); // Fecha a instrução preparada
                    $conn->close();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
                        $_SESSION["CPF"] = $row["CPF"];
                        $_SESSION["nome"] = $row["NOME"]; //<- Armazenam as informações da linha numa váriavel de sessão
                        $_SESSION["tipo"] = $row["idTIPO"];
                        $_SESSION["nomematerno"] = $row["NOMEMAT"];
                        
                        if ($_SESSION["tipo"]=='1'){
                            header('location: autenticacao.php');

                        } elseif ($_SESSION["tipo"]=='2') {
                            header('location: telaescolha.php');
                        } else {
                            echo '<label style="color: #b42936; font-size: 1.2rem; font-weight:bold;">❌ Tipo de usuário desconhecido</label> <a href="encerrasessao.php"><input type="submit" style="margin-top:1.5rem;" value="Retornar"></a>';
                        };
                    }
                } else {
                    echo '<label style="color: #b42936; font-size: 1.2rem; font-weight:bold;">❌ Usuário está inativo, contate o número 0000-0000 para reverter isso.</label> <a href="encerrasessao.php"><br><input type="submit" style="margin-top:1.5rem;" value="Retornar"></a>';
                };
            }else {
            echo '<label style="color: #b42936; font-size: 1.2rem; font-weight:bold;">❌ Login ou senha incorretos.</label> <a href="encerrasessao.php"><input type="submit" style="margin-top:1.5rem;" value="Retornar"></a>';
            };
        ?>
    </div>
</body>
</html>