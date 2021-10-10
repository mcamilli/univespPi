<?php
	header('Content-Type: text/html; charset=utf-8');
    include('_codigos/classes.php');
    include('_codigos/mysql.php');

    //$sql = "SELECT Usuario, CodCliente FROM cliente WHERE Usuario = ? AND Senha = ?";
    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true && $_SESSION["PermissaoAdmin"][0]== true){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:_codigos/logout.php');
    }



    $sql = "SELECT * FROM cliente";
	$query = Mysql::conectar()->prepare($sql);
    $query->execute();

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
    <title>Tabela de clientes</title>
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
               Clientes cadastrados:
            </h2>        
        </header>

        <table border="1">
        
            <tr>
                <td>ID Cliente</td>
                <td>Cliente</td>
                <td>CNPj</td>
                <td>Login</td>
                <td>Desde</td>
                <td>Total de amostras</td>
                <td>Total de Testes</td>
                <td>Testes em execução</td>
                <td>Testes em concluídos</td>
            </tr>
            <?php  

            foreach($query as $dados){ 
                   
            ?>

            <tr>
                <td><?php echo $dados["CodCliente"];?></td>
                <td><?php echo $dados["RazaoSocial"];?></td>
                <td><?php echo $dados["CNPj"];?></td>
                <td><?php echo $dados["Usuario"];?></td>
                <td><?php echo $dados["DataCadastro"];?></td>
                <td>"nada"</td>
                <td>"nada"</td>
                <td>"nada"</td>
                <td>"nada"</td>
            </tr>
            <?php 
            } ?>
        </table>
    </article>

</body>
</html>