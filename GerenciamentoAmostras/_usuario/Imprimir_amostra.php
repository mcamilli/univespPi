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

    function imprimir_amostra($id_amostra){

        $amostra = $_SESSION["usuario"][0];

        $sql = "SELECT a.CodAmostra, a.NomeAmostra, a.LoteProduto, a.QtdAmostra, a.PrincipioAtivo, a.DataCadastro, a.DataRecebido, c.RazaoSocial FROM amostra a INNER JOIN cliente c ON c.CodCliente = a.CodCliente AND a.CodCliente = ?  ORDER BY 1";
        //$sql = "SELECT * FROM amostra";
        $query = Mysql::conectar()->prepare($sql);
        $query->execute(array($amostra));

    }


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
   <br>
   <br>
   <br>
   <p>Formuário envio amostra</p>
   <br>
   <br>
   <br>
   <p>Nome do Cliente: ID cliente: CNPj:</p>
   
   <p>Nome da Amostra: ID da amostra: </p>
   <p>Princípio ativo:  Lote da amostra:</p>
   <p>Data da fabricação: Temperatura de armazenamento: Qtd de amostra:</p>
   <p>Concentração princípio ativo: Fórmula Centesimal:</p>
   <p>Responsável pelo envio:</p>
   <p>Observação:</p>
   <br>
   <br>
   <br>
   <p>Endereço para envio:</p>
   <br>
   <br>
   <p>Destinatário:</p>
   <p>Colocar aqui o Endereço </p>


</body>
</html>