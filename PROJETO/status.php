<?php 

    session_start();

    include 'verificamaster.php';

    $id = $_POST['nameidusuario'];

    include 'conexao.php';
    // Verifica se existe login e senha correspondentes ao enviados pelo formulário
    $sql = "SELECT NOME, STATUS FROM USUARIO WHERE IDUSUARIO = ?";
    $stmt = $conn->prepare($sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    $stmt->execute(); // Executa a consulta
    $result = $stmt->get_result(); // Obtém resultados
    
    $stmt->close(); // Fecha a instrução preparada
    $conn->close();

    if ($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $status = $row['STATUS'];
        $nome = $row['NOME'];

        if ($status == 'Ativo'){
            include 'conexao.php';
            $sql = "UPDATE USUARIO SET STATUS = 'Inativo', DATAULTALT = current_timestamp() WHERE IDUSUARIO = $id";
            $result = $conn->query($sql);
            $conn->close();

            echo "<div class='usu-view'><h3>✅ Usuário ".$nome." anteriormente ativo, agora se encontra inativo. ➥ <a href='pesqedit.php'>Prosseguir</a></h3></div>";
        } else {
            include 'conexao.php';
            $sql = "UPDATE USUARIO SET STATUS = 'Ativo' WHERE IDUSUARIO = $id";
            $result = $conn->query($sql);
            $conn->close();

            echo "<div class='usu-view'><h3>✅ Usuário ".$nome." anteriormente inativo, agora se encontra ativo. ➥ <a href='pesqedit.php'>Prosseguir</a></h3></div>";
        };
    } else {
        echo "<div class='usu-view'><h3>❌ Não existe nenhum usuário com este ID ➥ <a href='pesqedit.php'>Tentar novamente</a></h3></div>";
    };

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STATUS</title>
    <link rel="stylesheet" href="css/visualizarusu.css">
</head>
<body>
    
</body>
</html>