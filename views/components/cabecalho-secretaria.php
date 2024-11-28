<header>
    <?php
    require_once caminhoAbsoluto('views/components/imagens-cabecalho.php');
    ?>
    <nav>
        <a href="<?= caminhoAbsoluto('views/secretaria/index.php', true) ?>" class="botao-nav">Início</a>
        <a href="" class="botao-nav">GTI</a>
        <a href="" class="botao-nav">GPI</a>
        <a href="" class="botao-nav">GE</a>
        <a href="<?= caminhoAbsoluto('views/secretaria/lista-processos-finalizados.php', true) ?>" class="botao-nav">DSM</a>
        <a href="<?= caminhoAbsoluto('views/calendario-escolar-2-2024.html', true) ?>" class="botao-nav">Calendário Acadêmico</a>
        <a href="<?= caminhoAbsoluto('views/login.html', true) ?>" class="botao-nav">Sair</a>
    </nav>
</header>