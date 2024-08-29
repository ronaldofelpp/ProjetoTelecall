<?php

    session_start();

    include 'verificamaster.php';

    //id enviado pelo formulário
    $id = $_POST['nameidusuario'];

    include 'conexao.php';
    /*
    
    
    */
    //select personalizado para resgatar dados específicos do BD com as relações necessárias
    $sql = "SELECT usu.Nome AS NOME, usu.CPF AS CPF, usu.DataNasc AS DATANASC, usu.Nomemat AS NOMEMAT, usu.Login AS LOGIN, usu.Senha AS SENHA, usu.Genero AS GENERO, usu.Status AS STATUS, usu.DataInclu AS DATAINCLU, usu.DataUltAlt AS DATAULTALT, tp.tipo AS TIPO, ed.cidade AS CIDADE, UF.desc_uf AS DESC_UF, ct.cel1 AS CEL1
    FROM usuario usu
    JOIN tipo tp ON usu.idTipo = tp.idTipo
    JOIN endereco ed ON usu.idendereco = ed.idendereco
    JOIN uf ON ed.cod_uf = uf.cod_uf
    JOIN contato ct ON usu.idcontato = ct.idcontato
    WHERE idusuario = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    // Executar a consulta
    $stmt->execute();
    // Obter resultados
    $result = $stmt->get_result();
    $stmt->close();
    $conn->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta

        $nome = $row['NOME'];
        $cpf = $row['CPF'];
        $datanasc = $row['DATANASC'];
        $nomemat = $row['NOMEMAT'];
        $login = $row['LOGIN'];
        $senha = $row['SENHA'];
        $genero = $row['GENERO'];
        $status = $row['STATUS'];
        $datainclu = $row['DATAINCLU'];
        $dataultalt = $row['DATAULTALT'];
        $tipo = $row['TIPO'];
        $cidade = $row['CIDADE'];
        $desc_uf = $row['DESC_UF'];
        $cel1 = $row['CEL1'];
        //codigo para formatar dados
        $cpf_formatado = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
        $cel1_formatado = '('.substr($cel1, 0, 2).')'.substr($cel1,2, 5 ).'-'.substr($cel1, 7, 11);

        //codigo para calcular a idade do usuário
        $dataatual = date('Y-m-d');
        $idade = date_diff(date_create($datanasc), date_create($dataatual));

        //formatar data e hora corretamente, e separa a hora da data

        // Converte a data para um objeto DateTime
        $dataincFormatada = new DateTime($datainclu);
        // Formata a data no formato desejado (D-M-A H:i:s)
        $dataincFormatada = $dataincFormatada->format('d/m/Y H:i:s');

        list($dataParte, $horaParte) = explode(" ", $dataincFormatada);

        $dataaltFormatada = new DateTime($dataultalt);
        // Formata a data no formato desejado (D-M-A H:i:s)
        $dataaltFormatada = $dataaltFormatada->format('d/m/Y H:i:s');

        list($dataaltParte, $horaaltParte) = explode(" ", $dataaltFormatada);
    } else {
        echo "<div class='usu-view'><h3>❌ Não existe nenhum usuário com este ID ➥ <a href='pesqver.php'>Tentar novamente</a></h3></div>";
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $nome ?></title>
    <link rel="stylesheet" href="css/visualizarusu.css">
</head>
<body>
            
    <?php if ($result->num_rows > 0) {?> 
        <div class='usu-view'>
            <h3>Visualização Geral do usuário: <?php echo $id;?></h3>
            <p><?php echo $nome; ?>, morador da cidade "<?php echo $cidade;?>" que tem UF de descrição "<?php echo $desc_uf; ?>" possui <?php echo $idade -> format('%Y anos');?> 
            de idade, mãe chamada <?php echo $nomemat;?> e tem perfil de usuário "<?php echo $tipo;?>".</p>

            <h4>CPF: <?php echo $cpf_formatado;?></h4>
            <h4>Contato principal: <?php echo $cel1_formatado;?></h4>
            <h4>Data de Inclusão no sistema: <?php echo $dataParte.' as '.$horaParte;?></h4>
            <h4>Data de alteração no sistema: <?php echo $dataaltParte.' as '.$horaaltParte;?></h4>
            <h4>Status do usuário: <?php echo $status;?></h4>
            <h4>Login: <?php echo $login;?></h4>
            <h4>Senha: <?php echo $senha;?></h4>

            <a href="telaescolha.php"><button type='button' class='botao' >Voltar 🠔</button></a>
            <a href="pesqver.php"><button type='button' class='botao' >Visualizar outro</button></a>
        </div>
    <?php } ?>
</body>
</html>

