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
<script language="javascript" src="_javascript/funcoes.js"></script>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Gerenciamento de Amostras</title>
    <link rel="stylesheet" type="text/css" href="_css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="_css/clientes.css" />
    
    <style>

        iframe#Tabela_Clientes {
                width: 1500px;
                height: 750px;
                overflow-x: scroll !important;
                overflow-y: scroll !important;
                border: none;
        }

    </style>
</head>

<body>

    <div id="interface">
        <header id="cabecalho">
            <hgroup>
                <h1>Gerenciamento de Amostras</h1>
                <h2>Administrador</h2>
            </hgroup>

            <nav id="menu">
                <h1>Menu Principal</h1>
                <ul type="1">
                    <li onmouseover="mudaFoto('_imagens/home.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="inicio.php">Home</a></li>
                    <li onmouseover="mudaFoto('_imagens/especificacoes.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="amostras.php">Amostras</a></li>
                    <li onmouseover="mudaFoto('_imagens/fotos.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="clientes.php">Clientes</a></li>
                    <li onmouseover="mudaFoto('_imagens/multimidia.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="andamento.php">Andamento</a></li>
                    <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="outros.php">Outros</a></li>
                    <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_codigos/logout.php">Sair</a></li>
                </ul>
            </nav>
        </header>

        <section id="corpo-full">
            <article id="Principal">
                <header id="menu-interno">
                    <hgroup>
                        <h3> > &nbsp; Clientes</h3>
                    </hgroup>

                     <nav id="menu-opcoes">
                        <h1>Opcoes</h1>
                        <ul type="1">
                            <li onmouseover="mudaFoto('_imagens/home.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_clientes.php#NovoCliente" target="janela" alt="Cadastrar um novo cliente"/>Novo Cliente</a></li>
                            <li onmouseover="mudaFoto('_imagens/especificacoes.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_clientes.php#AlterarCliente" target="janela" alt="Alterar registro do cliente"/>Alterar Cliente</a></li>
                            
                        </ul>
                        <iframe src="_clientes.php" name="janela" scrolling="no" id="Tabela_Clientes">
                        </iframe>
                     </nav>

                </header>


            </article>
        </section>

        <footer id="rodape">
            <p>
                Copyright&copy; <?php $Year = strftime("%Y"); echo $Year;?> - by Crop Biotec
                <br> <a href="http://facebook.com" target="_blank" /> Facebook | <a href="http://twitter.com" target="_blank" />Twitter
            </p>
        </footer>
    </div>
</body>
</html>