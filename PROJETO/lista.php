<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <style>
        table {
            width: 100%;
            margin: 0 auto; 
            border: 1px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 0px;
            text-align: center; 
        }

        form {
            margin-top: 5px;
            text-align:center;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Genero</th>
            <th>Nascimento</th>
            <th>Mae</th>
            <th>Login</th>
            <th>Senha</th>
            <th>Status</th>
            <th>CEP</th>
            <th>Rua</th>
            <th>Numero</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>UF</th>
            <th>Cel1</th>
            <th>Cel2</th>

            <?php

                include 'conexao.php';

                $sql = "SELECT
                u.idUsuario,
                u.Nome,
                u.CPF,
                u.Genero,
                u.DataNasc,
                u.NomeMat,
                u.Login,
                u.Senha,
                u.Status,
                e.CEP,
                e.Rua,
                e.Numero,
                e.Bairro,
                e.Cidade,
                e.Cod_uf,
                c.cel1,
                c.cel2
                FROM
                usuario u
                JOIN endereco e ON u.idendereco = e.idendereco
                JOIN contato c ON u.idcontato = c.idcontato;";
                
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['idUsuario'] . "</td>";
                        echo "<td>" . $row['Nome'] . "</td>";
                        echo "<td>" . $row['CPF'] . "</td>";
                        echo "<td>" . $row['Genero'] . "</td>";
                        echo "<td>" . $row['DataNasc'] . "</td>";
                        echo "<td>" . $row['NomeMat'] . "</td>";
                        echo "<td>" . $row['Login'] . "</td>";
                        echo "<td>" . $row['Senha'] . "</td>";
                        echo "<td>" . $row['Status'] . "</td>";
                        echo "<td>" . $row['CEP'] . "</td>";
                        echo "<td>" . $row['Rua'] . "</td>";
                        echo "<td>" . $row['Numero'] . "</td>";
                        echo "<td>" . $row['Bairro'] . "</td>";
                        echo "<td>" . $row['Cidade'] . "</td>";
                        echo "<td>" . $row['Cod_uf'] . "</td>";
                        echo "<td>" . $row['cel1'] . "</td>";
                        echo "<td>" . $row['cel2'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Nenhum resultado encontrado.";
                }
                $conn->close();
            ?>
        </tr>
    </table> 

    <form action="gerapdf.php" method="post">
        <a href="telaescolha.php"><button type='button'>⬅️Voltar</button></a>
        <input type="submit" value="📂Gerar PDF">
    </form>

</body>
</html>