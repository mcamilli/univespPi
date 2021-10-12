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


        /* está funcionando
    try
    {
        //"SELECT * FROM tbmeseros LEFT JOIN tbrestaurantes ON tbmeseros.rest_mesero = tbrestaurantes.id_restaurante WHERE tbmeseros.cad_mesero = ?"
        //SELECT p.nome as produto, f.razao_social as fornecedor, c.descricao as categoria FROM produto p LEFT JOIN fornecedor f ON p.fornecedor=f.idfornecedor LEFT JOIN categoria c ON p.categoria=c.idcategoria ORDER BY 3
        
       $sql4 = "SELECT c.CodCliente, c.RazaoSocial, a.NomeAmostra, a.CodAmostra FROM amostra a JOIN cliente c ON c.CodCliente = a.CodCliente ORDER BY 2";
       //$sql4 = "SELECT * FROM cliente";
       $query4 = Mysql::conectar()->prepare($sql4);
       $query4->execute();

       foreach($query4 as $amostra){
        echo $amostra['CodCliente']. " - " ;
        echo $amostra['RazaoSocial']. " - ";
        echo $amostra['NomeAmostra']. " - ";
        echo $amostra['CodAmostra']. " - ";
    ?>

    <br>
 
    
    <?php
       }
       

 
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }*/

