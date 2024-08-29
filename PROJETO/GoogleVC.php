<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>O que é Google Verified Calls?</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="css/GoogleVC.css">

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
    <h1>O que é Google Verified Calls?</h1>
    <div class="row col-10 m-auto">
      <p>
        "Google Verified Calls" é um serviço oferecido pelo Google para ajudar os usuários a identificar e confirmar
        chamadas telefônicas legítimas de empresas e organizações confiáveis. Ele fornece uma camada adicional de
        segurança e transparência ao exibir informações verificadas sobre a identidade do chamador.
      </p>

      <p>
        Quando uma chamada é marcada como "Google Verified Call", o usuário receberá informações adicionais na tela do
        seu
        dispositivo, como o nome da empresa, logotipo, motivo da chamada e até mesmo a confirmação de que a chamada foi
        verificada pelo Google. Isso ajuda a evitar chamadas de spam, golpes telefônicos e identificar ligações de
        empresas legítimas.
      </p>

      <p>
        O serviço "Google Verified Calls" utiliza tecnologias de criptografia e autenticação para garantir a integridade
        das informações exibidas. Ele está disponível em dispositivos Android com a versão do sistema operacional
        compatível e com o aplicativo de chamadas padrão do Google.
      </p>

      <p>
        É importante ressaltar que o serviço "Google Verified Calls" não está disponível para todas as chamadas, pois
        depende da participação das empresas e organizações em adotar as práticas recomendadas pelo Google para a
        verificação de chamadas. Portanto, nem todas as chamadas recebidas serão marcadas como "Google Verified Call".
      </p>

      <p>
        Ao utilizar o "Google Verified Calls", os usuários podem ter mais confiança e segurança ao atender chamadas
        telefônicas, evitando fraudes e protegendo sua privacidade. O serviço visa melhorar a experiência do usuário ao
        identificar e diferenciar chamadas importantes das indesejadas ou suspeitas.
      </p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</body>

</html>