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
            width: 1300px;
            height: 500px;
            overflow-x: scroll !important;
            overflow-y: scroll !important;
            border: 1px;
            overflow: hidden;
        }
        article#inicio{
            padding-left: 90px;
        }

    iframe#TabelaTestes::-webkit-scrollba {
        display: yes;
    }
    iframe#Tabela_exames {
        width: 1000px;
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


                        <label for="cIdCliente"> ID cliente:</label><input type="text" name="tIdCliente" id="cIdCliente" size="20" maxlength="20" disabled=""/></p>
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
			<select name="_exame" id="_exame" style="width:750px" required onchange="Exame()">
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
                <br>
                Alterar Amostra
            </h1>        
            <h2>
                <br>
                
            </h2>        

            <form action="" method="POST">  
        <fieldset id="_AlterarAmostra">      
			<p><label>Nome do Cliente:</label>
			<select name="id_categoria_2" id="id_categoria_2" style="width:750px" required onchange="Cliente2()">
				<option value="">Selecione um cliente...</option>
				<?php
					$sql = "SELECT CodCliente, RazaoSocial FROM cliente";
					$query = Mysql::conectar()->prepare($sql);
					$query->execute();

					foreach($query as $dados){ 
				?> 
					<option value="<?php echo $dados['CodCliente']; ?>"><?php echo $dados['RazaoSocial']; ?></option> <?php } ?> 
				</select>
                <label for="IdCliente_2"> ID cliente:</label><input type="text" name="IdCliente_2" id="IdCliente_2" size="10" maxlength="10" disabled=""/></p>
			
			<p><label>Nome da Amostra:</label>
			<span class="carregando">Aguarde, carregando...</span>
			<select name="id_sub_categoria_2" id="id_sub_categoria_2" style="width:740px" required onchange="Amostra2()">
				<option value="">Escolha uma amostra...</option>
			</select>
            <label for="id_amostra_2"> ID Amostra:</label><input type="text" name="id_amostra_2" id="id_amostra_2" size="9" maxlength="9" disabled=""/></p>

            
                <p><label for="Atr_PrincipioAtivo_2"> Princípio Ativo:</label><input type="text" name="Atr_PrincipioAtivo_2" id="Atr_PrincipioAtivo_2" size="70" maxlength="70" disabled="" required/>
                            <label for="Atr_LoteProduto_2"> Lote:</label><input type="text" name="Atr_LoteProduto_2" id="Atr_LoteProduto_2" size="27" maxlength="27" disabled="" required/>
                            </p>
                            
                            <p><label for="Atr_dateFrom_2">Data Fabricação:<input type="date" name="Atr_dateFrom_2" id="Atr_dateFrom_2"  disabled="" required/>
                            

                            <label for="Atr_Armazenamento_2">Temperatura de Armazenamento:</label><select name="Atr_Armazenamento_2" id="Atr_Armazenamento_2" disabled="" required>
                                <option>selecione...</option>
                                <option>temp. ambiente</option>
                                <option>4ºC</option>
                                <option>-20ºC</option>
                                <option>-80ºC</option>
                            </select>
                            <label for="Atr_QtdAmostra_2"> Qtd. Amostra:</label><input type="text" name="Atr_QtdAmostra_2" id="Atr_QtdAmostra_2" size="28" maxlength="28"  disabled="" required/>
                            </p>
                            <p>
                            <label for="Atr_ConcetracaoAtivo_2"> Concetração princípio Ativo:</label><input type="text" name="Atr_ConcetracaoAtivo_2" id="Atr_ConcetracaoAtivo_2" size="27" maxlength="27" disabled="" required/>
                            <label for="Atr_FormCentesimal_2"> Fórmula Centesimal:</label><input type="text" name="Atr_FormCentesimal_2" id="Atr_FormCentesimal_2" size="27" maxlength="27" disabled="" required/>
                            </p>
                            <p><p><label for="Atr_ResponsavelEnvio_2"> Responável pelo envio:</label><input type="text" name="Atr_ResponsavelEnvio_2" id="Atr_ResponsavelEnvio_2" size="70" maxlength="70" disabled="" required/>
                            </p>
                            <p>
                            <label for="Atr_Men_2">Observação:</label>
                            <textarea nome="Atr_ObsAmostra_2" id="Atr_ObsAmostra_2" name="Atr_ObsAmostra_2" cols="60" rows="5" disabled=""></textarea>
                            </p>
                            </fieldset>
                            <br>
	
                

                <div><input type="hidden" name="Atr_form" value="f_form"/></div>
                <p id="botoes"><div id="botoes">
                    <input type="button" id="Atr_editar" name="Atr_editar" value="Editar" disabled=""  onclick="habilitar2()"/>
                    <input type="submit" id="Atr_Salvar" name="Atr_Salvar"  value="Salvar" disabled="" onclick="validar()"/>
                    <input type="reset" name="limpar2" value="Limpar" onclick="desabilitarbotoes()"/></div></p>

                    
                            
			
		</form>
		</fieldset>

        <script type="text/javascript">
                function clicou2(){
                    alert ("chamou");
 
                    <?php 
                        if(isset($_POST['id_sub_categoria_2']) && $_POST['id_sub_categoria_2'] !== 0) {
                        $AmostaSelecionada = (int)$_POST['id_sub_categoria_2'];
                        $sql = "SELECT * FROM amostra WHERE CodAmostra = $AmostaSelecionada";
                        $query = Mysql::conectar()->prepare($sql);
                        $query->execute();
                        }
                    ?>

                    document.getElementById('Atr_PrincipioAtivo_2').value = "teste";

                    /*document.getElementById('Atr_PrincipioAtivo_2').value = "<?php echo $dados['PrincipioAtivo'];?>";
                    /*document.getElementById('Atr_LoteProduto_2').value = "<?php echo $dados['LoteProduto'];?>";
                    document.getElementById('Atr_dateFrom_2').value = "<?php echo $dados['DataFabricacao'];?>";
                    document.getElementById('Atr_Armazenamento_2').value = "<?php echo $dados['Armazenamento'];?>";
                    document.getElementById('Atr_QtdAmostra_2').value = "<?php echo $dados['QtdAmostra'];?>";
                    document.getElementById('Atr_ConcetracaoAtivo_2').value = "<?php echo $dados['ConcetracaoAtivo'];?>";
                    document.getElementById('Atr_FormCentesimal_2').value = "<?php echo $dados['FormCentesimal'];?>";
                    document.getElementById('Atr_ResponsavelEnvio_2').value = "<?php echo $dados['ResponsavelEnvio'];?>";
                    document.getElementById('Atr_ObsAmostra_2').value = "<?php echo $dados['ObsAmostra'];?>";
                    document.getElementById('Atr_editar_2').disabled = false;
                    
                    if(document.getElementById('id_sub_categoria_2').value == 0){
                        document.getElementById('Atr_editar_2').disabled = true;
                        limpar2();
                    }*/
                }
                </script>

		
		<script type="text/javascript" src="_codigos/jquery.min.js"></script>
		
		<script type="text/javascript">
            // seleção da amostra
            $(function(){
                $('#id_categoria_2').change(function(){
                    if( $(this).val() ) {
                        $('#id_sub_categoria_2').hide();
                        $('.carregando').show();
                        $.getJSON('_codigos/sub_categorias.php?search=',{id_categoria: $(this).val(), ajax: 'true'}, function(j){
                            var options = '<option value="">Selecione um método...</option>';	
                            for (var i = 0; i < j.length; i++) {
                                options += '<option value="' + j[i].id + '">' + j[i].Nome + '</option>';
                            }	
                            $('#id_sub_categoria_2').html(options).show();
                            $('.carregando').hide();
                        });
                    } else {
                        $('#id_sub_categoria_2').html('<option value="">– Selecione um método... –</option>');
                    }
                });
            });
        </script>

        <script>
            function Cliente2(){
                document.getElementById('IdCliente_2').value = document.getElementById('id_categoria_2').value; 
            }
            function Amostra2(){
                document.getElementById('id_amostra_2').value = document.getElementById('id_sub_categoria_2').value;
                selecionado2();

            }
            function Exame2(){
                document.getElementById('id_exame_2').value = document.getElementById('_exame_2').value; 
            }
            
            function selecionado2() {
                alert ("chamou  selecionado2");
                var x = document.getElementById("id_sub_categoria_2").value;
                document.getElementById("id_amostra_2").value = x;
                clicou2();
            }
                    
        </script>

        <?php
        // verificar e enviar o exame
        if(isset($_POST['EnviarExame'])){
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

    
    <article id="Exames">
        <div id=tabela>
            <iframe src="_examestabela.php" name="janela" scrolling="yes" id="TabelaTestes" >
            </iframe>    
        </div>
    </article>

    <article id="NovoMetodo">
    <header>
            <h1>Novo Método</h1>  
            <br>
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
            <iframe src="_tabela_metodos.php" name="janela" scrolling="yes" id="Tabela_exames" >
            </iframe>    
        </div>
        
        </header>
    </article>               
</body>
</html>