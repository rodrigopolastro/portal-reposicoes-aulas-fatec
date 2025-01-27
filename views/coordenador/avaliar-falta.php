<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Formulário enviado - Justificativa de Falta</title>

</head>

<body>
    <header>
        <div class="topo">
            <div class="fundo"><img src="../../assets/images/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo"></div>
            <div class="fundo2"><img src="../../assets/images/logo-fatec_itapira.png" alt="logo" class="logo-fatec"></div>
        </div>
        <nav>
            <a href="index.php" class="botao-nav">Início</a>
            <a href="" class="botao-nav">Justificativas de Falta</a>
            <a href="lista-recebidos-reposicao.php" class="botao-nav">Reposição de Aulas</a>
            <a href="informacoes.html" class="botao-nav">Informações do Curso</a>
            <a href="login.html" class="botao-nav">Sair</a>
        </nav>

    </header>
    <main>
        <h1>Justificativa de Falta</h1>
        <div class="w-100 vh-100 d-flex justify-content-center">
            <iframe src=" ../../private/temp_file.pdf" class="w-75 h-100">
                Seu navegador não suporta visualização de PDF.
                <a href="../../private/temp_file.pdf">Clique aqui para visualizar o PDF</a>.
            </iframe>
        </div>

        <h2>Analisar</h2>
        <div class="topo-form">
            <form id="analise-coordenador" method="POST" action="../../controllers/justificativas-faltas.php">
                <input type="hidden" name="acao_justificativas_faltas" value="avalia_justificativa">
                <input type="hidden" name="id_justificativa" value="<?= $_GET['id_justificativa'] ?>">
                <label for="deferimento"><strong>Esta Justificativa de Falta está:</strong></label><br><br>
                <input type="radio" id="deferido" name="deferimento" value="deferido">
                <label for="deferido">Deferida</label>
                <input type="radio" id="indeferido" name="deferimento" value="indeferido">
                <label for="indeferido">Indeferida</label>
                <br><br><br>
                <div id="feedback" style="display: none;">
                    <label for="feedback"><strong>Feedback:</strong></label><br><br>
                    <textarea name="feedback" id="txtFeedback" rows="4" cols="30"></textarea>
                </div>

                <input type="submit" value="Enviar">
                <br><br><br>

                <a href="lista-recebidos-faltas.php" class="voltar">Voltar</a>

            </form>
        </div>

        <script>
            // verificar quando o rádio "Indeferido" é selecionado
            document.addEventListener("DOMContentLoaded", function() {
                var radioIndeferido = document.getElementById("indeferido");
                var radioDeferido = document.getElementById("deferido");
                var feedbackDiv = document.getElementById("feedback");

                radioIndeferido.addEventListener("change", function() {
                    if (radioIndeferido.checked) {
                        feedbackDiv.style.display = "block"; // Mostra o campo de feedback
                    } else {
                        feedbackDiv.style.display = "none"; // Esconde o campo de feedback se não estiver selecionado
                    }
                });

                radioDeferido.addEventListener("change", function() {
                    if (radioDeferido.checked) {
                        feedbackDiv.style.display = "none"; // Esconde o campo de feedback se o "Deferido" for selecionado
                    }
                });
            });
        </script>

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