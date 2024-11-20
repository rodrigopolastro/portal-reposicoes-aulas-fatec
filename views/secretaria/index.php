<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <title>Início</title>
</head>

<body>
    <main>
        <h1 class="titulo-inicio2">Portal para Justificativas de Faltas</h1>
        <h3>Bem-vindo(a)</h2>
            <h3>Área Secretaria</h3>
            <div class="cursos">
                <div class="item-index">
                    <p class="p-icone">Gestão da Tecnologia da Informação - GTI</p><br>
                    <a href="#" class="link-index"><img src="../../assets/images/informação.png" class="icone"></a>
                </div>

                <div class="item-index">
                    <p class="p-icone">Gestão da Produção Industrial - GPI</p><br>
                    <a href="#" class="link-index"><img src="../../assets/images/industrial.png" class="icone"></a>
                </div>

                <div class="item-index">
                    <p class="p-icone">Gestão Empresarial - GE</p><br>
                    <a href="#" class="link-index"><img src="../../assets/images/empresaria.png" class="icone"></a>
                </div>

                <div class="item-index">
                    <p class="p-icone">Desenvolvimento de Software Multiplataforma - DSM</p><br>
                    <a href="lista-justificativas.html" class="link-index"><img src="../../assets/images/software.png" class="icone"></a>
                </div>
            </div>
            </div>
    </main>
    <?php
    require_once '../components/rodape.php';
    ?>
</body>

</html>