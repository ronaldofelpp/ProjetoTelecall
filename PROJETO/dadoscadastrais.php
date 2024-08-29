<?php
    session_start();

    if(!isset($_SESSION['CPF'])) {
        header('location: tela1.html');
        exit();
    }

    $cpf = $_SESSION["CPF"];

    //inclui o script de conexão ao banco
    include 'conexao.php';

    //query para resgatar os dados
    $sql_usu = "SELECT  NOME, CPF, GENERO, DATANASC, NOMEMAT, LOGIN, SENHA, IDENDERECO, IDCONTATO FROM usuario WHERE CPF = '$cpf'";
    $result = $conn->query($sql_usu);

    $conn->close();

    //O IF verifica se a consulta retornou pelo menos uma linha
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém e armazena os dados do usuário da linha retornada pela consulta
        $nome = $row['NOME'];
        $cpfr = $row['CPF'];
        $genero = $row['GENERO'];
        $datanasc = $row['DATANASC'];
        $nomemat = $row['NOMEMAT'];
        $login = $row['LOGIN'];
        $senha = $row['SENHA'];
        $idendereco = $row['IDENDERECO'];
        $idcontato = $row['IDCONTATO'];

    } else {
        echo "Falha na consulta ao banco 1.<a href='tela3.php'>Tentar novamente</a>";
    };


    include 'conexao.php';
    
    $sql_end = "SELECT CEP, RUA, NUMERO, BAIRRO, CIDADE, COD_UF FROM ENDERECO WHERE IDENDERECO = '$idendereco'";
    $result = $conn->query($sql_end);

    $conn->close();

    /*O IF verifica se a consulta retornou pelo menos uma linha*/
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $cep = $row['CEP'];
        $rua = $row['RUA'];
        $numero = $row['NUMERO'];
        $bairro = $row['BAIRRO'];
        $cidade = $row['CIDADE'];
        $cod_uf = $row['COD_UF'];
    } else {
        echo "Falha na consulta ao banco 2.<a href='tela1.html'>Tentar novamente</a>";
    };

    include 'conexao.php';
    $sql_cont = "SELECT CEL1, CEL2 FROM CONTATO WHERE IDCONTATO = '$idcontato' ";
    $result = $conn->query($sql_cont);

    $conn->close();

    /*O IF verifica se a consulta retornou pelo menos uma linha*/
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $cel1 = $row['CEL1'];
        $cel2 = $row['CEL2'];
    
    } else {
        echo "Falha na consulta ao banco 3.<a href='tela1.html'>Tentar novamente</a>";
    };


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-tela2.css">

    <title>Alterar Dados</title>
</head>

<body>
    <div class="container">
        <div class="logotelecall">
            <img src="imagens/imagens-tela2/logo-telecall.png" alt="Logo Empresa Telecall" id="fototelecall">
        </div>
        <header>Olá, <?php echo $nome?></header>
        <h2 style="text-align:center; color:#b42936;">Alteração de dados</h2>

        <form action="alteradados.php" method="post" id="formInteiro" name="formInteiro">
            <div class="form first">

                <div class="dadospessoais">
                    <span class="titulo">Dados pessoais</span>
                    <div class="inputs">

                        <div class="campo">
                            <label for="nome">
                                Nome Completo
                                <input type="text" id="nome" name="nome" value="<?php echo $nome?>" maxlength="50">
                            </label>
                        </div>
                        <div class="campo">
                            <label for="CPF">
                                CPF - ✅
                            
                                <input type="text" id="CPF" name="CPF" maxlength="14" value="<?php echo $cpfr?>" readonly style='color:gray' maxlength='14'>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="genero">
                                Selecione seu gênero
                                <select name="genero" id="genero" value="<?php echo $genero?>" r style='color:black'>
                                    <option selected value="<?php echo $genero?>"><?php echo $genero?></option>
                                    <option value="">Selecione...</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="feminino">Feminino</option>
                                    <option value="outros">Outros</option>
                                    <option value="#">Prefiro não dizer</option>
                                </select>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="datanascimento">
                                Data de nascimento  - ✅
                                <input type="date" id="datanascimento" name="datanascimento" value="<?php echo $datanasc?>" readonly>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="Nome Materno">
                                Nome Materno  - ✅
                                <input type="text" id="nomematerno" name="nomematerno" value="<?php echo $nomemat?>" readonly style='color:gray' maxlength='50'>
                            </label>
                        </div>

                    </div>
                </div>



                <div class="contatopessoal">
                    <span class="titulo">Contato</span>
                    <div class="inputs">

                        <div class="campo">
                            <label for="celular">
                                Celular
                                <input type="text" id="celular" name="celular" value="<?php echo $cel1?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="telfixo">
                                Telefone Fixo
                                <input type="text" id="telfixo" name="telfixo" value="<?php echo $cel2?>" r>
                            </label>
                        </div>

                    </div>
                </div>
            </div>






            <div class="form second">
                <div class="endereco">
                    <span class="titulo">Endereço</span>
                    <div class="inputs">
                        <div class="campo">
                            <label for="cep">
                                CEP
                                <input type="text" id="cep" name="cep" value="<?php echo $cep?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="rua">
                                Rua
                                <input type="text" id="rua" name="rua" value="<?php echo $rua?>" maxlength='70' r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="numero">
                                Número
                                <input type="number" id="numero" name="numero" value="<?php echo $numero?>" maxlength='10' r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="bairro">
                                Bairro
                                <input type="text" id="bairro" name="bairro" value="<?php echo $bairro?>" maxlength='25' r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="cidade">
                                Cidade
                                <input type="text" id="cidade" name="cidade" value="<?php echo $cidade?>" maxlength='25' r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="estado">
                                Estado (Código UF)
                                <input type="text" id="estado" name="estado" value="<?php echo $cod_uf?>" maxlength='2' r>
                            </label>
                        </div>

                    </div>
                </div>

                <div class="finalizarcadastro">
                    <span class="titulo">Cadastro</span>
                    <div class="inputs">
                        <div class="campo">
                            <label for="login">
                                Login  - ✅
                                <input type="text" id="login" name="login" value="<?php echo $login?>" readonly style='color:gray' maxlength='30'>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="senha">
                                Senha
                                <input type="password" id="senha" name="senha" value="<?php echo $senha?>" maxlength='30'>
                            </label>
                        </div>

                    </div>
                    <div class="buttons">
                        <input type="submit" value="Confirmar alterações" id="submit">

                        
                    </div>
                    <div class="linkLogin">
                    <a href="tela3.php"><button type='button' class='botao' id='botao'>Voltar 🠔</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="javascript/script-dadoscadastro.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>