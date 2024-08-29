<?php 
        if(!isset($_SESSION['CPF']) || !isset($_SESSION['tipo']) || $_SESSION['tipo'] !==2) {
            header('location: encerrasessao.php');
            exit();
        }
?>