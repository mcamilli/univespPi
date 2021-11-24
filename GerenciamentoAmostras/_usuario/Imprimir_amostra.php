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

<style>
@charset "UTF-8";
@import url('https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap');

@font-face{
	font-family: 'FonteLogo';
	src: url("../_fonts/bubblegum-sans-regular.otf");
}

body{
	font-family: Arial, sens-serif;
	background-color: white;
	}

div#interface{
	width:90%;
	margin: -20px auto 0px auto;
	box-shadow: 0px 0px 10px rgba(0,0,0,.5);
	padding: 10px 10px 10px 10px;
}

div#pagina {
    padding: 40px;
	margin-left: 10px;
	margin-right: 10px;
	width: 600px;
}

div#pagina p{
	text-align: justify;
	/*text-indent: 50px;*/
	margin-bottom: 10px;
}

p {
	text-align: justify;
	/*text-indent: 50px;*/
	margin: 0px;
}
a{
	color: #606060;
	text-decoration: none;
}

div#envio {
	margin-left: 40px;
	margin-right: 40px;
	margin-left: 40px;
	margin-right: 40px;
	width: 600px;
	border-top: 1px solid black;
	
}


div#cabecalho{
	padding-top: 20px;
	padding-bottom: 5px;
	margin-left: 40px;
	margin-right: 40px;
	width: 600px;
	border: 1px solid black;
	text-align: center;
}

div#cabecalho h2{
	font-size: 20pt;
	padding: 0px;
	margin-top: 0px;
}


</style>

<!DOCTYPE html>
<script language="javascript" src="_javascript/funcoes.js">


</script>



<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Imprimir</title>

    

</head>



<body>
    <?php
        foreach($query as $dados){      
    
    ?>
   <br>
   <br>
   <br>
   <div id="cabecalho">
   <h2>Guia de envio de amostra</h2>

	</div>
	<br>
   <br>
   <br>
   
   <div id="pagina">
   <p><b>Nome do Cliente:</b> &nbsp <?php echo $dados["RazaoSocial"]; ?> &nbsp  <b>ID cliente:</b> &nbsp <?php echo $dados["CodCliente"]; ?> </p>
   <p> <b>CNPj:</b> &nbsp <?php echo $dados["CNPj"]; ?> </p>

   <p><b>Nome da Amostra:</b> &nbsp <?php echo $dados["NomeAmostra"]; ?> &nbsp <b>ID da amostra:</b> &nbsp <?php echo $dados["CodAmostra"]; ?></p>
   <p><b>Princípio ativo:</b> &nbsp <?php echo $dados["PrincipioAtivo"]; ?> &nbsp <b>Lote da amostra:</b> &nbsp <?php echo $dados["LoteProduto"]; ?></p>
   <p><b>Data da fabricação:</b> &nbsp <?php echo $dados["DataFabricacao"]; ?> &nbsp <b>Temperatura de armazenamento:</b> &nbsp <?php echo $dados["Armazenamento"]; ?> </p>
	<p><b>Qtd de amostra:</b> &nbsp <?php echo $dados["QtdAmostra"]; ?></p>
   <p><b>Concentração princípio ativo:</b> &nbsp <?php echo $dados["ConcetracaoAtivo"]; ?> &nbsp <b>Fórmula Centesimal:</b> &nbsp <?php echo $dados["FormCentesimal"]; ?> </p>
   <p><b>Responsável pelo envio:</b> &nbsp <?php echo $dados["ResponsavelEnvio"]; ?></p>
   <p><b>Observação: </b>&nbsp <?php echo $dados["ObsAmostra"]; ?></p>
   </div>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>
   <br>

   <div id="envio">
   <p><b>Endereço para envio:</b></p>
   <br>
   
   <p><b>Destinatário:</b></p>
   <p>Laboratório de Biologia Molecular</p>
   <p>Rua Manoel da Silva, n. 61</p>
   <p>Botucatu - SP, CEP 18600-00</p>
   </div>

   <?php
        }
   ?>
</body>
</html>