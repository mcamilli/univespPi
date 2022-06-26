<?php
	header('Content-Type: text/html; charset=utf-8');
    include('_codigos/classes.php');
    include('_codigos/mysql.php');
    include('_codigos/conexao.php');
    
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
        /*overflow: hidden !important;*/
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
        width: 94%;
    }
    article h2 {
        font-size: 13pt;
        color: #888888;
        margin: 0px;
    }
    article{
            margin-bottom: 800px;
            width: 84%;
    }

    form{
        font-size: 13pt;
        width: 94%;
    }

    input{
        font-size: 13pt;
    }
    select{
        font-size: 13pt;
    }
    fieldset{
        font-size: 12pt;
    }

    div#botoes{
        width: 300px;
        margin: 0 auto;
    }

    article#inicio{
        padding-left: 90px;
    }

    iframe#Andamento_tabela::-webkit-scrollba {
        display: yes !important;
    }
    iframe#Andamento_tabela {
        width: 95%;
        height: 200px;
        overflow-x: scroll !important;
        overflow-y: scroll !important;
    }
    
    iframe#Andamento_tabela::-webkit-scrollba {
    display: yes !important;
    }

    </style>
</head>
<body>

    <article id="Andamento">

        <header>
            <h1>Andamento dos exames</h1>
            <br>
            <h2>Modificar andamento dos exames atribuídos</h2>
            <br>
            <iframe src="_andamento_tabela.php" name="janela" scrolling="yes" id="Andamento_tabela" style="border: 1px solid black;">
            </iframe>

            <br>

                
        <form name="andamento_alterer" action="" method="POST">  
        <br>    
        <fieldset id="alterarexame"> 
                <legend>Alterar andamento:</legend>     
                
                <p><label for="_id_exame"> Insira o ID Exame:</label><input type="text" name="_id_exame" id="_id_exame" size="9" maxlength="9" required/>
                <label for="_pegar_amostra"><input type="submit" id="_pegar_amostra" name="_pegar_amostra" value="Localizar" onclick="Pegar_exame()"/></p>
                <br>
                <p><label for="_cliente"> Cliente:</label><input type="text" name="_cliente" id="_cliente" size="80" maxlength="80" disabled/></p>
                <p><label for="_amostra"> Amostra:</label><input type="text" name="_amostra" id="_amostra" size="79" maxlength="80" disabled/></p>
                <p><label for="_exame"> Exame:</label><input type="text" name="_exame" id="_exame" size="80" maxlength="80" disabled/></p>
                <p><label>Situação do exame:</label>
                <select name="_status" id="_status" style="width:200px" required onchange="Status()" disabled>
				<option value="0"></option>
				
					<option value="1">Em andamento</option>
                    <option value="2">Finalizado</option>
				</select></p>
                
                <p id="botoes"><div id="botoes">
                    <input type="hidden" name="_encontrado" id="_encontrado" value="0">
                    <input type="hidden" name="_habilitado" id="_habilitado" value="0">
                    <input type="submit" id="cSalvar" name="cSalvar" value="Salvar" disabled onclick="Enviar()"/>
                    <input type="reset" name="limpar" value="Limpar"/></div></p>


            </fieldset>
        </form>

            
        <script>
            function Pegar_exame(){
                document.getElementById('_encontrado').value = "1"; 
             
                
            }
            
            function Enviar(){           
                document.getElementById('_habilitado').value = "1"; 
            }
            function Status(){

                if(document.getElementById('_status').value != "0"){
                document.andamento_alterer.cSalvar.disabled = false;
            } 
            }
            
        </script>

        <?php
            
            if(isset($_POST['_encontrado']) || isset($_POST['_encontrado']) ){
            if($_POST['_encontrado'] == 1 || $_POST['_encontrado'] == 1 || isset($_POST['_id_exame']) ){
                try{

                    $exame = (int)$_POST['_id_exame'];
                    date_default_timezone_set('America/Sao_Paulo');

                    $DataHoje = date('Y-m-d G:i:s', time());

                    if(isset($_POST['_status'])){
                        if($_POST['_status'] == "1"){ // "1">Em andamento
           
                            $query = " UPDATE exame SET ExameIniciado = ? WHERE CodExame = ?";
                            $sql = Mysql::conectar()->prepare($query);
                            $sql->execute(array($DataHoje, $exame));
                            echo "atualizado!";
                            return TRUE;
                            
                        }
                    }
                    if(isset($_POST['_status'])){
                        if($_POST['_status'] == "2"){ // "1">finalizado
                            
                            $query = " UPDATE exame SET ExameFinalizado = ? WHERE CodExame = ?";
                            $sql = Mysql::conectar()->prepare($query);
                            $sql->execute(array($DataHoje, $exame));
                            echo "atualizado!";
                            return TRUE;
                        }
                    }
                    
                }
                catch(Exception $e)
                {
                    echo '<script> alert("'. $e->getMessage().'"); </script>';
                }
                
            }
            }
            
            if(isset($_POST['_encontrado'])){
                if($_POST['_encontrado'] == "1"){
                    try{
                        $pesquisa = false;
                        $exame = (int)$_POST['_id_exame'];

                        $sql = "SELECT c.RazaoSocial as Cliente, c.CodCliente as IdCliente, a.NomeAmostra as Amostra, a.CodAmostra as IdAmostra, m.NomeMet as Metodo, e.CodExame as IdExame FROM exame e INNER JOIN metodo m ON e.CodMetodo = m.CodMetodo INNER JOIN amostra a ON a.CodAmostra = e.CodAmostra INNER JOIN cliente c ON c.CodCliente = a.CodCliente WHERE e.CodExame = $exame;";

                        $query = Mysql::conectar()->prepare($sql);
                        $query->execute();
                
                        if($query->rowCount() == TRUE){
                            $pesquisa = true;
                        }else{
                            echo '<script> alert("ID de exame não encontrado!"); </script>';
                        }

                        if($pesquisa == true){
                            foreach($query as $dados){
                                echo "<script> document.getElementById('_cliente').value = '". $dados['Cliente']. "';</script>";
                                echo "<script> document.getElementById('_amostra').value = '". $dados['Amostra']. "';</script>";
                                echo "<script> document.getElementById('_exame').value = '". $dados['Metodo']. "';</script>";
                                echo "<script> document.getElementById('_id_exame').value = '". $dados['IdExame']. "';</script>";
                                echo "<script> document.andamento_alterer._status.disabled = false;</script>";
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                                    echo $e->getMessage();
                    }
                }
            }

        ?>

        
        </header>
    </article>

 </body>
</html>