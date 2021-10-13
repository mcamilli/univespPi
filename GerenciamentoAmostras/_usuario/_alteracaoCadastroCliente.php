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
    <article id="inicio">

        <header>
       
            <h2>
                <br> início
            </h2>        
        </header>
        <p>
            colocar texto aqui
        </p>        
    </article>
    
    <article id="alterar_cadastro">

        <header>
            <h1>
                Alterar Cadastro
            </h1>        
            <h2>
                <br>
                Alterar dados do cadastro
                <br>
            </h2>        
            <br>
            <form method="POST" id="AC_Cliente" name="AC_Cliente" onsubmit="AC_cliente()">
            <?php
                    $ClienteSelecionado = (int)$_SESSION["usuario"][1];
                    $sql = "SELECT * FROM cliente WHERE CodCliente = $ClienteSelecionado";
                    $query = Mysql::conectar()->prepare($sql);
                    $query->execute();
                    foreach($query as $dados){ 
                    
                ?>
            <fieldset id="ACCliente">
                
                <legend>Alterar Cadastro</legend>
                
                    <p><label for="RazaoSocial"> Razão Social:</label><input type="AC_ext" name="AC_RazaoSocial" id="AC_RazaoSocial" size="70" maxlength="100" value="<?php 
                     echo $dados['RazaoSocial']; ?>" disabled=""/>
                    <label for="AC_Cnpj"> CNPj:</label><input type="AC_ext" name="AC_Cnpj" id="AC_Cnpj" size="16" maxlength="16" value="<?php 
                     echo $dados['CNPj']; ?>" disabled=""/></p>
                    <p><label for="AC_NomeFantasia"> Nome Fantasia:</label><input type="AC_ext" name="AC_NomeFantasia" id="AC_NomeFantasia" size="70" maxlength="100" value="<?php 
                     echo $dados['NomeFantasia']; ?>" disabled=""/>
                    </p>
                    <p><label for="AC_Email"> Email:</label><input type="AC_ext" name="AC_Email" id="AC_Email" size="40" maxlength="100" value="<?php 
                     echo $dados['Email']; ?>" disabled=""/>
                    <label for="AC_Fone1"> Telefone 1:</label><input type="AC_ext" name="AC_Fone1" id="AC_Fone1" size="16" maxlength="16" value="<?php 
                     echo $dados['Telefone1']; ?>" disabled=""/>
                    <label for="AC_Fone2"> Telefone 2:</label><input type="AC_ext" name="AC_Fone2" id="AC_Fone2" size="16" maxlength="16" value="<?php 
                     echo $dados['Telefone2']; ?>" disabled=""/></p>
                    
            </fieldset>
            <br>
            <fieldset id="Endereco">
                <legend>Endereço</legend>
                    <p><label for="AC_Logra"> Logradouro:</label><input type="AC_ext" name="AC_Logra" id="AC_Logra" size="50" maxlength="100" value="<?php 
                     echo $dados['Endereco']; ?>" disabled=""/>
                    <label for="AC_Num"> Número:</label><input type="AC_ext" name="AC_Num" id="AC_Num" size="7" maxlength="11" value="<?php 
                     echo $dados['Numero']; ?>" disabled=""/>
                    <label for="AC_Cep"> CEP:</label><input type="AC_ext" name="AC_Cep" id="AC_Cep" size="30" maxlength="40" value="<?php 
                     echo $dados['CEP']; ?>" disabled=""/></p>
                    <p><label for="AC_Cidade"> Cidade:</label><input type="AC_ext" name="AC_Cidade" id="AC_Cidade" size="30" maxlength="40" value="<?php 
                     echo $dados['Cidade']; ?>" disabled=""/>
                    <label for="AC_Estado"> Estado:</label><input type="AC_ext" name="AC_Estado" id="AC_Estado" size="30" maxlength="40" value="<?php 
                     echo $dados['Estado']; ?>" disabled=""/>
                    <label for="AC_Pais"> País:</label><input type="AC_ext" name="AC_Pais" id="AC_Pais" size="30" maxlength="40" value="<?php 
                     echo $dados['Pais']; ?>" disabled=""/></P>
                    </p>
            </fieldset>
            <?php } ?>
            <br>
            
            <p><div><input type="hidden" name="form" value="f_form"/></div>
            <div id="botoes">
            <input type="button" id="Atr_editar" name="Atr_editar" value="Editar" onclick="habilitar3()"/>
            <input type="submit" name="AC_Salvar" id="AC_Salvar" value="Salvar" disabled=""/>
            </div></p>

            
        </form>	

        <script type="text/javascript">

            function habilitar3() {
                if(document.getElementById('AC_Salvar').disabled == true){
                    document.getElementById('AC_Salvar').disabled = false;
                    document.getElementById('AC_NomeFantasia').disabled = false;
                    document.getElementById('AC_Email').disabled = false;
                    document.getElementById('AC_Fone1').disabled = false;
                    document.getElementById('AC_Fone2').disabled = false;
                    document.getElementById('AC_Logra').disabled = false;
                    document.getElementById('AC_Num').disabled = false;
                    document.getElementById('AC_Cep').disabled = false;
                    document.getElementById('AC_Cidade').disabled = false;
                    document.getElementById('AC_Estado').disabled = false;
                    document.getElementById('AC_Pais').disabled = false;

                }else{
                    document.getElementById('AC_Salvar').disabled = true;
                    document.getElementById('AC_NomeFantasia').disabled = true;
                    document.getElementById('AC_Email').disabled = true;
                    document.getElementById('AC_Fone1').disabled = true;
                    document.getElementById('AC_Fone2').disabled = true;
                    document.getElementById('AC_Logra').disabled = true;
                    document.getElementById('AC_Num').disabled = true;
                    document.getElementById('AC_Cep').disabled = true;
                    document.getElementById('AC_Cidade').disabled = true;
                    document.getElementById('AC_Estado').disabled = true;
                    document.getElementById('AC_Pais').disabled = true;
                }
            }
            function AC_cliente(){
                var $mensagem = "";

                if(document.getElementById("AC_Email").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: Email";
                    }else{
                        $mensagem = $mensagem + ", Email";
                    }
                }
                if(document.getElementById("AC_Fone1").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: Telefone 1 ";
                    }else{
                        $mensagem = $mensagem + ", Telefone 1";
                    }
                }
                if(document.getElementById("AC_Logra").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: Logradouro";
                    }else{
                        $mensagem = $mensagem + ", Logradouro";
                    }
                }
                if(document.getElementById("AC_Num").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: Número";
                    }else{
                        $mensagem = $mensagem + ", Número";
                    }
                }
                if(document.getElementById("AC_Cep").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: CEP";
                    }else{
                        $mensagem = $mensagem + ", CEP";
                    }
                }
                if(document.getElementById("AC_Cidade").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: Cidade";
                    }else{
                        $mensagem = $mensagem + ", Cidade";
                    }
                }
                if(document.getElementById("AC_Estado").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: Estado";
                    }else{
                        $mensagem = $mensagem + ", Estado";
                    }
                }
                if(document.getElementById("AC_Pais").value == ""){
                    if($mensagem == ""){
                        $mensagem = "Preencha os campos: País";
                    }else{
                        $mensagem = $mensagem + ", País";
                    }
                }

                if($mensagem != ""){
                    $mensagem = $mensagem + ".";
                    alert($mensagem);
                }else{
                    
                    alert ("falta insirir o envio para o BD");
                }
            }
        </script>
        </header>
    </article>
</body>
</html>