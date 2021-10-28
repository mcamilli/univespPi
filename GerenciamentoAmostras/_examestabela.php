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

    $sql = "SELECT * FROM exame e JOIN metodo m JOIN amostra a ON e.CodMetodo = m.CodMetodo and e.CodAmostra = a.CodAmostra  ORDER BY 1";

    //$sql = "SELECT * FROM exame";
	$query = Mysql::conectar()->prepare($sql);
    $query->execute();
    $count = $query->rowCount();

    $exame_finalizado = 0;
    $exame_em_execucao = 0;


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
            font-size: 12pt;
        }
        
        table#tabela_exames {
            border-collapse: collapse; /* CSS2 */
            border: solid black 1px; /* Precedência tem bug no IE */
        }
        table#tabela_exames td {
            border: solid black 1px;
            padding-left: 5px;
            padding-right: 5px;
        }
        table#tabela_exames tr#amostras:hover {
            background: black;
            color: white;
            
        }
        table tr#primeira_linha{
            font-weight: bold;
            
        }
    </style>
</head>
<body>
    <article id="incio">

        <header>
       
            <h2>
               Exames cadastrados:
            </h2>        
            <h3>
                Total de exames: <?php echo $count; ?>. 
                Concluído: <?php 
  
                echo $exame_finalizado;

                ?>.
                Em andamento: <?php echo $exame_em_execucao; ?>.
            </h3>
        </header>

        

        <br>

        <table id="tabela_exames">
        
            <tr id="primeira_linha">
                <td>ID Exame</td>
                <td>Protocolo ISO</td>
                <td>Contrato</td>
                <td>Amostra</td>
                <td>Início</td>
                <td>Fim</td>
            </tr>
            <?php  

            foreach($query as $dados){ 

                if($dados['ExameFinalizado'] != null){
                    $exame_finalizado = $exame_finalizado + 1;
                }
                if($dados['ExameIniciado'] != null){
                    $exame_em_execucao = $exame_em_execucao + 1;
                }
                   
            ?>
            <tr id="exames">
                <td><?php echo $dados["CodExame"];?></td>
                <td><?php echo $dados["NomeMet"];?></td>
                <td><?php echo $dados["NumeroContrato"];?></td>
                <td><?php echo $dados["NomeAmostra"];?></td>
                <td id="ExameIniciado"><?php if($dados['ExameIniciado'] != null){ echo date('d-m-Y', strtotime($dados['ExameIniciado']));}?></td>
                <td><?php if($dados['ExameFinalizado'] != null){ echo date('d-m-Y', strtotime($dados['ExameFinalizado']));}?></td>
            </tr>

            <?php 
            }
            echo '<script type="text/javascript"> 
            destacar(); 
            function destacar(){

                var oRows = document.getElementById("tabela_exames").getElementsByTagName("tr");
                var iRowCount = oRows.length;
                
                    for(var j = 1; j < iRowCount; j++)
                    {
                        if(oRows[j].cells[4].innerHTML == ""){
                        var tableCells = oRows[j] ;
                        tableCells.style.backgroundColor = "rgb(144, 238, 144)";
                        }
                    }
                }
                contaval();
                function contaval(){
                    alert("teste deu certo");
                }
            </script>';
            ?>


           
        </table>
    </article>

</body>
</html>