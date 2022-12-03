<?php
    include('_codigos/classes.php');
    include('_codigos/mysql.php');
?>

<!DOCTYPE html>
<script language="javascript" src="_javascript/funcoes.js"></script>


<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Cadastro de amostra</title>
    <link rel="stylesheet" type="text/css" href="_css/login.css"/>

</head>

<body>

    <div id="interface">
        <header id="cabecalho">
            <hgroup>
                <h1>Acesso Usuário</h1>
            </hgroup>
        </header>

        <?php
            if(isset($_POST['tLogin']) && $_POST['LoginValida'] == 'f_login'){
                $login = $_POST['tNome'];
                $senha = $_POST['tSenha'];

                if($login == "" || $senha == ""){
                    echo '<div id="mensagem">Insira login e senha</div>';
                }else{
                   $sql = "SELECT NomeU, Cpf, EmailU, Permissao, CodAdmin FROM usuarioadm WHERE EmailU = ? AND SenhaU = ?";
		           $query = Mysql::conectar()->prepare($sql);
                   $query->execute(array($login, md5($senha)));

                        if($query->rowCount() == TRUE){
                                $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];
                                session_start();
                                $_SESSION['usuario'] = array($user["NomeU"], $user["Cpf"], $user["EmailU"], $user["Permissao"], $user["CodAdmin"]);
                                $_SESSION['PermissaoAdmin'] = array(true);

                                echo "<script>window.location = 'inicio.php'</script>";
                                echo "<script>window.location = '_codigos/logout.php'</script>";

			            }else{
                            try
                            {

                               $sql = "SELECT Usuario, CodCliente, RazaoSocial FROM cliente WHERE Usuario = ? AND Senha = ?";
		                       $query = Mysql::conectar()->prepare($sql);
                               $query->execute(array($login, md5($senha)));

                               if($query->rowCount() == TRUE){
                                   $user = $query->fetchAll(PDO::FETCH_ASSOC)[0];
                                    session_start();
                                    $_SESSION['usuario'] = array($user["Usuario"], $user["CodCliente"], $user["RazaoSocial"] );
                                    $_SESSION['PermissaoAdmin'] = array(False);
                                    echo "<script>window.location = '_usuario/iniciocliente.php'</script>";

                               }else{
                                    echo '<div id="mensagem">Login ou senha incorretos</div>';
                               }
                            }
                            catch(Exception $e)
                            {
                                echo $e->getMessage();
                            }

			            }
                }
            }
        ?>
        <div id="FormLogin">
        <form method="post" id="cLogin" name="tLogin">
            <fieldset id="usuario">
                <legend>Identificação do Usuário</legend>
                <p>
                    <label for="cNome">Login:</label><input type="text" name="tNome" id="cNome" size="30" maxlength="50" Completo" />
                </p>
                <p>
                    <label for="cSenha">Senha:</label> <input type="password" name="tSenha" id="cSenha" size="28" maxlength="8" />
                </p>

                
                <div id="RecuperarAdmin">
                    <p id="recuperar"> 
                        <input type="checkbox" name="tRecuperar" id="Recuperar" /> <label for="recuperar">Esqueceu a Senha?</label>
                    </p>
                </div>

                <div>
                    <p id="entrar">
                        <input type="hidden" name="LoginValida" value="f_login"/>
                    </p>

                </div>
                <div id="botoes" style="text-align:center" >
                    <button type="submit" style="font-size : 16px" name="tLogin"  id="cLogin" > Entrar </button>
                </div>


            </fieldset>
        </form>
        </div>


        <footer id="rodape">
            <p>
                Copyright&copy; <?php $Year = strftime("%Y"); echo $Year;?> - by Crop Biotec
                <br> <a href="http://facebook.com" target="_blank" /> Facebook | <a href="http://twitter.com" target="_blank" />Twitter
            </p>
        </footer>
    </div>
</body>
</html>