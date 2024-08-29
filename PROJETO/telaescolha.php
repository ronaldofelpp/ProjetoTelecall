<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA-MASTER</title>
    
    <link rel="stylesheet" href="css/telaescolha.css">

    <?php 
        session_start();
        //verifica se o usuário da sessão está logado e é master
        include 'verificamaster.php';
    ?>
</head>
<body>
    <div class="card-container">
        <button id='button'><h1>SISTEMA</h1></button>
        <div class="card">
            <img src="imagens/imagens-tela1/logo-telecall.png" alt="Imagem do card">
            <h2>🔎​ Escolha o que deseja fazer:</h2>
            <a href="pesqver.php"><button class='botao'>Ver usuário</button></a>
            <a href="pesqedit.php"><button class='botao'>Editar usuário</button></a>
            <a href="lista.php"><button class='botao'>Listar</button></a>
            <a href="encerrasessao.php"><button class='botao'><i class="fa-solid fa-right-from-bracket"></i> Sair</button></a>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>
</html>