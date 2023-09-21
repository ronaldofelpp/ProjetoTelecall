<?php
    session_start();

    if(!isset($_SESSION['CPF'])) {
        header('location: tela1.html');
        exit();
    }

    $servername = "localhost";
    $username = "root";
    $password = "5566710";
    $dbname = "projeto_teste";

    $cpf = $_SESSION["CPF"];

    /*$conn para armazernar a ação de criar uma conexão mysql com os dados
    fornecidos pelas variáveis acima, com as informações para realizar o acesso
    e a conexão com o banco desejado*/
    $conn = new mysqli($servername, $username, $password, $dbname);

    /*Verifica se a conexão ao banco de dados foi bem-sucedida, se não for, exibe
    uma mensagem de erro e encerra o script*/
    if ($conn->connect_error) {
        die ("Falha na conexão: ".$conn->connect_error);
    }

    $sql = "SELECT  NOME, CPF, GENERO, DTNASC, NOMEMAT, CEL, TEL, CEP, RUA, NUMERO, BAIRRO, CIDADE, COD_UF, LOGIN, SENHA, STAT, DTULTALT FROM teste_usuarios WHERE CPF = '$cpf'";

    $result = $conn->query($sql);

    $conn->close();

    /*O IF verifica se a consulta retornou pelo menos uma linha, se retornar
    obviamente seu login foi bem-sucedido*/
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $row['NOME'];
        $row['CPF'];
        $row['GENERO'];
        $row['DTNASC'];
        $row['NOMEMAT'];
        $row['CEL'];
        $row['TEL'];
        $row['CEP'];
        $row['RUA'];
        $row['NUMERO'];
        $row['BAIRRO'];
        $row['CIDADE'];
        $row['COD_UF'];
        $row['LOGIN'];
        $row['SENHA'];

       
        
    } else {
        echo "Login ou senha incorretos, falha na consulta ao banco.<a href='tela1.html'>Tentar novamente</a>";
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
        <header>Olá, <?php echo $row['NOME']?></header>
        <h2 style="text-align:center; color:#b42936;">Alteração de dados</h2>

        <form action="alteradados.php" method="post" id="formInteiro" name="formInteiro">
            <div class="form first">

                <div class="dadospessoais">
                    <span class="titulo">Dados pessoais</span>
                    <div class="inputs">

                        <div class="campo">
                            <label for="nome">
                                Nome Completo
                                <input type="text" id="nome" name="nome" value="<?php echo $row['NOME']?>" r>
                            </label>
                        </div>
                        <div class="campo">
                            <label for="CPF">
                                CPF - ✅
                            
                                <input type="text" id="CPF" name="CPF" maxlength="14" value="<?php echo $row['CPF']?>" readonly style='color:gray'>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="genero">
                                Selecione seu gênero
                                <select name="genero" id="genero" value="<?php echo $row['GENERO']?>" r style='color:black'>
                                    <option selected value="<?php echo $row['GENERO']?>"><?php echo $row['GENERO']?></option>
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
                                <input type="date" id="datanascimento" name="datanascimento" value="<?php echo $row['DTNASC']?>" readonly>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="Nome Materno">
                                Nome Materno  - ✅
                                <input type="text" id="nomematerno" name="nomematerno" value="<?php echo $row['NOMEMAT']?>" readonly style='color:gray'>
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
                                <input type="text" id="celular" name="celular" value="<?php echo $row['CEL']?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="telfixo">
                                Telefone Fixo
                                <input type="text" id="telfixo" name="telfixo" value="<?php echo $row['TEL']?>" r>
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
                                <input type="text" id="cep" name="cep" value="<?php echo $row['CEP']?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="rua">
                                Rua
                                <input type="text" id="rua" name="rua" value="<?php echo $row['RUA']?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="numero">
                                Número
                                <input type="number" id="numero" name="numero" value="<?php echo $row['NUMERO']?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="bairro">
                                Bairro
                                <input type="text" id="bairro" name="bairro" value="<?php echo $row['BAIRRO']?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="cidade">
                                Cidade
                                <input type="text" id="cidade" name="cidade" value="<?php echo $row['CIDADE']?>" r>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="estado">
                                Estado
                                <input type="text" id="estado" name="estado" value="<?php echo $row['COD_UF']?>" r>
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
                                <input type="text" id="login" name="login" value="<?php echo $row['LOGIN']?>" readonly style='color:gray'>
                            </label>
                        </div>

                        <div class="campo">
                            <label for="senha">
                                Senha
                                <input type="password" id="senha" name="senha" value="<?php echo $row['SENHA']?>" r>
                            </label>
                        </div>

                    </div>
                    <div class="buttons">
                        <input type="submit" value="Confirmar alterações" id="submit">
                    </div>
                    <div class="linkLogin">
                        <label for="link-cadastro">Já possui cadastro?</label>
                        <a href="tela3.php" id="linkPrincipal">Voltar para a página principal</a>
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