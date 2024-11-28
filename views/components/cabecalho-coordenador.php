<header>
    <?php
    require_once caminhoAbsoluto('views/components/imagens-cabecalho.php');
    ?>
    <nav>
        <a href="../coordenador/index.php" class="botao-nav">Início</a>
        <a href="<?= caminhoAbsoluto('views/coordenador/lista-recebidos-faltas.php', true) ?>" class="botao-nav">Justificativas de Faltas</a>
        <a href="../coordenador/lista-recebidos-reposicao.php" class="botao-nav">Planos de Reposições</a>
        <a href="../coordenador/informacoes.html" class="botao-nav">Informações do Curso</a>
        <a href="../login.html" class="botao-nav">Sair</a>
    </nav>
</header>