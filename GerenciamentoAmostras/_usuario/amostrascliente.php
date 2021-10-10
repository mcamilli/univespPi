<?php
	header('Content-Type: text/html; charset=utf-8');
    include('../_codigos/classes.php');
    include('../_codigos/mysql.php');

    session_start();
    if(isset($_SESSION["usuario"]) == true && is_array($_SESSION["usuario"])== true){
        $id = $_SESSION["usuario"][1];
        $login = $_SESSION["usuario"][0];
    }else{
        header('Location:../index.php');
    }
?>

<!DOCTYPE html>
<script language="javascript" src="_javascript/funcoes.js"></script>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title>Gerenciamento de Amostras</title>
    <link rel="stylesheet" type="text/css" href="../_css/estilo.css" />
    <link rel="stylesheet" type="text/css" href="../_css/foto.css" />
</head>

<body>

    <div id="interface">
        <header id="cabecalho">
            <hgroup>
                <h1>Gerenciamento de Amostras</h1>
                <h2>Usuário</h2>
            </hgroup>

            <nav id="menu">
                <h1>Menu Principal</h1>
                <ul type="1">
                    <li onmouseover="mudaFoto('_imagens/home.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="iniciocliente.php">Home</a></li>
                    <li onmouseover="mudaFoto('_imagens/especificacoesusuario.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="amostrascliente.php">Amostras</a></li>
                    <li onmouseover="mudaFoto('_imagens/fotos.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="clientescliente.php">Clientes</a></li>
                    <li onmouseover="mudaFoto('_imagens/multimidia.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="andamentocliente.php">Andamento</a></li>
                    <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="outroscliente.php">Outros</a></li>
                    <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="../_codigos/logout.php">Sair</a></li>
                </ul>
            </nav>
        </header>

        <section id="corpo-full">
            <article id="Principal">
                <header id="menu-interno">
                    <hgroup>
                        <h3> > &nbsp; Amostras</h3>

                    </hgroup>

                    <nav id="menu-opcoes">
                        <h1>Opcoes</h1>
                        <ul type="1">
                            <li onmouseover="mudaFoto('_imagens/home.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_alteracoesamostras.php#novo" target="janela" alt="especificações da tela"/>Cadastrar Amostra</a></li>
                            <li onmouseover="mudaFoto('_imagens/especificacoes.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_alteracoesamostras.php#alterar" target="janela" alt="especificações da tela"/>Alterar Amostra</a></li>
                            <li onmouseover="mudaFoto('_imagens/fotos.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_alteracoesamostras.php#outros1" target="janela" alt="especificações da tela"/>Atribuir exame</a></li>
                            <li onmouseover="mudaFoto('_imagens/multimidia.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_alteracoesamostras.php#outros2" target="janela" alt="especificações da tela"/>outros 2</a></li>
                            <li onmouseover="mudaFoto('_imagens/contato.png')" onmouseout="mudaFoto('_imagens/fotos.png')"><a href="_alteracoesamostras.php#outros3" target="janela" alt="especificações da tela"/>outros 3</a></li>
                        </ul>
                        <iframe src="_alteracoesamostrascliente.php" name="janela" scrolling="no" id="frame-spec">
                        </iframe>
                    </nav>
                </header>

                <p>
                    inserir texto aqui
                </p>
               
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