?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8"/>
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
    <article id="incio">

        <header>
       
            <h2>
                <br> início
            </h2>        
        </header>
        <p>
            colocar texto aqui
        </p>        
    </article>

    <article id="novo">
        <header>
            <h1>Cadastro amostra</h1>
            <br>
            <h2>Concluir cadastro de uma amostra</h2>
            <br>
            <form method="POST" id="fNovaAmostra" name="cNovaAmostra">
                <br>
                <fieldset id="precadastro">
                    <legend>Concluir cadastro de uma amostra:</legend>

                    <p><label >Amostra:</label>
                    
                    <select name="cAmostra" id="cAmostra" style="width:700px" onchange="selecionado()"> 
                    <option value="">Selecione uma amostra...</option>
                    <?php 
                        session_start();
                        $usuarioatual = (int) $_SESSION["usuario"][1];
                        $nulo = null;

                        $sql = "SELECT CodAmostra, NomeAmostra FROM amostra WHERE CodCliente = $usuarioatual AND DataCadastro IS NULL";
		                $query = Mysql::conectar()->prepare($sql);
                        $query->execute();

                        foreach($query as $dados){ 
                    ?> 
                        <option value="<?php echo $dados['CodAmostra']; ?>"><?php echo $dados['NomeAmostra']; ?></option> <?php } ?> 
                    </select>

                   

                        <label for="cIdAmostra"> ID Amostra:</label><input type="text" name="cIdAmostra" id="cIdAmostra" size="22" maxlength="23" value="" disabled=""/></p>
                        <p><label for="cPrincipioAtivo"> Princípio Ativo:</label><input type="text" name="cPrincipioAtivo" id="cPrincipioAtivo" size="70" maxlength="70" placeholder="e.g. cloreto de sódio; polietilenoglicol; 2-mercaptoetanol" disabled=""/>
                        <label for="cLoteProduto"> Lote:</label><input type="text" name="cLoteProduto" id="cLoteProduto" size="27" maxlength="27" disabled=""/>
                        </p>
                        
                        <p><label for="dateFabricacao">Data Fabricação:<input type="date" name="dateFrom" id="dateFrom"  disabled="" />
                        <br/>

                        <label for="tArmazenamento">Temperatura de Armazenamento:</label><select name="cArmazenamento" id="cArmazenamento" disabled="">
                            <option>selecione...</option>
                            <option>temp. ambiente</option>
                            <option>4ºC</option>
                            <option>-20ºC</option>
                            <option>-80ºC</option>
                        </select>
                        <label for="cQtdAmostra"> Qtd. Amostra:</label><input type="text" name="cQtdAmostra" id="cQtdAmostra" size="28" maxlength="28" placeholder="e.g. 100g, 10 peças (20cm x 20cm)" disabled=""/>
                        </p>
                        <p>
                        <label for="cConcetracaoAtivo"> Concetração princípio Ativo:</label><input type="text" name="cConcetracaoAtivo" id="cConcetracaoAtivo" size="27" maxlength="27" placeholder="e.g. 10mg/mL, 50ng/mL, 10%" disabled=""/>
                        <label for="cFormCentesimal"> Fórmula Centesimal:</label><input type="text" name="cFormCentesimal" id="cFormCentesimal" size="27" maxlength="27" placeholder="e.g. 10 ppm; 25 ppb" disabled=""/>
                        </p>
                        <p><p><label for="cResponsavelEnvio"> Responável pelo envio:</label><input type="text" name="cResponsavelEnvio" id="cResponsavelEnvio" size="70" maxlength="70" disabled=""/>
                        </p>
                        <p>
                        <label for="cMen">Observação:</label>
                        <textarea nome="cObsAmostra" id="cObsAmostra" name="cObsAmostra" cols="60" rows="5" placeholder="Se necessário, deixe uma observação" disabled=""></textarea>
                        </p>
                        </fieldset>
                        <br>

                        <div><input type="hidden" name="form" value="f_form"/></div>
                         <p id="botoes"><div id="botoes"><input type="submit" id="cSalvar" name="cSalvar"  disabled="" onclick="validar()"/>
                        <input type="reset" name="limpar2" value="Limpar"/></div></p>
                
                    <script>
                        function selecionado() {
                            var x = document.getElementById("cAmostra").value;
                            document.getElementById("cIdAmostra").value = x;
                            habilitar();
                        }
                    </script>
                </fieldset>
            </form>

        <script type="text/javascript">
            function habilitar(){
                if(document.getElementById('cAmostra').value == 0){
                    document.getElementById('cPrincipioAtivo').disabled = true;
                    document.getElementById('cLoteProduto').disabled = true;
                    document.getElementById('dateFrom').disabled = true;
                    document.getElementById('cArmazenamento').disabled = true;
                    document.getElementById('cQtdAmostra').disabled = true;
                    document.getElementById('cConcetracaoAtivo').disabled = true;
                    document.getElementById('cFormCentesimal').disabled = true;
                    document.getElementById('cResponsavelEnvio').disabled = true;
                    document.getElementById('cObsAmostra').disabled = true;
                    document.getElementById('cSalvar').disabled = true;
                    limpar();

                }
                if(document.getElementById('cAmostra').value != 0){
                    document.getElementById('cPrincipioAtivo').disabled = false;
                    document.getElementById('cLoteProduto').disabled = false;
                    document.getElementById('dateFrom').disabled = false;
                    document.getElementById('cArmazenamento').disabled = false;
                    document.getElementById('cQtdAmostra').disabled = false;
                    document.getElementById('cConcetracaoAtivo').disabled = false;
                    document.getElementById('cFormCentesimal').disabled = false;
                    document.getElementById('cResponsavelEnvio').disabled = false;
                    document.getElementById('cObsAmostra').disabled = false;
                    document.getElementById('cSalvar').disabled = false;
                }
            }
            function limpar(){
                    document.getElementById('cPrincipioAtivo').value = null;
                    document.getElementById('cLoteProduto').value = null;
                    document.getElementById('dateFrom').value = null;
                    document.getElementById('cArmazenamento').value = null;
                    document.getElementById('cQtdAmostra').value = null;
                    document.getElementById('cConcetracaoAtivo').value = null;
                    document.getElementById('cFormCentesimal').value = null;
                    document.getElementById('cResponsavelEnvio').value = null;
                    document.getElementById('cObsAmostra').value = null;
            }
        </script>
                
            
            <?php
                    if(isset($_POST['cSalvar']) && isset($_POST['form'])== "f_form"){
                       // $Cliente = $_POST['tCliente'];
                        //$IdCliente = (int)$_POST['tIdCliente'];
                        //$NovaAmostra = $_POST['tNovaAmostra'];
                        echo "teste update";

                        $IdAmostra = $_POST['cAmostra'];
                        $PrincipioAtivo; 
                        $LoteProduto;
                        $DataFabricacao = date('y/m/d', strtotime($_POST['dateFrom']));
                        $Armazenamento;
                        $QtdAmostra;
                        $ConcetracaoAtivo; 
                        $FormCentesimal;
                        $ResponsavelEnvio; 
                        $ObsAmostra;
                        $DataCadastro = date('y/m/d');


                        if(isset($_POST['cAmostra'])){$IdAmostra = (int)$_POST['cAmostra'];}
                        if(isset($_POST['cPrincipioAtivo'])){$PrincipioAtivo = $_POST['cPrincipioAtivo'];}
                        if(isset($_POST['cLoteProduto'])){$LoteProduto = $_POST['cLoteProduto'];}
                        if(isset($_POST['dateFabricacao'])){
                            $DataFabricacao = date('Y-m-d', strtotime($_POST['dateFrom']));
                            
                        }
                        if(isset($_POST['cArmazenamento'])){$Armazenamento = $_POST['cArmazenamento'];}
                        if(isset($_POST['cQtdAmostra'])){$QtdAmostra = $_POST['cQtdAmostra'];}
                        if(isset($_POST['cConcetracaoAtivo'])){$ConcetracaoAtivo = $_POST['cConcetracaoAtivo'];}
                        if(isset($_POST['cFormCentesimal'])){$FormCentesimal = $_POST['cFormCentesimal'];}
                        if(isset($_POST['cResponsavelEnvio'])){$ResponsavelEnvio = $_POST['cResponsavelEnvio'];}
                        if(isset($_POST['cObsAmostra'])){$ObsAmostra = $_POST['cObsAmostra'];}

                        $texto = "";
                        if($PrincipioAtivo == "") { 
                            if($texto == ""){
                                $texto = "Preencha o campo Princípio ativo";
                            }else{
                                $texto = $texto. "; Princípio ativo";
                            }
                        }
                        if($LoteProduto == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo Lote do produto";
                            }else{
                                $texto = $texto. "; Lote do produto";
                            }
                            
                        }
                        if($DataFabricacao == NULL) {
                            if($texto == ""){
                                $texto = "Preencha o campo Data de fabricação";
                            }else{
                                $texto = $texto. "; Data de fabricação";
                            }
                        }
                        if($Armazenamento == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo Armazenamento";
                            }else{
                                $texto = $texto. "; Amarzenamento";
                            }
                        }
                        if($QtdAmostra == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo Qtd. de amostra";
                            }else{
                                $texto = $texto. "; Qtd. de amostra";
                            }
                        }
                        if($ConcetracaoAtivo == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo Concentração princípio ativo";
                            }else{
                                $texto = $texto. "; Concentração princípio ativo";
                            }
                        }
                        if($FormCentesimal == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo fórmula centesimal";
                            }else{
                                $texto = $texto. "; fórmula centesimal";
                            }
                        }
                        if($ResponsavelEnvio == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo Responsável pelo envio";
                            }else{
                                $texto = $texto. "; Responsável pelo envio";
                            }
                        }
                        
                        if($texto !=  "")
                        {   
                            $texto = $texto. ".";
                            echo $texto;
                        }else{
                            
                            $query = "UPDATE amostra SET PrincipioAtivo = ?, LoteProduto = ?, DataFabricacao = ?, Armazenamento = ?, 
                            QtdAmostra = ?, ConcetracaoAtivo = ?, FormCentesimal = ?, ResponsavelEnvio = ?, ObsAmostra = ?, DataCadastro = ?
                            WHERE CodAmostra = ?";
                            
                            $sql = Mysql::conectar()->prepare($query);
                            
                            $sql->execute(array($PrincipioAtivo, $LoteProduto, $DataFabricacao, $Armazenamento, $QtdAmostra, $ConcetracaoAtivo, $FormCentesimal, $ResponsavelEnvio, $ObsAmostra, $DataCadastro, $IdAmostra));

                            echo "Os dados foram salvos!";
                            return TRUE;
                        }
                    }
                ?>
            
        </header>

    </article>


    <article id="alterar">

        <header>
                <h1>Alterar Registro</h1>
                <br>
                <h2>Alterar registro de uma amostra</h2>
                <br>
                <h3>Apenas amostras que ainda não foram recebidas pelo laboratório poderão ser alteradas.</h3>
                <form method="POST" id="fAlterar_Registro" name="Atr_Alterar_Registro">
                    <br>
                    <fieldset id="precadastro">
                        <legend>Concluir cadastro de uma amostra:</legend>

                        <p><label >Amostra:</label>
                        
                        <select name="Atr_Amostra" id="Atr_Amostra" style="width:700px" onchange="selecionado2()"> 
                        <option value="">Selecione uma amostra...</option>
                        <?php 
                            session_start();
                            $usuarioatual = (int) $_SESSION["usuario"][1];
                            //$nulo = null;

                            $sql = "SELECT * FROM amostra WHERE CodCliente = $usuarioatual AND DataCadastro IS NOT NULL AND DataRecebido IS NULL";
                            $query = Mysql::conectar()->prepare($sql);
                            $query->execute();

                            foreach($query as $dados){ 
                        ?> 
                            <option value="<?php echo $dados['CodAmostra']; ?>"><?php echo $dados['NomeAmostra']; ?></option> <?php } ?> 
                        </select>

                    

                            <label for="Atr_IdAmostra"> ID Amostra:</label><input type="text" name="Atr_IdAmostra" id="Atr_IdAmostra" size="22" maxlength="23" value="" disabled=""/></p>
                            <p><label for="Atr_PrincipioAtivo"> Princípio Ativo:</label><input type="text" name="Atr_PrincipioAtivo" id="Atr_PrincipioAtivo" size="70" maxlength="70" disabled=""/>
                            <label for="Atr_LoteProduto"> Lote:</label><input type="text" name="Atr_LoteProduto" id="Atr_LoteProduto" size="27" maxlength="27" disabled=""/>
                            </p>
                            
                            <p><label for="Atr_dateFrom">Data Fabricação:<input type="date" name="Atr_dateFrom" id="Atr_dateFrom"  disabled="" />
                            

                            <label for="Atr_Armazenamento">Temperatura de Armazenamento:</label><select name="Atr_Armazenamento" id="Atr_Armazenamento" disabled="">
                                <option>selecione...</option>
                                <option>temp. ambiente</option>
                                <option>4ºC</option>
                                <option>-20ºC</option>
                                <option>-80ºC</option>
                            </select>
                            <label for="Atr_QtdAmostra"> Qtd. Amostra:</label><input type="text" name="Atr_QtdAmostra" id="Atr_QtdAmostra" size="28" maxlength="28"  disabled=""/>
                            </p>
                            <p>
                            <label for="Atr_ConcetracaoAtivo"> Concetração princípio Ativo:</label><input type="text" name="Atr_ConcetracaoAtivo" id="Atr_ConcetracaoAtivo" size="27" maxlength="27" disabled=""/>
                            <label for="Atr_FormCentesimal"> Fórmula Centesimal:</label><input type="text" name="Atr_FormCentesimal" id="Atr_FormCentesimal" size="27" maxlength="27" disabled=""/>
                            </p>
                            <p><p><label for="Atr_ResponsavelEnvio"> Responável pelo envio:</label><input type="text" name="Atr_ResponsavelEnvio" id="Atr_ResponsavelEnvio" size="70" maxlength="70" disabled=""/>
                            </p>
                            <p>
                            <label for="Atr_Men">Observação:</label>
                            <textarea nome="Atr_ObsAmostra" id="Atr_ObsAmostra" name="Atr_ObsAmostra" cols="60" rows="5" disabled=""></textarea>
                            </p>
                            </fieldset>
                            <br>

                            <div><input type="hidden" name="form" value="f_form"/></div>
                            <p id="botoes"><div id="botoes"><input type="submit" id="Atr_Salvar" name="Atr_Salvar"  disabled="" onclick="validar()"/>
                            <input type="reset" name="limpar2" value="Limpar"/></div></p>
                    
                        <script type="text/javascript">
                            function selecionado2() {
                                var x = document.getElementById("Atr_Amostra").value;
                                document.getElementById("Atr_IdAmostra").value = x;
                                clicou();
                            }
                        </script>
                    </fieldset>
                </form>

            <script type="text/javascript">
                function clicou(){
 
                    <?php 
                        if(isset($_POST['Atr_Amostra']) && $_POST['Atr_Amostra'] !== 0) {
                        $AmostaSelecionada = (int)$_POST['Atr_Amostra'];
                        $sql = "SELECT * FROM amostra WHERE CodAmostra = $AmostaSelecionada";
                        $query = Mysql::conectar()->prepare($sql);
                        $query->execute();
                        }
                    ?>

                    document.getElementById('Atr_PrincipioAtivo').value = "<?php echo $dados['PrincipioAtivo'];?>";
                    document.getElementById('Atr_LoteProduto').value = "<?php echo $dados['LoteProduto'];?>";
                    document.getElementById('Atr_dateFrom').value = "<?php echo $dados['DataFabricacao'];?>";
                    document.getElementById('Atr_Armazenamento').value = "<?php echo $dados['Armazenamento'];?>";
                    document.getElementById('Atr_QtdAmostra').value = "<?php echo $dados['QtdAmostra'];?>";
                    document.getElementById('Atr_ConcetracaoAtivo').value = "<?php echo $dados['ConcetracaoAtivo'];?>";
                    document.getElementById('Atr_FormCentesimal').value = "<?php echo $dados['FormCentesimal'];?>";
                    document.getElementById('Atr_ResponsavelEnvio').value = "<?php echo $dados['ResponsavelEnvio'];?>";
                    document.getElementById('Atr_ObsAmostra').value = "<?php echo $dados['ObsAmostra'];?>";
                    
                    if(document.getElementById('Atr_Amostra').value == 0){
                        limpar2();
                    }
                }
                </script>

            <script type="text/javascript">
                function habilitar2(){
                    
                    if(document.getElementById('Atr_Amostra').value == 0){
                        document.getElementById('Atr_PrincipioAtivo').disabled = true;
                        document.getElementById('Atr_LoteProduto').disabled = true;
                        document.getElementById('Atr_dateFrom').disabled = true;
                        document.getElementById('Atr_Armazenamento').disabled = true;
                        document.getElementById('Atr_QtdAmostra').disabled = true;
                        document.getElementById('Atr_ConcetracaoAtivo').disabled = true;
                        document.getElementById('Atr_FormCentesimal').disabled = true;
                        document.getElementById('Atr_ResponsavelEnvio').disabled = true;
                        document.getElementById('Atr_ObsAmostra').disabled = true;
                        document.getElementById('Atr_Salvar').disabled = true;
                        limpar2();

                    }
                    if(document.getElementById('Atr_Amostra').value != 0){
                        document.getElementById('Atr_PrincipioAtivo').disabled = false;
                        document.getElementById('Atr_LoteProduto').disabled = false;
                        document.getElementById('Atr_dateFrom').disabled = false;
                        document.getElementById('Atr_Armazenamento').disabled = false;
                        document.getElementById('Atr_QtdAmostra').disabled = false;
                        document.getElementById('Atr_ConcetracaoAtivo').disabled = false;
                        document.getElementById('Atr_FormCentesimal').disabled = false;
                        document.getElementById('Atr_ResponsavelEnvio').disabled = false;
                        document.getElementById('Atr_ObsAmostra').disabled = false;
                        document.getElementById('Atr_Salvar').disabled = false;
                    }
                }
                function limpar2(){
                        document.getElementById('Atr_PrincipioAtivo').value = null;
                        document.getElementById('Atr_LoteProduto').value = null;
                        document.getElementById('Atr_dateFrom').value = null;
                        document.getElementById('Atr_Armazenamento').value = null;
                        document.getElementById('Atr_QtdAmostra').value = null;
                        document.getElementById('Atr_ConcetracaoAtivo').value = null;
                        document.getElementById('Atr_FormCentesimal').value = null;
                        document.getElementById('Atr_ResponsavelEnvio').value = null;
                        document.getElementById('Atr_ObsAmostra').value = null;
                }
            </script>
                    
                
                <?php
                        if(isset($_POST['Atr_Salvar']) && isset($_POST['form'])== "f_form"){
                        // $Cliente = $_POST['tCliente'];
                            //$IdCliente = (int)$_POST['tIdCliente'];
                            //$NovaAmostra = $_POST['tNovaAmostra'];
                            echo "teste update";

                            $IdAmostra = $_POST['Atr_Amostra'];
                            $PrincipioAtivo; 
                            $LoteProduto;
                            $DataFabricacao = date('y/m/d', strtotime($_POST['Atr_dateFrom']));
                            $Armazenamento;
                            $QtdAmostra;
                            $ConcetracaoAtivo; 
                            $FormCentesimal;
                            $ResponsavelEnvio; 
                            $ObsAmostra;
                            $DataCadastro = date('y/m/d');


                            if(isset($_POST['Atr_Amostra'])){$IdAmostra = (int)$_POST['Atr_Amostra'];}
                            if(isset($_POST['Atr_PrincipioAtivo'])){$PrincipioAtivo = $_POST['Atr_PrincipioAtivo'];}
                            if(isset($_POST['Atr_LoteProduto'])){$LoteProduto = $_POST['Atr_LoteProduto'];}
                            if(isset($_POST['dateFabricacao'])){
                                $DataFabricacao = date('Y-m-d', strtotime($_POST['Atr_dateFrom']));
                                
                            }
                            if(isset($_POST['Atr_Armazenamento'])){$Armazenamento = $_POST['Atr_Armazenamento'];}
                            if(isset($_POST['Atr_QtdAmostra'])){$QtdAmostra = $_POST['Atr_QtdAmostra'];}
                            if(isset($_POST['Atr_ConcetracaoAtivo'])){$ConcetracaoAtivo = $_POST['Atr_ConcetracaoAtivo'];}
                            if(isset($_POST['Atr_FormCentesimal'])){$FormCentesimal = $_POST['Atr_FormCentesimal'];}
                            if(isset($_POST['Atr_ResponsavelEnvio'])){$ResponsavelEnvio = $_POST['Atr_ResponsavelEnvio'];}
                            if(isset($_POST['Atr_ObsAmostra'])){$ObsAmostra = $_POST['Atr_ObsAmostra'];}

                            $texto = "";
                            if($PrincipioAtivo == "") { 
                                if($texto == ""){
                                    $texto = "Preencha o campo Princípio ativo";
                                }else{
                                    $texto = $texto. "; Princípio ativo";
                                }
                            }
                            if($LoteProduto == "") {
                                if($texto == ""){
                                    $texto = "Preencha o campo Lote do produto";
                                }else{
                                    $texto = $texto. "; Lote do produto";
                                }
                                
                            }
                            if($DataFabricacao == NULL) {
                                if($texto == ""){
                                    $texto = "Preencha o campo Data de fabricação";
                                }else{
                                    $texto = $texto. "; Data de fabricação";
                                }
                            }
                            if($Armazenamento == "") {
                                if($texto == ""){
                                    $texto = "Preencha o campo Armazenamento";
                                }else{
                                    $texto = $texto. "; Amarzenamento";
                                }
                            }
                            if($QtdAmostra == "") {
                                if($texto == ""){
                                    $texto = "Preencha o campo Qtd. de amostra";
                                }else{
                                    $texto = $texto. "; Qtd. de amostra";
                                }
                            }
                            if($ConcetracaoAtivo == "") {
                                if($texto == ""){
                                    $texto = "Preencha o campo Concentração princípio ativo";
                                }else{
                                    $texto = $texto. "; Concentração princípio ativo";
                                }
                            }
                            if($FormCentesimal == "") {
                                if($texto == ""){
                                    $texto = "Preencha o campo fórmula centesimal";
                                }else{
                                    $texto = $texto. "; fórmula centesimal";
                                }
                            }
                            if($ResponsavelEnvio == "") {
                                if($texto == ""){
                                    $texto = "Preencha o campo Responsável pelo envio";
                                }else{
                                    $texto = $texto. "; Responsável pelo envio";
                                }
                            }
                            
                            if($texto !=  "")
                            {   
                                $texto = $texto. ".";
                                echo $texto;
                            }else{
                                
                                $query = "UPDATE amostra SET PrincipioAtivo = ?, LoteProduto = ?, DataFabricacao = ?, Armazenamento = ?, 
                                QtdAmostra = ?, ConcetracaoAtivo = ?, FormCentesimal = ?, ResponsavelEnvio = ?, ObsAmostra = ?, DataCadastro = ?
                                WHERE CodAmostra = ?";
                                
                                $sql = Mysql::conectar()->prepare($query);
                                
                                $sql->execute(array($PrincipioAtivo, $LoteProduto, $DataFabricacao, $Armazenamento, $QtdAmostra, $ConcetracaoAtivo, $FormCentesimal, $ResponsavelEnvio, $ObsAmostra, $DataCadastro, $IdAmostra));

                                echo "Os dados foram salvos!";
                                return TRUE;
                            }
                        }
                    ?>
                
            </header>
                    
    </article>

    <article id="outros1">

        <header>
            <h1>Cadastro amostra</h1>
            <h2>Concluir cadastro amostra</h2>

            <fieldset id="login">
                <legend>Nova Amostra:</legend>
                
                    <p><label for="cLoginAdmin"> Protocolo/ISO:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="80" maxlength="80"/>
                    </p>
                    <p><label for="cLoginAdmin"> Concentração teste:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="30" maxlength="30"/>
                    <label for="cLoginAdmin"> Tempo de exposição:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="30" maxlength="30"/>
                    </p>                  
                    <p><label for="cMen">Observação:</label>
                    <textarea nome="tMsg" id="cMsg" cols="40" rows="5" placeholder="Se necessário, deixe aqui uma observação. "></textarea></p>

            </fieldset>
        </header>
        <p>
            colocar instruções aqui
        </p>
    </article>

    <article id="outros2">

        <header>
            <h1>Outros 2</h1>
            <h2>Outros 2 ainda sob desenvolvimento</h2>
        </header>
        <p>
            colocar instruções aqui
        </p>
    </article>

    <article id="outros3">

        <header>
            <h1>Outros 3</h1>
            <h2>Outros 3 ainda sob desenvolvimento</h2>
        </header>
        <p>
            colocar instruções aqui
        </p>
    </article>
</body>
</html>