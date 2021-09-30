<?php

	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "amostraspd";

	//Criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	$id_categoria = $_REQUEST['id_categoria'];
	
	$result_sub_cat = "SELECT * FROM amostra WHERE CodCliente = $id_categoria ORDER BY NomeAmostra";
	$resultado_sub_cat = mysqli_query($conn, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$resultao_sub_cat[] = array(
			'id'	=> $row_sub_cat['CodAmostra'],
			'Nome' => utf8_encode($row_sub_cat['NomeAmostra']),
		);
	}
	echo(json_encode($resultao_sub_cat));
	
?>