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
            <h1>Cadastrar Amostra</h1>  
            <h2>Cadastrar uma  nova amostra:</h2>
            <form method="POST" id="fNovaAmostra" name="cNovaAmostra">
                <br>
                <fieldset id="precadastro">
                    <legend>Pré cadastro amostra:</legend>

                    <p><label >Cliente:</label>
                    
                    <select name="tCliente" id="cCliente" style="width:750px" onchange="selecionado()"> 
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
                        <p><label for="cNovaAmostra"> Nova Amostra:</label><input type="text" name="tNovaAmostra" id="cNovaAmostra" size="70" maxlength="70"/></p>
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
                
            </form>	
            <?php
                    if(isset($_POST['tSalvar']) && isset($_POST['form'])== "f_form"){
                        $Cliente = $_POST['tCliente'];
                        $IdCliente = (int)$_POST['tIdCliente'];
                        $NovaAmostra = $_POST['tNovaAmostra'];

                        $texto = "";
                        if($Cliente == "") { 
                            //alert("preencha o campo Nova amostra");
                            if($texto == ""){
                                $texto = "Preencha o campo Cliente";
                            }else{
                                $texto = $texto. "; Cliente";
                            }
                        }
                        if($IdCliente == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo ID Cliente";
                            }else{
                                $texto = $texto. "; ID Cliente";
                            }
                            
                        }
                        if($NovaAmostra == "") {
                            if($texto == ""){
                                $texto = "Preencha o campo Nova Amostra";
                            }else{
                                $texto = $texto. "; Nova Amostra";
                            }
                        }
                        if($texto !=  "")
                        {
                            echo $texto;
                        }else{
                            $query = "INSERT INTO amostra  (NomeAmostra, CodCliente) VALUES (?,?)";
                            $sql = Mysql::conectar()->prepare($query);
                            $sql->execute(array($NovaAmostra, $IdCliente));
                            echo "amostra cadastrada";
                            return TRUE;
                        }
                    }
                ?>
            
        </header>
    </article>


    <article id="alterar">

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

    <article id="outros1">

        <header>
            <h1>Atribuir exame</h1>
            <h2>Atribuir exame ainda sob desenvolvimento</h2>

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