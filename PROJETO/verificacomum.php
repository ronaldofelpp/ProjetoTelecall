<?php 
        if(!isset($_SESSION['CPF'])) {
            header('location: encerrasessao.php');
            exit();
        }
?>