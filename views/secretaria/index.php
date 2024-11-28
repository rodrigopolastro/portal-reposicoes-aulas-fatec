<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/estilo-geral.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <link rel="stylesheet" href="../../assets/css/utilidades.css">
    <title>Início</title>
</head>

<body>
    <?php
    require_once '../components/cabecalho-secretaria.php';
    ?>
    <main>
        <h1 class="titulo-inicio2">Portal para Justificativas de Faltas</h1>
        <div class="d-flex justify-content-center">
            <div class="w-75">
                <h3>Bem-vindo(a) à Área da Secretaria</h3>
                <div class="d-flex w-100">
                    <div class="w-50 padding-cursos">
                        <div class="item-index w-100">
                            <a href="lista-processos-finalizados.php" class="link-index"><img src="../../assets/images/software.png" class="icone"></a>
                            <p class="p-icone w-75 text-center p-0 m-0">Desenvolvimento de Software Multiplataforma - DSM</p><br>
                        </div>
                    </div>
                    <div class="w-50 padding-cursos">
                        <div class="item-index w-100">
                            <a href="#" class="link-index"><img src="../../assets/images/informação.png" class="icone"></a>
                            <p class="p-icone w-75 text-center p-0 m-0">Gestão da Tecnologia da Informação - GTI</p><br>
                        </div>
                    </div>
                </div>
                <div class="d-flex w-100">
                    <div class="w-50 padding-cursos">
                        <div class="item-index w-100">
                            <a href="#" class="link-index"><img src="../../assets/images/empresaria.png" class="icone"></a>
                            <p class="p-icone w-75 text-center p-0 m-0">Gestão Empresarial - GE</p><br>
                        </div>
                    </div>
                    <div class="w-50 padding-cursos">
                        <div class="item-index w-100">
                            <a href="#" class="link-index"><img src="../../assets/images/industrial.png" class="icone"></a>
                            <p class="p-icone w-75 text-center p-0 m-0">Gestão da Produção Industrial - GPI</p><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    require_once '../components/rodape.php';
    ?>
</body>

</html>