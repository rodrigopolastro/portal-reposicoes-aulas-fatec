<?php
$file_name = $_POST['file_name'];
if ($file_name == 'pdf-reposicao.pdf') {
    $was_file_created = true;
} else {
    $final_path = 'pdfs-formularios/' . $file_name;

    if ($final_path) {
        if (rename('pdfs-formularios/temp_file.pdf', trim($final_path))) {
            $was_file_created = true;
        } else {
            $was_file_created = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Envio de Formulário</title>

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
        <div class="">
            <div style="margin-top: 30px; display:flex; justify-content: center; align-items: center; height: 60vh;">
                <div style="padding: 40px; border: 2px solid #004F68; border-radius: 25px">
                    <?php if ($was_file_created) : ?>
                        <div>
                            <h2 style="text-align: center; margin:0">Formulário enviado corretamente!</h2>
                            <p style="text-align: center; margin-top: 15px;"> Você será notificado quando o coordenador aprová-lo ou reprová-lo.</p>
                        </div>
                    <?php else : ?>
                        <div>
                            <h2 style="text-align: center;">Ops, ocorreu algo de errado...</h2>
                            <p style="text-align: center; margin-top: 15px;"> Houve um erro no envio do formulário. Por favor, tente novamente mais tarde</p>
                        </div>
                    <?php endif ?>
                    <div style="display:flex; justify-content: center; align-items: center; padding-top: 20px;">
                        <a href="./index-professor.html"><button class="voltar">Voltar para a Página Inicial</button></a>
                    </div>
                </div>
            </div>
        </div>
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