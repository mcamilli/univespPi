<?php
	header('Content-Type: text/html; charset=utf-8');
    include('_codigos/classes.php');
    include('_codigos/mysql.php');

    //$sql = "SELECT c.CodCliente, c.RazaoSocial, a.NomeAmostra, a.CodAmostra FROM amostra a JOIN cliente c ON c.CodCliente = a.CodCliente ORDER BY 2";

    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true && $_SESSION["PermissaoAdmin"][0]== true){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:_codigos/logout.php');
    }

    $sql = "SELECT * FROM metodo";

    //$sql = "SELECT * FROM exame";
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
               Exames cadastrados:
            </h2>        
        </header>

        <table border="1">
        
            <tr>
                <td>ID Método</td>
                <td>Método</td>
                <td>Observações</td>

            </tr>
            <?php  

            foreach($query as $dados){ 
                   
            ?>
            <tr>
                <td><?php echo $dados["CodMetodo"];?></td>
                <td><?php echo $dados["NomeMet"];?></td>
                <td><?php echo $dados["ObsMet"];?></td>

            </tr>
            <?php 
            } ?>
        </table>
    </article>

</body>
</html>