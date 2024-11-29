<header>
    <?php
    require_once caminhoAbsoluto('views/components/imagens-cabecalho.php');
    ?>
    <nav>
        <a href="<?= caminhoAbsoluto('views/professor/index.php', true) ?>" class="botao-nav">Início</a>
        <a href="<?= caminhoAbsoluto('views/professor/enviar-justificativa.php', true) ?>" class="botao-nav">Enviar Justificativa de Falta</a>
        <a href="<?= caminhoAbsoluto('views/professor/lista-enviados.php', true) ?>" class="botao-nav">Formulários Enviados</a>
        <a href="<?= caminhoAbsoluto('views/login.html', true) ?>" class="botao-nav">Sair</a>
    </nav>
</header>