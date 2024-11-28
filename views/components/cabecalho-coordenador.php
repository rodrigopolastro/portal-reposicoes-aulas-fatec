<header>
    <?php
    require_once caminhoAbsoluto('views/components/imagens-cabecalho.php');
    ?>
    <nav>
        <a href="<?= caminhoAbsoluto('views/coordenador/index.php', true) ?>" class="botao-nav">Início</a>
        <a href="<?= caminhoAbsoluto('views/coordenador/lista-recebidos-faltas.php', true) ?>" class="botao-nav">Justificativas de Faltas</a>
        <a href="<?= caminhoAbsoluto('views/coordenador/lista-recebidos-reposicao.php', true) ?>" class="botao-nav">Planos de Reposições</a>
        <a href="<?= caminhoAbsoluto('views/coordenador/informacoes.html', true) ?>" class="botao-nav">Informações do Curso</a>
        <a href="<?= caminhoAbsoluto('views/login.html', true) ?>" class="botao-nav">Sair</a>
    </nav>
</header>