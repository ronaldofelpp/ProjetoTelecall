<?php
    /*váriaveis criadas para armazenar informações para acessar
    e se conectar ao banco de dados*/
    $servername = "localhost";
    $username = "root";
    $password = "5566710";
    $dbname = "mydb";

    /*$conn para armazernar as informações para criar uma conexão mysql com os dados
    fornecidos pelas variáveis acima.*/
    $conn = new mysqli($servername, $username, $password, $dbname);

    /*Verifica se a conexão ao banco de dados foi bem-sucedida, se não for, exibe
    uma mensagem de erro e encerra o script*/
    if ($conn->connect_error) {
        die ("Falha na conexão: ".$conn->connect_error);
     }
?>