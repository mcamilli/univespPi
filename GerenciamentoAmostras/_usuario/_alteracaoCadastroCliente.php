<?php
	header('Content-Type: text/html; charset=utf-8');
    include('_codigos/classes.php');
    include('_codigos/mysql.php');

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
            <h1>Novo cliente</h1>  
            <h2>Cadastrar um novo cliente:</h2>
            <form method="POST" id="fNovaAmostra" name="cNovaAmostra">

            <fieldset id="login">
                <legend>Nova Amostra:</legend>
                
                    <p><label for="cLoginAdmin"> Cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="70" maxlength="100"/>
                    <label for="cLoginAdmin"> ID cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="20" maxlength="20"/></p>
                    <p><label for="cLoginAdmin"> Nome da Amostra:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="70" maxlength="100"/></p>
                    <p><label for="cSenhaAdmin"> Quantidade de Amostra:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="30"/>
                    <label for="cEst">Temperatura de amarzenamento:</label><select name="tEst" id="cEst" style="width:150px;">
                            <option selected>Ambiente</option>
                            <option >2º a 8ºC</option>
                            <option>-20º a -30ºC</option>
                            <option>-70º a -80ºC</option>
                    </select></p>
                    <p><label for="cSenhaAdmin"> Formulação centesimal:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="40" maxlength="40"/>
                    <label for="cSenhaAdmin"> Composto ativo:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="50" maxlength="100"/></p>
                    <p><label for="cSenhaAdmin"> Concentração princípio ativo:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="40" maxlength="40"/>
                    Data de fabricação:<input type="date" nome="tNasc" id="cNasc" />
                    <label for="cSenhaAdmin"> Lote:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="30"/></p>
                    <p><label for="cSenhaAdmin"> Responsável pelo cadastro:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="70" maxlength="70"/>
                    </p>
            </fieldset>


            <p><div><input type="hidden" name="form" value="f_form"/></div>
            <div><input type="submit" name="acao" value="Cadastrar"/></div></p>

        </form>	

        </header>
    </article>


    <article id="alterar">

        <header>
            <h1>
                Alterar Cliente
            </h1>        
            <h2>
                Alterar registro de um cliente
            </h2>        

             <fieldset id="login">
                <legend>Nova Amostra:</legend>
                
                    <p><label for="cLoginAdmin"> Cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="80" maxlength="80"/>
                    <label for="cLoginAdmin"> ID cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="20" maxlength="20"/></p>
                    <p><label for="cLoginAdmin"> Nome da Amostra:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="100" maxlength="100"/></p>
                    <p><label for="cSenhaAdmin"> Quantidade de Amostra:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="30"/>
                    <label for="cEst">Temperatura de amarzenamento:</label><select name="tEst" id="cEst" style="width:150px;">
                            <option selected>Ambiente</option>
                            <option >2º a 8ºC</option>
                            <option>-20º a -30ºC</option>
                            <option>-70º a -80ºC</option>
                    </select></p>
                    <p><label for="cSenhaAdmin"> Formulação centesimal:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="40" maxlength="40"/>
                    <label for="cSenhaAdmin"> Composto ativo:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="50" maxlength="100"/></p>
                    <p><label for="cSenhaAdmin"> Concentração princípio ativo:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="40" maxlength="40"/>
                    Data de fabricação:<input type="date" nome="tNasc" id="cNasc" />
                    <label for="cSenhaAdmin"> Lote:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="30"/></p>
                    <p><label for="cSenhaAdmin"> Responsável pelo cadastro:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="70" maxlength="70"/>
                    </p>
            </fieldset>

        </header>
        <p>
            colocar texto aqui
        </p>        
    </article>

    
</body>
</html>