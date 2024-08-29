<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>O que é 2FA?</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/2FA.css">
</head>

<body>
  <nav class="navbar col-12 position-fixed navbar-expand-lg navbar-custom" data-bs-theme="dark" style="z-index:999;">
    <div class="container-fluid col-11 m-auto">
      <a class="navbar-brand" href="tela3.php"><img src="imagens/imagens-tela3/logo-telecall.png"
          style="margin-right: 1rem;" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="tela3.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#sobre-nos">Sobre nós</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Serviços
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="2FA.php">Two factory authentication</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="NumMas.php">Número máscara</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Google verified calls</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="SMSProg.php">SMS programável</a></li>
            </ul>
          </li>
          </ul>
          <?php

          //inicia uma sessão php para acessar as variáveis de sessão.
          session_start();

          /*Verifica se o usuário NÃO(!) está autenticado, se realmente não estiver
          o usuário será redirecionado novamente para a página de login*/
          if (isset($_SESSION["CPF"])) {
            $nome = $_SESSION["nome"];
            $cpf = $_SESSION["CPF"];
            
              
          }

          /*Armazenam o nome e o sobrenome do usuário a partir
          das variáveis de sessão*/

          ?>

          <button type="button" class="switch btn btn-outline-success" id="btnSwitch"
            style="width: 4%; -webkit-border-radius: 50px;
          -moz-border-radius: 50px;-o-border-radius: 50px; -ms-border-radius: 50px; border-radius: 50px; margin-right: 1rem; background-color: #0c4c7c;"><i class="fa-regular fa-moon"
              style="font-size: 15px;"></i></button>

          <?php 
          //se o usuário estiver na sessão e se for do tipo 1, modifica a navbar
              if (isset($_SESSION["CPF"]) && isset($_SESSION['tipo']) && $_SESSION['tipo'] == 1) {
                echo '<a href="dadoscadastrais.php" style="text-decoration:none;"><i class="fa-regular fa-user fa-sm" style="margin-right: 5px;"></i>',$nome,'</a>';
                echo '<a href="encerrasessao.php" id=idencerra style="text-decoration:none; margin-left: 15px;"><i class="fa-solid fa-arrow-right-from-bracket" style="font-size: 15px;"></i> Sair</a>';
            } else {
              echo '<a href="tela1.html" id=idencerra style="text-decoration:none; margin-right: 15px;"><i class="fa-solid fa-arrow-right-to-bracket" style="font-size: 15px"></i> Login</a>';
              echo '<a href="tela2.html" style="text-decoration:none;"><i class="fa-regular fa-user fa-sm" style="margin-right: 5px; "></i>Cadastre-se</a>';

            }
          ?>
      </div>
    </div>
  </nav>
  <br>
  <br>
  <br>
  <br>
  <div class="conteudo">
    <h1>O que é 2FA?</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4 col-10 m-auto">
      <div>
        <p>
          "2FA" (Two-Factor Authentication) é um método de autenticação adicional usado para aumentar a segurança de
          contas
          online. Em vez de depender apenas de uma senha, o 2FA requer que o usuário forneça duas formas diferentes de
          autenticação para acessar uma conta.
        </p>
        <p>
          Geralmente, o processo de 2FA envolve três elementos:
        </p>

        <ol>
          <li>Algo que o usuário sabe: geralmente é uma senha ou um PIN.</li>
          <li>Algo que o usuário possui: pode ser um dispositivo físico, como um smartphone, um token de segurança ou um
            cartão inteligente.</li>
          <li>Algo que o usuário é: isso pode incluir dados biométricos, como impressão digital ou reconhecimento
            facial.
          </li>
        </ol>
      </div>
      <div class="image-container m-auto">
        <img src="imagens/imagens-4telas/2fa.jpg" id="fa" alt="2FA" />
      </div>
    </div>
    <div class="row col-10 m-auto">

      <p>
        Ao ativar o 2FA em uma conta, o usuário precisará fornecer a senha (primeiro fator) e, em seguida, confirmar sua
        identidade usando o segundo fator antes de obter acesso. Isso adiciona uma camada extra de segurança, pois mesmo
        que
        um invasor descubra a senha, eles ainda não poderão acessar a conta sem o segundo fator.
      </p>

      <p>
        Os métodos comuns de 2FA incluem o uso de aplicativos de autenticação no smartphone, envio de códigos de
        verificação
        por SMS, uso de chaves de segurança físicas ou até mesmo biometria.
      </p>

      <p>
        A implementação do 2FA é altamente recomendada para proteger suas contas online e evitar acessos não
        autorizados.
      </p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>

</html>