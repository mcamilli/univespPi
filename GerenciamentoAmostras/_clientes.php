<?php
	header('Content-Type: text/html; charset=utf-8');
    include('_codigos/classes.php');
    include('_codigos/mysql.php');

    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true && $_SESSION["PermissaoAdmin"][0]== true){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:_codigos/logout.php');
    }
?>

<!DOCTYPE html>

<html>
<head>
<meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pesquisar</title>
		<style type="text/css">
			.carregando{
				color:#ff0000;
				display:none;
			}
		</style>
    <title>Gerenciamento de Amostras</title>
    <style>
        body{
            font-family: Arial;
            font-size: 10pt;
            overflow: hidden !important;
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
            width: 84%;
        }
        article h2 {
            font-size: 13pt;
            color: #888888;
            margin: 0px;
        }
        article{
            margin-bottom: 800px;
            width: 94%;
        }

        img.img-direita{
            display: block;
            float: right;
            margin-left: 5px;
        }
        form{
            font-size: 13pt;
            width: 84%;
            height: 600px;

        }
        fieldset{
            font-size: 13pt;
        }
        input{
            font-size: 13pt;
        }
        select{
            font-size: 13pt;
        }
        div#botoes{
            width: 300px;
            margin: 0 auto;
        }
        
        iframe#TabelaClientes {
            width: 75%;
            height: 600px;
            overflow-x: scroll !important;
            overflow-y: scroll !important;
        }
        article#inicio{
            padding-left: 90px;
        }

     iframe#TabelaClientes::-webkit-scrollba {
        display: yes;
    }

    </style>
