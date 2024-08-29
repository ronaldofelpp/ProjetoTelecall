<?php
    session_start();

    include 'verificacomum.php';
    //verifica se o formulário da página foi enviado para a mesma
    if (isset($_POST["nome_materno"])) {
        $nomematerno = $_POST["nome_materno"];

        if ($nomematerno === $_SESSION["nomematerno"]) //verifica se o valor enviado é o mesmo do banco
        {
            header('location: tela3.php');
            exit();
        } else {
            header('location: encerrasessao.php');
            exit();
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-autentificacao.css">
    <title>Autenticação</title>
</head>
<body>
<div class="container">
<div class="logo"><img width="100px" src="imagens\imagens-4telas\fa2.jpg" alt="Pass Recovery"></div>
<h1>2ª AUTENTICAÇÃO</h1><br>
    <h2>Olá, <?php echo $_SESSION['nome']; ?></h2>
    <form action="autenticacao.php" method="POST">
    <div class="form-inputs">
        <label for="idnome_materno">Digite o nome da sua mãe:</label>
    
        <input type="text" id="idnome_materno" name="nome_materno" required><br><br>
    </div>
        <input type="submit" value="Verificar">
    </form>
    
</body>
</html>