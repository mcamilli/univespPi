<?php
	header('Content-Type: text/html; charset=utf-8');
    include('_codigos/classes.php');
    include('_codigos/mysql.php');

    //$sql = "SELECT c.RazaoSocial as Cliente, c.CodCliente as IdCliente, a.NomeAmostra as Amostra, a.CodAmostra as IdAmostra, m.NomeMet as Metodo, e.CodExame as IdExame FROM exame e INNER JOIN metodo m ON e.CodMetodo = m.CodMetodo INNER JOIN amostra a ON a.CodAmostra = e.CodAmostra  INNER JOIN cliente c ON c.CodCliente = a.CodCliente ORDER BY 1";

    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true && $_SESSION["PermissaoAdmin"][0]== true){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:_codigos/logout.php');
    }



    $sql = "SELECT a.CodAmostra, a.NomeAmostra, a.LoteProduto, a.PrincipioAtivo, c.RazaoSocial FROM amostra a INNER JOIN cliente c ON c.CodCliente = a.CodCliente ORDER BY 1";
    //$sql = "SELECT * FROM amostra";
	$query = Mysql::conectar()->prepare($sql);
    $query->execute();

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
    <title>Tabela de amostras</title>
    <style>
        body{
            font-family: Arial;
            font-size: 10pt;
        }
        p{
            text-align: justify;
            text-indent: 20px;
        }
        article h1{
            font-size: 15pt;
            color: #ffffff;
            background-color: rgba(0,0,0,.3);
            padding:5px;
            margin: 0px;
        }
        article h2 {
            font-size: 13pt;
            color: #888888;
            margin: 0px;
        }
        article{
            margin-bottom: 5px;
        }
        
    </style>
</head>
<body>
    <article id="incio">

        <header>
       
            <h2>
               Amostras cadastradas:
            </h2>        
        </header>

        <table border="1">
        
            <tr>
                <td>ID Amostra</td>
                <td>Amostra</td>
                <td>Lote</td>
                <td>Princípio Ativo</td>
                <td>Cliente</td>
            </tr>
            <?php  

            foreach($query as $dados){ 
                   
            ?>
            <tr>
                <td><?php echo $dados["CodAmostra"];?></td>
                <td><?php echo $dados["NomeAmostra"];?></td>
                <td><?php echo $dados["LoteProduto"];?></td>
                <td><?php echo $dados["PrincipioAtivo"];?></td>
                <td><?php echo $dados["RazaoSocial"];?></td>
            </tr>
            <?php 
            } ?>
        </table>
    </article>

</body>
</html>