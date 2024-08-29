<?php 

    session_start();
    include 'verificamaster.php';

    $id = $_POST['nameidusuario'];

    include 'conexao.php';

    $sql_usu = "SELECT NOME, CPF, GENERO, DATANASC, NOMEMAT, LOGIN, SENHA, IDENDERECO, IDCONTATO FROM usuario WHERE IDUSUARIO = ?";
    $stmt = $conn->prepare($sql_usu);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id); 
    $stmt->execute();

    $result1 = $stmt->get_result();
    
    $stmt->close();
    $conn->close();

    // O IF verifica se a consulta retornou pelo menos uma linha
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
        $nome = $row['NOME'];
        $cpf = $row['CPF'];
        $genero = $row['GENERO'];
        $datanasc = $row['DATANASC'];
        $nomemat = $row['NOMEMAT'];
        $login = $row['LOGIN'];
        $senha = $row['SENHA'];
        $idendereco = $row['IDENDERECO'];
        $idcontato = $row['IDCONTATO'];


        include 'conexao.php';

        $sql_end = "SELECT CEP, RUA, NUMERO, BAIRRO, CIDADE, COD_UF FROM ENDERECO WHERE IDENDERECO = ?";
        $stmt = $conn->prepare($sql_end);

        // Verifica se a preparação da consulta foi bem-sucedida
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $idendereco);
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        $conn->close();

        // O IF verifica se a consulta retornou pelo menos uma linha
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
            $cep = $row['CEP'];
            $rua = $row['RUA'];
            $numero = $row['NUMERO'];
            $bairro = $row['BAIRRO'];
            $cidade = $row['CIDADE'];
            $cod_uf = $row['COD_UF'];

            include 'conexao.php';

            $sql_cont = "SELECT CEL1, CEL2 FROM CONTATO WHERE IDCONTATO = ?";
            $stmt = $conn->prepare($sql_cont);

            // Verifica se a preparação da consulta foi bem-sucedida
            if ($stmt === false) {
                die("Erro na preparação da consulta: " . $conn->error);
            }

            $stmt->bind_param("i", $idcontato);
            $stmt->execute();
            $result = $stmt->get_result();

            $stmt->close();
            $conn->close();

            //O IF verifica se a consulta retornou pelo menos uma linha
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc(); //<- Obtém os dados do usuário da linha retornada pela consulta
                $cel1 = $row['CEL1'];
                $cel2 = $row['CEL2'];
            
            } else {
                echo "Falha na consulta ao banco 3.<a href='pesqedit.html'>Tentar novamente</a>";
            };

        } else {
            echo "Falha na consulta ao banco 2.<a href='pesqedit.html'>Tentar novamente</a>";
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
    <link rel="stylesheet" href="css/style-tela2.css">
    <title>EDITAR USUARIO</title>
</head>
<body>
    <?php if ($result1->num_rows > 0) {?>
        <div class="container">
            <div class="logotelecall">
                <img src="imagens/imagens-tela2/logo-telecall.png" alt="Logo Empresa Telecall" id="fototelecall">
            </div>
            <header>Editar <?php echo $nome?></header>
            <h2 style="text-align:center; color:#b42936;">Alteração de dados</h2>

            <form action="alteramaster.php" method="post" id="formInteiro" name="formInteiro">
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
                                    CPF
                                    <input type="text" id="CPF" name="CPF" maxlength="14" value="<?php echo $cpf?>" maxlength='14'>
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
                                    Data de nascimento
                                    <input type="date" id="datanascimento" name="datanascimento" value="<?php echo $datanasc?>" >
                                </label>
                            </div>

                            <div class="campo">
                                <label for="Nome Materno">
                                    Nome Materno
                                    <input type="text" id="nomematerno" name="nomematerno" value="<?php echo $nomemat?>"  maxlength='50'>
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
                                    Login
                                    <input type="text" id="login" name="login" value="<?php echo $login?>"  maxlength='30'>
                                </label>
                            </div>

                            <div class="campo">
                                <label for="senha">
                                    Senha
                                    <input type="password" id="senha" name="senha" value="<?php echo $senha?>" maxlength='30'>
                                    <input type="hidden" name="idusuario" value="<?php echo $id ?>">
                                </label>
                            </div>

                        </div>
                        <div class="buttons">
                            <input type="submit" value="Confirmar alterações" id="submit">
                            

                            
                        </div>
                        <div class="linkLogin">
                        <a href="pesqedit.php"><button type='button' class='botao' id='botao'>Voltar 🠔</button></a>
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
        <script type="text/javascript" src="javascript/script-tela2.js"></script>
        <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <?php } ?>
</body>
</html>