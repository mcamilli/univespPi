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


p {
	text-align: justify;
	text-indent: 50px;
}
a{
	color: #606060;
	text-decoration: none;
}
a:hover{
	text-decoration: underline;
}

header#cabecalho{
	height: 70px;
}
header#cabecalho h1 {
	font-family: 'Titillium Web', sans-serif;
	font-size: 20pt;
	color: #606060;
	text-shadow: 1px 1px 1px rgba(0,0,0,.6);
	padding: 0px;
	margin-bottom: 0px;
}
header#cabecalho h2{
	font-family: 'Titillium Web', sans-serif;
	color: #888888;
	font-size: 15pt;
	padding: 0px;
	margin-top: 0px;
	font-family: 'Titillium Web', sans-serif;
}

/* formatação de imagens com legenda */

figure.foto-legenda{
	position: relative;
	border: 8px solid white;
	box-shadow: 1px 1px 4px black;
	
}


/* formatação do menu*/
nav#menu{
display: block; 
}

nav#menu ul{
	list-style: none;
	text-transform: uppercase;
	position: absolute;
	top: -20px;
	left: 650px;
}

nav#menu li{
	display: inline-block;
	background-color: #dddddd;
	padding: 10px;
	margin: 2px;
	transition: background-color;
	
}
nav#menu li:hover {
	background-color: #606060;
}
nav#menu h1{
	display: none;
}

nav#menu a{
	color: #000000;
	text-decoration: none;
	
}
nav#menu a:hover{
color: #ffffff;

}

section#corpo{
display:block;
width: 500px;
float: left;
border-right: 1px solid #606060;
padding-right: 15px;
}
article#Principal h2 {
	font-size: 13pt;
	color: #606060;
	background-color: #dddddd;
	padding: 5px 0px 5px 10px;
	margin: 10px 0px 10px 0px;
}

header#menu-interno h3 {
	border-bottom: 1px #606060 solid;
	border-top: 1px #606060 solid;
	height: 25px;
	font-size: 16px;
	color: #606060;
	padding: 6px 0px 0px 10px;
	vertical-align: middle;
	text-align:left;
}

footer#rodape{
	clear: both;
	border-top: 1px solid #606060;
}

footer#rodape p{
	text-align: center;
}
footer {
	height: 50px;
}

/* formatação do menu opções*/
nav#menu-opcoes {
	display: block;
}

	nav#menu-opcoes ul {
		list-style: none;
		text-transform: uppercase;
		position: absolute;
		top: 90px;
		left: 550px;
	}

	nav#menu-opcoes li {
		display: inline-block;
		background-color: #707070;
		padding: 2px;
		color: white;
		margin: 1px;
		transition: background-color;
	}

nav#menu li:hover {
	background-color: #606060;
}

nav#menu-opcoes h1 {
	display: none;
}

nav#menu-opcoes a {
	color: white;
	text-decoration: none;
}

nav#menu-opcoes a:hover {
	color: black;
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
   <p>Laboratório de Biologia Molecular</p>
   <p>Rua Manoel da Silva, n. 61</p>
   <p>Botucatu - SP, CEP 18600-00</p>

   <?php
        }
   ?>
</body>
</html>