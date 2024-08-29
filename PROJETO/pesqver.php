<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VISUALIZAR USU</title>
    <link rel="stylesheet" href="css/pesqver.css">
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
            <h2>🔎​ Digite o usuário que deseja visualizar:</h2>
            <form action="visualizarusu.php" method='post'>

                <input type="number" name="nameidusuario" id="ididusuario" placeholder='ID do USUÁRIO' pattern="{3}[0-9]" title="Somente números" required>
                
                <a href="telaescolha.php"><button type='button' class='botao' >Voltar 🠔</button></a>
                <input type="submit" value="Visualizar">

            </form>
        </div>
    </div>
</body>
</html>