</head>
<body>
    <article id="inicio">
        <div id=tabela>
            <iframe src="_clientestabela.php" name="janela" scrolling="yes" id="TabelaClientes" >
            </iframe>    
        </div>
    </article>

    <article id="NovoCliente">
        <header>
            <h1>Novo cliente</h1>  
            <br>
            <h2>Cadastrar um novo cliente:</h2>
            <br>
            <form method="POST" id="fNovoCliente" name="cNovoCliente" onsubmit="Enviar()";>
            <fieldset id="Cliente">
                <legend>Novo Cliente</legend>
                
                    <p><label for="cRazaoSocial"> Razão Social:</label><input type="text" name="tRazaoSocial" id="cRazaoSocial" size="70" maxlength="100" required/>
                    <label for="cCnpj"> CNPj:</label><input type="text" name="tCnpj" id="cCnpj" size="16" maxlength="16" required/></p>
                    <p><label for="cNomeFantasia"> Nome Fantasia:</label><input type="text" name="tNomeFantasia" id="cNomeFantasia" size="70" maxlength="100"/>
                    </p>
                    <p><label for="cEmail"> Email:</label><input type="text" name="tEmail" id="cEmail" size="40" maxlength="100" placeholder="Ex. joao.francisco@gmail.com" required/>
                    <label for="cFone1"> Telefone 1:</label><input type="text" name="tFone1" id="cFone1" size="16" maxlength="16"placeholder="Ex. 14 98133-2222" required/>
                    <label for="cFone2"> Telefone 2:</label><input type="text" name="tFone2" id="cFone2" size="16" maxlength="16" placeholder="Ex. 14 98133-2222"/></p>
                    <p><label for="cObs"> Observação:</label><input type="text" name="tObs" id="cObs" size="100" maxlength="255"/></p>
            </fieldset>
            <br>
            <fieldset id="Endereco">
                <legend>Endereço</legend>
                    <p><label for="cLogra"> Logradouro:</label><input type="text" name="tLogra" id="cLogra" size="50" maxlength="100" placeholder="Ex. Rua Manoel da Silva" required/>
                    <label for="cNum"> Número:</label><input type="text" name="tNum" id="cNum" size="7" maxlength="11" placeholder="Ex. 12" required/>
                    <label for="cCep"> CEP:</label><input type="text" name="tCep" id="cCep" size="30" maxlength="40" placeholder="Ex: São Paulo" required/></p>
                    <p><label for="cCidade"> Cidade:</label><input type="text" name="tCidade" id="cCidade" size="30" maxlength="40" placeholder="Ex: São Paulo" required/>
                    <label for="cEstado"> Estado:</label><input type="text" name="tEstado" id="cEstado" size="30" maxlength="40" placeholder="Ex: São Paulo" required/>
                    <label for="cPais"> País:</label><input type="text" name="tPais" id="cPais" size="30" maxlength="40" placeholder="Ex: Brasil" required/></P>
                    </p>
            </fieldset>
            <br>
            <fieldset id="Login">
                <legend>Login</legend>
                    <p><label for="cLogin"> Login:</label><input type="text" name="tLogin" id="cLogin" size="30" maxlength="40" placeholder="Ex: thermofisher" required/>
                    <label for="cSenha"> Senha:</label><input type="text" name="tSenha" id="cSenha" size="8" maxlength="8" required/>
                    <label for="cSenhaNovamente"> Repetir:</label><input type="text" name="tSenhaNovamente" id="cSenhaNovamente" size="8" maxlength="8" required/></p>
                    <div id="botoes">Verificar login e senha:<input type="submit" name="verificar" value="Verificar"/></div></p>
                    <p><div><input type="hidden" name="tValidaLogin" id="cValidaLogin" value=false/></div>
            </fieldset>

            <p><div><input type="hidden" name="tform" id="cform" value="0"/></div>
            <div id="botoes"><input type="submit" name="acao" value="Salvar"/>
            <input type="reset" name="limpar" value="Limpar"/></div></p>

        </form>	
        <script>
            function Enviar(){
                
                
                    document.getElementById("cform").value = "1";
            }
        </script>

      <P>  <?php
            
            if(isset($_POST['tform'])){
                if($_POST['tform'] == "1"){
                // session_start();
                try{
                    $razao = $_POST['tRazaoSocial'];
                    $cNomeFantasia = $_POST['tNomeFantasia'];
                    $cCnpj = $_POST['tCnpj'];
                    $cEmail = $_POST['tEmail'];
                    $cLogra = $_POST['tLogra'];
                    $cNum = $_POST['tNum'];
                    $cCidade = $_POST['tCidade'];
                    $cEstado = $_POST['tEstado'];
                    $cPais = $_POST['tPais'];
                    $cCep = $_POST['tCep'];
                    $cFone1 = $_POST['tFone1'];
                    $cFone2 = $_POST['tFone2'];
                    $cLogin = $_POST['tLogin'];
                    $cSenha = md5($_POST['tSenha']);
                    $cObs = $_POST['tObs'];
                    $DataCadastro = date('y/m/d');
                    //session_start();
                    $CodAdmin = (int)$_SESSION["usuario"][4];

                    $query = "INSERT INTO cliente (RazaoSocial, NomeFantasia, CNPj, Email, Endereco, Numero, 
                    Cidade, Estado, Pais, CEP, Telefone1, Telefone2, Usuario, Senha, Observacao, DataCadastro, 
                    CodAdmin) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                    $sql = Mysql::conectar()->prepare($query);
                    $sql->execute(array($razao,	$cNomeFantasia,	$cCnpj,	$cEmail, $cLogra, $cNum, $cCidade,
                    $cEstado, $cPais, $cCep, $cFone1, $cFone2, $cLogin, $cSenha, $cObs,	$DataCadastro, 
                    $CodAdmin));
                    echo "amostra cadastrada";
                    return TRUE;
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
        }

            ?></P>


        </header>
    </article>


    <article id="AlterarCliente">

        <header>
            <h1>
                Alterar Cliente
            </h1>
            <br>
            <h2>
                Alterar/atualizar registro de um cliente
            </h2>        
            <br>
             <form method="POST" id="fAtualizarCliente" name="cAtualizarCliente">
            <fieldset id="Cliente">
                <legend>Novo Cliente</legend>
                
                    <p><label for="cRazaoSocial"> Razão Social:</label><input type="text" name="tRazaoSocial" id="cRazaoSocial" size="70" maxlength="100"/>
                    <label for="cCnpj"> CNPj:</label><input type="text" name="tCnpj" id="cCnpj" size="16" maxlength="16"/></p>
                    <p><label for="cNomeFantasia"> Nome Fantasia:</label><input type="text" name="tNomeFantasia" id="cNomeFantasia" size="70" maxlength="100"/>
                    </p>
                    <p><label for="cEmail"> Email:</label><input type="text" name="tEmail" id="cEmail" size="40" maxlength="100" placeholder="Ex. joao.francisco@gmail.com"/>
                    <label for="cFone1"> Telefone 1:</label><input type="text" name="tFone1" id="cFone1" size="16" maxlength="16"placeholder="Ex. 14 98133-2222"/>
                    <label for="cFone2"> Telefone 2:</label><input type="text" name="tFone2" id="cFone2" size="16" maxlength="16" placeholder="Ex. 14 98133-2222"/></p>
                    <p><label for="cObs"> Observação:</label><input type="text" name="tObs" id="cObs" size="100" maxlength="255"/></p>
            </fieldset>
            <br>
            <fieldset id="Endereco">
                <legend>Endereço</legend>
                    <p><label for="cLogra"> Logradouro:</label><input type="text" name="tLogra" id="cLogra" size="50" maxlength="100" placeholder="Ex. Rua Manoel da Silva"/>
                    <label for="cNum"> Número:</label><input type="text" name="tNum" id="cNum" size="7" maxlength="11" placeholder="Ex. 12"/>
                    <label for="cCep"> CEP:</label><input type="text" name="tCep" id="cCep" size="30" maxlength="40" placeholder="Ex: São Paulo"/></p>
                    <p><label for="cCidade"> Cidade:</label><input type="text" name="tCidade" id="cCidade" size="30" maxlength="40" placeholder="Ex: São Paulo"/>
                    <label for="cEstado"> Estado:</label><input type="text" name="tEstado" id="cEstado" size="30" maxlength="40" placeholder="Ex: São Paulo"/>
                    <label for="cPais"> País:</label><input type="text" name="tPais" id="cPais" size="30" maxlength="40" placeholder="Ex: Brasil"/></P>
                    </p>
            </fieldset>
            <br>
            <fieldset id="Login">
                <legend>Login</legend>
                    <p><label for="cLogin"> Login:</label><input type="text" name="tLogin" id="cLogin" size="30" maxlength="40" placeholder="Ex: thermofisher"/>
                    <label for="cSigla"> Sigla:</label><input type="text" name="tSigla" id="cSigla" size="5" maxlength="3" placeholder="Ex: TMF"/>
                    <label for="cSenha"> Senha:</label><input type="text" name="tSenha" id="cSenha" size="8" maxlength="8"/>
                    <label for="cSenhaNovamente"> Repetir:</label><input type="text" name="tSenhaNovamente" id="cSenhaNovamente" size="8" maxlength="8"/></p>
                    <div id="botoes">Verificar login e senha:<input type="submit" name="verificar" value="Verificar"/></div></p>
            </fieldset>

            <p><div><input type="hidden" name="form" value="f_form"/></div>
            <div id="botoes"><input type="submit" name="acao" value="Salvar"/>
            <input type="submit" name="limpar" value="Limpar"/></div></p>

            <script> document.getElementById("fNovoCliente").reset();</script>
        </form>	

        </header>
       
    </article>

</body>
</html>