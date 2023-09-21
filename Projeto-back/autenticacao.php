<?php
    session_start();

    if(!isset($_SESSION['CPF'])) {
        header('location: tela1.php');
        exit();
    }
    
    if (isset($_POST["nome_materno"])) {
        $nomematerno = $_POST["nome_materno"];

        if ($nomematerno === $_SESSION["nomematerno"]) {
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
    <title>Autenticação</title>
</head>
<body>
<h1>Autenticação em dois fatores</h1>
    <p>Olá, <?php echo $_SESSION['nome']; ?></p>
    <form action="autenticacao.php" method="POST">
        <label for="idnome_materno">Qual o nome da sua mãe?</label>
        <input type="text" id="idnome_materno" name="nome_materno" required><br><br>

        <input type="submit" value="Verificar">
    </form>
    
</body>
</html>