<?php
	header('Content-Type: text/html; charset=utf-8');
    include('../_codigos/classes.php');
    include('../_codigos/mysql.php');
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
        fieldset#login{
            font-size: 14pt;
        }
        input{
            font-size: 14pt;
        }
        select{
            font-size: 14pt;
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

            <fieldset id="login">
                <legend>Nova Amostra:</legend>
                
                    <p><label for="cLoginAdmin"> Cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="70" maxlength="100"/>
                    <label for="cLoginAdmin"> ID cliente:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="20" maxlength="20"/></p>
                    <p><label for="cLoginAdmin"> Nome da Amostra:</label><input type="text" name="tLoginAdmin" id="cLoginAdmin" size="70" maxlength="70"/></p>
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
                    Data de fabricação:<input type="date" nome="tNasc" id="cNasc" /><p/>
                    <p><label for="cSenhaAdmin"> Lote:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="30" maxlength="30"/>
                    <label for="cSenhaAdmin"> Responsável pelo cadastro:</label><input type="text" name="tSenhaAdmin" id="cSenhaAdmin" size="50" maxlength="70"/>
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