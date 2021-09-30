
<?php
	//include('config.php');

	class form{

		public static function cadastrar($RazaoSocial, $NomeFantasia, $cnpj, $endereco, $numero, $cidade, $estado, $cep, $telefone1, $telefone2, $email, $login, $senha, $prefixo){

		$query = "INSERT INTO administrador VALUES (null,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$sql = Mysql::conectar()->prepare($query);
		$sql->execute(array($RazaoSocial,$NomeFantasia,$cnpj,$endereco,$numero,$cidade,$estado,$cep,$telefone1,$telefone2,$email,$login,md5($senha),$prefixo));
		}

		public static function VerificaLogin($login, $senha){

			$conexao = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die ('Não foi possosível conectar');

			$usuario = mysqli_real_escape_string($conexao,$login);
			$senha2 = mysqli_real_escape_string($conexao,$senha);

			$query = "select  LoginAdmin from administrador where LoginAdmin = '{$usuario}' and SenhaAdmin = md5('{$senha2}')";
			//$sql = Mysql::conectar()->prepare($query);
			$result = mysqli_query($conexao, $query);
			$row = mysqli_num_rows($result);
		
			if($row == 1){
				$_SESSION['usuario'] = $usuario;
				header('Location:PainelAdmin.php');
				exit();
			}else{
				header('Location:index.php');
				exit();
			}
		}
	}
?>