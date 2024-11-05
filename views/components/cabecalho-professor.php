<header>
    <?php
    require_once caminhoAbsoluto('views/components/imagens-cabecalho.php');
    ?>
    <nav>
        <a href="../professor/index.php" class="botao-nav">Início</a>

        <!-- Dropdown para 'Enviar formulário' -->
        <div class="dropdown">
            
            <div class="dropdown-content">
                <a href="<?= caminhoAbsoluto('views/professor/enviar-justificativa.php', true) ?>" class="botao-nav">Justificativa de falta</a>
                <a href="<?= caminhoAbsoluto('views/professor/enviar-reposicao.php', true) ?>" class="botao-nav">Reposição de aulas</a>
            </div>
        </div>

        <a href="lista-enviados.html" class="botao-nav">Formulários enviados</a>
        <a href="login.html" class="botao-nav">Sair</a>
    </nav>
</header>