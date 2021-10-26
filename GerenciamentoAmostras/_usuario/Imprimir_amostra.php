<?php
	header('Content-Type: text/html; charset=utf-8');
    include('../_codigos/classes.php');
    include('../_codigos/mysql.php');

    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true && $_SESSION["PermissaoAdmin"][0]== false){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:../_codigos/logout.php');
    }
        $id_amostra = (int)$_POST['IdAmostraImprimir'];
        $amostra = (int)$_SESSION["usuario"][1];

        $sql = "SELECT a.CodAmostra, a.NomeAmostra, a.LoteProduto, a.QtdAmostra, a.PrincipioAtivo, a.DataCadastro, a.DataFabricacao, a.Armazenamento, a.ConcetracaoAtivo, a.FormCentesimal, a.DataRecebido, a.ResponsavelEnvio, a.ObsAmostra, c.RazaoSocial, c.CodCliente, c.CNPj FROM amostra a INNER JOIN cliente c ON c.CodCliente = a.CodCliente AND a.CodCliente = ? AND a.CodAmostra = ? AND a.DataCadastro IS NOT NULL  ORDER BY 1";
        $query = Mysql::conectar()->prepare($sql);
        $query->execute(array($amostra, $id_amostra));
?>


<!DOCTYPE html>
<script language="javascript" src="_javascript/funcoes.js"></script>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Imprimir</title>
    <link rel="stylesheet" type="text/css" href="../_css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../_css/andamento.css" />
</head>



<body>
    <?php
        foreach($query as $dados){      
    
    ?>
   <br>
   <br>
   <br>
   <h2>Envio de amostra</h2>
   <h1>Formuário</h1>
   <br>
   <br>
   <br>
   <p>Nome do Cliente: &nbsp <?php echo $dados["RazaoSocial"]; ?> &nbsp  ID cliente: &nbsp <?php echo $dados["CodCliente"]; ?> &nbsp CNPj: &nbsp <?php echo $dados["CNPj"]; ?> </p>

   <p>Nome da Amostra: &nbsp <?php echo $dados["NomeAmostra"]; ?> &nbsp ID da amostra: &nbsp <?php echo $dados["CodAmostra"]; ?></p>
   <p>Princípio ativo: &nbsp <?php echo $dados["PrincipioAtivo"]; ?> &nbsp Lote da amostra: &nbsp <?php echo $dados["LoteProduto"]; ?></p>
   <p>Data da fabricação: &nbsp <?php echo $dados["DataFabricacao"]; ?> &nbsp Temperatura de armazenamento: &nbsp <?php echo $dados["Armazenamento"]; ?> &nbsp Qtd de amostra: &nbsp <?php echo $dados["QtdAmostra"]; ?></p>
   <p>Concentração princípio ativo: &nbsp <?php echo $dados["ConcetracaoAtivo"]; ?> &nbsp Fórmula Centesimal: &nbsp <?php echo $dados["FormCentesimal"]; ?> </p>
   <p>Responsável pelo envio: &nbsp <?php echo $dados["ResponsavelEnvio"]; ?></p>
   <p>Observação: &nbsp <?php echo $dados["ObsAmostra"]; ?></p>
   <br>
   <br>
   <br>
   <p>Endereço para envio:</p>
   <br>
   <br>
   <p>Destinatário:</p>
   <p>Colocar aqui o Endereço </p>

   <?php
        }
   ?>
</body>
</html>