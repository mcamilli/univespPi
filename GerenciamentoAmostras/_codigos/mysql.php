
<?php
	//DEFINE O LOCAL DO BANCO DE DADOS
	define('HOST', 'localhost');
	define('DATABASE', 'amostraspd');
	define('USER', 'root');
	define('PASSWORD', '');

	class Mysql{

		private static $pdo;

		public static function conectar(){
			if(self::$pdo == null){
				try{
					self::$pdo = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				}catch(Exception $e){
					echo 'Erro ao conectar com o banco de dados';
				}
			}
			return self::$pdo;
		}

		public static function conexao(){

			$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
			// verifica a conexao
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}
			//retun ($conn);
		}

		public static function VerificaLogin($login, $senha){

			$conexao = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die ('Não foi possosível conectar');

			$usuario = mysqli_real_escape_string($conexao,$login);
			$senha2 = mysqli_real_escape_string($conexao,$senha);


			$query = "select  LoginAdmin from administrador where LoginAdmin = '{$usuario}' and SenhaAdmin = md5('{$senha2}')";
			$result = mysqli_query($conexao, $query);
			$row = mysqli_num_rows($result);
			$conexao->close();
			return($row);
		}

		public static function AddAdmin($RazaoSocial, $NomeFantasia, $cnpj, $endereco, $numero, $cidade, $estado, $cep, $telefone1, $telefone2, $email, $login, $senha, $prefixo){

		$query = "INSERT INTO administrador VALUES (null,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$sql = Mysql::conectar()->prepare($query);
		$sql->execute(array($RazaoSocial,$NomeFantasia,$cnpj,$endereco,$numero,$cidade,$estado,$cep,$telefone1,$telefone2,$email,$login,md5($senha),$prefixo));
		return TRUE;
		}

		
		/*public static function AddAdmin($RazaoSocial,$NomeFantasia,$cnpj,$endereco,$numero,$cidade,$estado,$cep,$telefone1,$telefone2,$email,$login,$senha,$prefixo){ //adicionar mais administradores/prestadores de serviços
			
			$conexao = mysqli_connect(HOST, USER, PASSWORD, DATABASE) or die ('Não foi possosível conectar');

			
			$sql = "INSERT INTO administrador (null,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			VALUES ($RazaoSocial,$NomeFantasia,$cnpj,$endereco,$numero,$cidade,$estado,$cep,$telefone1,$telefone2,$email,$login,$senha,$prefixo)";

			if ($conexao->query($sql) === TRUE) {
			  echo '<div id="mensagem">Novo usuário inserido com sucesso!</div>';
			  //echo "New record created successfully";
			} else {
			  //echo "Error: " . $sql . "<br>" . $conexao->error;
			  echo '<div id="mensagem">Novo usuário não cadastrado. <br> Erro: </div>'. $conexao->error;
			}

			$conexao->close();
		}*/
	}
?>