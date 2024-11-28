<header>
    <?php
    require_once caminhoAbsoluto('views/components/imagens-cabecalho.php');
    ?>
    <nav>
        <a href="../professor/index.php" class="botao-nav">Início</a>
        <a href="<?= caminhoAbsoluto('views/professor/enviar-justificativa.php', true) ?>" class="botao-nav">Enviar Justificativa de Falta</a>
        <a href="../professor/lista-enviados.php" class="botao-nav">Formulários Enviados</a>
        <a href="../login.html" class="botao-nav">Sair</a>
    </nav>
</header>