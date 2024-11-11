<?php
require 'vendor/autoload.php';
// Formulário será gerado com os dados enviados no formulário
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário de Reposição de Aula</title>

</head>

<body>
    <header>
        <div class="topo">
            <div class="fundo"><img src="img/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo"></div>
            <div class="fundo2"><img src="img/logo-fatec_itapira.png" alt="logo" class="logo-fatec"></div>
        </div>
        <nav>
            <a href="index-professor.html" class="botao-nav">Início</a>
            <a href="enviar-formularios.html" class="botao-nav">Enviar formulário</a>
            <a href="lista-enviados.html" class="botao-nav">Formulários enviados</a>
            <a href="#" class="botao-nav">Sair</a>
        </nav>
    </header>
    <main>
        <h1 style="text-align: center; margin:0; padding-bottom: 25px;">Revise os dados preenchidos antes de enviar o formulário</h1>
        <div style="display: flex; justify-content: center; align-items: center;">
            <embed src="assets/pdfs/exemplo-pdf-reposicao.pdf" type="application/pdf" width="60%" height="1200px" />
        </div>
        <form method="POST" action="save-pdf.php">
            <input type="hidden" name="file_name" value="pdf-reposicao.pdf">
            <div style="display: flex; justify-content: center;">
                <input style="margin-top: 25px; padding: 20px; width: 500px;" type="submit" value="Enviar">
            </div>
        </form>
    </main>
    <footer class="site-footer">
        <div class="footer">
            <img src="img/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo-rodape">
            <p class="rodape">Fatec Ogari de Castro Pacheco - Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista - CEP: 13974-080</p>
            <p class="rodape">Telefone: (19) 3843-1996 | (19) 3863-5210 (WhatsApp)</p>
            <p class="rodape">&copy; 2024 Equipe 6Tec. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>