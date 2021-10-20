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
        }
        article h2 {
            font-size: 13pt;
            color: #888888;
            margin: 0px;
        }
        article{
            margin-bottom: 800px;
        }
        img.img-direita{
            display: block;
            float: right;
            margin-left: 5px;
        }
        form{
            font-size: 13pt;
        }

        input{
            font-size: 13pt;
        }
        select{
            font-size: 13pt;
        }
        fieldset{
            font-size: 13pt;
        }

        div#botoes{
            width: 300px;
            margin: 0 auto;
        }
        iframe#TabelaTestes {
            width: 1080px;
            height: 500px;
            overflow-x: scroll !important;
            overflow-y: scroll !important;
        }
        article#inicio{
            padding-left: 90px;
        }

    iframe#TabelaTestes::-webkit-scrollba {
        display: yes;
    }
    iframe#tabela_metodos {
        width: 1080px;
        height: 200px;
        overflow-x: scroll !important;
        overflow-y: scroll !important;
    }
    
    iframe#tabela_metodos::-webkit-scrollba {
    display: yes;
    }

    </style>
</head>
<body>
    <article id="inicio">
        <div id=tabela>
            <iframe src="_amostrastabela.php" name="janela" scrolling="yes" id="TabelaTestes" >
            </iframe>    
        </div>
    </article>


    <article id="precadastroamostra">
        <header>
            <h1>Pré-cadastro Amostra</h1>  
            <h2>Pré-cadastro de uma  nova amostra:</h2>

            <form method="POST" id="fNovaAmostra" name="cNovaAmostra">
                <br>
                <fieldset id="precadastro">
                    <legend>Pré cadastro amostra:</legend>

                    <p><label >Cliente:</label>
                    
                    <select name="tCliente" id="cCliente" style="width:750px" required onchange="selecionado()"> 
                    <option value=""></option>
                    <?php 
                    
                        $sql = "SELECT CodCliente, RazaoSocial FROM cliente";
	                    $query = Mysql::conectar()->prepare($sql);
                        $query->execute();

                        foreach($query as $dados){ 
                    ?> 
                        <option value="<?php echo $dados['CodCliente']; ?>"><?php echo $dados['RazaoSocial']; ?></option> <?php } ?> 
                    </select>


                        <label for="cIdCliente"> ID cliente:</label><input type="text" name="tIdCliente" id="cIdCliente" size="20" maxlength="20"/></p>
                        <p><label for="cNovaAmostra"> Nova Amostra:</label><input type="text" name="tNovaAmostra" id="cNovaAmostra" size="70" maxlength="70" required/></p>
                        </fieldset>
                        <br>

                        <div><input type="hidden" name="form" value="f_form"/></div>
                         <p id="botoes"><div id="botoes"><input type="submit" id="cSalvar" name="tSalvar" onclick="validar()"/>
                        <input type="reset" name="limpar2" value="Limpar"/></div></p>
                
                
                    <script>
                        function selecionado() {
                            var x = document.getElementById("cCliente").value;
                            document.getElementById("cIdCliente").value = x;
                        }
                    </script>
                </fieldset>
            </form>
                
            <?php
                    if(isset($_POST['tSalvar']) && isset($_POST['form'])== "f_form"){
                        $IdCliente = (int)$_POST['tIdCliente'];
                        $NovaAmostra = $_POST['tNovaAmostra'];

                            $query = "INSERT INTO amostra  (NomeAmostra, CodCliente) VALUES (?,?)";
                            $sql = Mysql::conectar()->prepare($query);
                            $sql->execute(array($NovaAmostra, $IdCliente));
                            echo "amostra cadastrada";
                            return TRUE;
                    }
                ?>
            
        </header>
    </article>

    <article id="AtribuirExames">

        <header>
            <h1>Atribuir exame</h1>
            <br>
            <h2>Cadastrar exame/teste para uma amostra já cadastrada</h2>
            <br>
                
        <form action="" method="POST">  
        <fieldset id="abribuirexame">      
			<p><label>Nome do Cliente:</label>
			<select name="id_categoria" id="id_categoria" style="width:750px" required onchange="Cliente()">
				<option value="">Selecione um cliente...</option>
				<?php
					$sql = "SELECT CodCliente, RazaoSocial FROM cliente";
					$query = Mysql::conectar()->prepare($sql);
					$query->execute();

					foreach($query as $dados){ 
				?> 
					<option value="<?php echo $dados['CodCliente']; ?>"><?php echo $dados['RazaoSocial']; ?></option> <?php } ?> 
				</select>
                <label for="IdCliente"> ID cliente:</label><input type="text" name="IdCliente" id="IdCliente" size="10" maxlength="10" disabled=""/></p>
			
			<p><label>Nome da Amostra:</label>
			<span class="carregando">Aguarde, carregando...</span>
			<select name="id_sub_categoria" id="id_sub_categoria" style="width:740px" required onchange="Amostra()">
				<option value="">Escolha uma amostra...</option>
			</select>
            <label for="id_amostra"> ID Amostra:</label><input type="text" name="id_amostra" id="id_amostra" size="9" maxlength="9" disabled=""/></p>

            <p><label>Exame/Método:</label>
			<select name="_exame" id="_exame" style="width:750px" required required onchange="Exame()">
				<option value="">Selecione um método...</option>
				<?php
					$sql = "SELECT CodMetodo, NomeMet FROM metodo";
					$query = Mysql::conectar()->prepare($sql);
					$query->execute();

					foreach($query as $dados){ 
				?> 
					<option value="<?php echo $dados['CodMetodo']; ?>"><?php echo $dados['NomeMet']; ?></option> <?php } ?> 
				</select>
                <label for="id_exame"> ID cliente:</label><input type="text" name="id_exame" id="id_exame" size="10" maxlength="10" disabled=""/></p>
                <p>
                    <label for="NumContrato"> Número Contrato:</label><input type="text" name="NumContrato" id="NumContrato" size="20" maxlength="10" required/>
                    <label for="Concetracao"> Concetração Composto:</label><input type="text" name="Concetracao" id="Concetracao" size="30" maxlength="30" required/>
                </p>
                <p>
                    <label for="TemExposicao"> Tempo de Exposição:</label><input type="text" name="TemExposicao" id="TemExposicao" size="20" maxlength="10" required/>
                    <label for="ObsExame">Observação:<textarea type="text" name="ObsExame" id="ObsExame" cols="50" rows="5" maxlength="255" placeholder="Descreva observação se necessário (limite de 255 caracteres)."></textarea>
                </p>
	
                <br><p id="botoes"><div id="botoes"><input type="submit" name="EnviarExame" id="EnviarExame" value="Salvar">
                <input type="reset" name="limpar2" value="Limpar"/><div></p>
			
		</form>
		</fieldset>
		
		<script type="text/javascript" src="_codigos/jquery.min.js"></script>
		
		<script type="text/javascript">
            // seleção da amostra
            $(function(){
                $('#id_categoria').change(function(){
                    if( $(this).val() ) {
                        $('#id_sub_categoria').hide();
                        $('.carregando').show();
                        $.getJSON('_codigos/sub_categorias.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
                            var options = '<option value="">Selecione um método...</option>';	
                            for (var i = 0; i < j.length; i++) {
                                options += '<option value="' + j[i].id + '">' + j[i].Nome + '</option>';
                            }	
                            $('#id_sub_categoria').html(options).show();
                            $('.carregando').hide();
                        });
                    } else {
                        $('#id_sub_categoria').html('<option value="">– Selecione um método... –</option>');
                    }
                });
            });
        </script>

        <script>
            function Cliente(){
                document.getElementById('IdCliente').value = document.getElementById('id_categoria').value; 
            }
            function Amostra(){
                document.getElementById('id_amostra').value = document.getElementById('id_sub_categoria').value; 
            }
            function Exame(){
                document.getElementById('id_exame').value = document.getElementById('_exame').value; 
            }
        </script>

        <?php
        // verificar e enviar o exame
        if(isset($_POST['EnviarExame'])){
            $Texto = "Preencha todos os campos!";
            if(isset($_POST['NumContrato'])){}else{echo $Texto; return; }
            if(isset($_POST['Concetracao'])){}else{echo $Texto; return;}
            if(isset($_POST['TemExposicao'])){}else{echo $Texto; return;}
            //if(isset($_POST['ObsExame'])){}else{echo $Texto; return;}
            if(isset($_POST['id_sub_categoria'])){}else{echo $Texto; return;}
            if(isset($_POST['_exame'])){}else{echo $Texto; return;}

            $NumeroContrato = $_POST['NumContrato'];
            //echo $_POST['NumContrato']. " <br> ";
            $Concentracao = $_POST['Concetracao'];
            //echo $_POST['Concetracao']. " <br> ";
            $TempoExposicao = $_POST['TemExposicao'];
            //echo $_POST['TemExposicao']. " <br> ";
            $ObsExame = $_POST['ObsExame'];
            //echo $_POST['ObsExame']. " <br> ";
            $CodAmostra = (int)$_POST['id_sub_categoria'];
            //echo (int)$_POST['id_sub_categoria']. " <br> ";
            $CodMetodo = (int)$_POST['_exame'];
            //echo (int)$_POST['_exame']. " <br> ";

           
            $query = "INSERT INTO exame  (NumeroContrato, Concentracao, TempoExposicao, Observacao, CodAmostra, CodMetodo) VALUES (?, ?, ?, ?, ?, ?)";
            $sql = Mysql::conectar()->prepare($query);
            $sql->execute(array($NumeroContrato, $Concentracao, $TempoExposicao, $ObsExame, $CodAmostra,$CodMetodo));
            echo "Exame criado com sucesso!";
            return TRUE;
            
        }
        ?>
        </header>
    </article>

    <article id="AlterarAmostra">

        <header>
            <h1>
                Alterar Amostra
            </h1>        
            <h2>
                adicionar campos de alteração
            </h2>        

             <fieldset id="login">
                <legend>Nova Amostra:</legend>
                
                    <p><label for="cLoginAdmin"> Cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="70" maxlength="100"/>
                    <label for="cLoginAdmin"> ID cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="20" maxlength="20"/></p>
                    <p><label for="cLoginAdmin"> Nome da Amostra:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="100" maxlength="100"/></p>
                    <p><label for="cSenhaAdmin"> Quantidade de Amostra:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="20" maxlength="30"/>
                    <label for="cEst">Temperatura de amarzenamento:</label><select name="tEst" id="cEst" style="width:150px;">
                            <option selected>Ambiente</option>
                            <option >2º a 8ºC</option>
                            <option>-20º a -30ºC</option>
                            <option>-70º a -80ºC</option>
                    </select></p>
                    <p><label for="cSenhaAdmin"> Formulação centesimal:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="40"/>
                    <label for="cSenhaAdmin"> Composto ativo:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="40" maxlength="100"/></p>
                    <p><label for="cSenhaAdmin"> Concentração princípio ativo:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="40"/>
                    Data de fabricação:<input type="date" nome="tNasc" id="cNasc" /></p>
                    <p><label for="cSenhaAdmin"> Lote:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="30"/>
                    <label for="cSenhaAdmin"> Responsável pelo cadastro:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="50" maxlength="70"/>
                    </p>
            </fieldset>

        </header>
        <p>
            colocar texto aqui
        </p>        
    </article>

    
    <article id="Exames">
        <div id=tabela>
            <iframe src="_examestabela.php" name="janela" scrolling="yes" id="TabelaTestes" >
            </iframe>    
        </div>
    </article>

    <article id="NovoMetodo">
    <header>
            <h1>Novo Método</h1>  
            <h2>Cadastro de um novo método de análise:</h2>

            <form method="POST" id="fNovoMetodo" name="cNovoMetodo" onsubmit="EnviarMetodo()">
                <br>
                <fieldset id="NovoMetodo">
                    <legend>Cadastro de novo método:</legend>
                    <p><label for="cMetodo"> Novo método:</label><input type="text" name="tMetodo" id="cMetodo" size="100" maxlength="100" required/></p>
                    <p><label for="cObsmetodo">Observação:</label>
                    <textarea type="text" name="tObsmetodo" id="cObsmetodo" cols="80" rows="5" maxlength="255" placeholder="Descreva o método (limite de 255 caracteres)." required></textarea></p>

                    <p><div><input type="hidden" name="tformMetodo" id="cformMetodo" value="0"/></div>
                    <div id="botoes"><input type="submit" name="fEnviar" value="Salvar"/>
                    <input type="reset" name="fLimpar" value="Limpar"/></div></p>
                </fieldset>

            </form>	
            <script>
            function EnviarMetodo(){
                    document.getElementById("cformMetodo").value = "1";
            }
        </script>
            <?php
            
            if(isset($_POST['tformMetodo'])){
                if($_POST['tformMetodo'] == "1"){
                // session_start();
                try{

                    $NovoMetodo = $_POST['tMetodo'];
                    $Observacao = $_POST['tObsmetodo'];

                    $query = "INSERT INTO metodo (NomeMet, ObsMet) VALUES (?,?)";
                    $sql = Mysql::conectar()->prepare($query);
                    $sql->execute(array($NovoMetodo, $Observacao));
                    echo "Novo método cadastrado!";
                    return TRUE;
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                }
            }
            ?>
        <br><br>
        <div id=tabela>
            <iframe id="tabela_metodos" src="_tabela_metodos.php" name="janela" scrolling="yes" id="TabelaTestes" >
            </iframe>    
        </div>
        
        </header>
    </article>               
</body>
</html>