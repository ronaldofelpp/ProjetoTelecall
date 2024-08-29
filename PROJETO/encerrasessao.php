<?php
    //Incia a sessão PHP para acessar a função
    session_start();

    //Encerra a sessão atual, excluindo todas as variáveis de sessão.
    session_destroy();

    //Após encerrar a sessão, redireciona o usuário de volta para a página de login.
    header("Location: tela1.html");
?>
