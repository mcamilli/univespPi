<?php
	header('Content-Type: text/html; charset=utf-8');
    include('../_codigos/classes.php');
    include('../_codigos/mysql.php');

    //$sql = "SELECT c.RazaoSocial as Cliente, c.CodCliente as IdCliente, a.NomeAmostra as Amostra, a.CodAmostra as IdAmostra, m.NomeMet as Metodo, e.CodExame as IdExame FROM exame e INNER JOIN metodo m ON e.CodMetodo = m.CodMetodo INNER JOIN amostra a ON a.CodAmostra = e.CodAmostra  INNER JOIN cliente c ON c.CodCliente = a.CodCliente ORDER BY 1";

    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true && $_SESSION["PermissaoAdmin"][0]== false){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:_codigos/logout.php');
    }

    $amostra = $_SESSION["usuario"][1];

    $sql = "SELECT a.CodAmostra, a.NomeAmostra, a.LoteProduto, a.QtdAmostra, a.PrincipioAtivo, a.DataCadastro, a.DataRecebido, c.RazaoSocial FROM amostra a INNER JOIN cliente c ON c.CodCliente = a.CodCliente AND a.CodCliente = ?  ORDER BY 1";
    //$sql = "SELECT * FROM amostra";
	$query = Mysql::conectar()->prepare($sql);
    $query->execute(array($amostra));

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

        table{
            font-size: 13pt;
            width: 81%;
        }
        
        table#tabela_simples {
            border-collapse: collapse; /* CSS2 */
            border: solid black 1px; /* Precedência tem bug no IE */
            width: 75%;
        }
        table#tabela_simples td {
            border: solid black 1px;
            padding-left: 5px;
            padding-right: 5px;
        }
        table#tabela_simples tr#amostras:hover {
            background: black;
            color: white;
            
        }
        table tr#primeira_linha{
            font-weight: bold;
            
        }
        iframe {
            width: 75%;
            height: 600px;
            overflow-x: scroll !important;
            overflow-y: scroll !important;
        }
    </style>
</head>
<body>
    <article id="incio">

        <header>
       
            <h2>
                <br>
               Amostras cadastradas:
                
            </h2>        
        </header>

        <table id="tabela_simples">
            <br>
            <tr id="primeira_linha">
                <td>ID Amostra</td>
                <td>Amostra</td>
                <td>Lote</td>
                <td>Qtd. Amostra</td>
                <td>Princípio Ativo</td>
                <td>Cadastro</td>
                <td>Recebido Lab</td>
        </tr>
                
            
            <?php  

            foreach($query as $dados){ 
                   
            ?>
            <tr id="amostras">
                <td id="CodAmostra"><?php echo $dados["CodAmostra"];?></td>
                <td><?php echo $dados["NomeAmostra"];?></td>
                <td><?php echo $dados["LoteProduto"];?></td>
                <td><?php echo $dados["QtdAmostra"];?></td>
                <td><?php echo $dados["PrincipioAtivo"];?></td>
                <td id="Datacadastro"><?php if($dados['DataCadastro'] != null){ echo date('d-m-Y', strtotime($dados['DataCadastro']));}?></td>
                <td><?php if($dados['DataRecebido'] != null){ echo date('d-m-Y', strtotime($dados['DataRecebido']));}?></td>
            </tr>

            <?php 
            }
            echo '<script type="text/javascript"> 
            destacar(); 
            function destacar(){

                var oRows = document.getElementById("tabela_simples").getElementsByTagName("tr");
                var iRowCount = oRows.length;
                
                    for(var j = 1; j < iRowCount; j++)
                    {
                        if(oRows[j].cells[5].innerHTML == ""){
                        var tableCells = oRows[j] ;
                        tableCells.style.backgroundColor = "rgb(144, 238, 144)";
                        }
                    }
                }
            </script>'

            ?>




            
        </table>
    </article>

</body>
</html>