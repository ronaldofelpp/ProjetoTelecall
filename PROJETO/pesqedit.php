<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDITAR USUARIO</title>
    <link rel="stylesheet" href="css/pesqedit.css">
    <?php 
        session_start();
        include 'verificamaster.php';
    ?>
</head>
<body>
    <div class="card-container">
        <button id='button'><h1>SISTEMA</h1></button>
        <div class="card">

            <img src="imagens/imagens-tela1/logo-telecall.png" alt="Imagem do card">
            <h2>🔎​ Digite o usuário que deseja editar:</h2>
            <form method="post">

                <input type="number" name="nameidusuario" id="ididusuario" placeholder='ID do USUÁRIO' required >
                
                <input type="submit" value="Pesquisar" formaction="editusu.php">
                <input type="submit" value="Ativar/Inativar" id="submit" formaction="status.php" >
                <a href="telaescolha.php"><button type='button' class='botao' >Voltar 🠔</button></a>
         
            </form>

            

        </div>
    </div>
</body>
</html>