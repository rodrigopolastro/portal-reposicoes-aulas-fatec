<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('vendor/autoload.php');
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');
require_once caminhoAbsoluto('controllers/horarios-reposicoes.php');

// Recuperar dados do banco
$justificativa_falta = controllerJustificativasFaltas(
    'busca_justificativa_falta',
    ['id_justificativa' => $_GET['id_justificativa']]
);
$disciplinas = controllerDisciplinas(
    'busca_disciplinas_justificativa',
    ['id_justificativa' => $_GET['id_justificativa']]
);
$datasAusencias = controllerHorariosAusencias(
    'busca_datas_ausencias_justificativa',
    ['id_justificativa' => $_GET['id_justificativa']]
);
$datasReposicoes = controllerHorariosReposicoes(
    'busca_datas_reposicoes_justificativa',
    ['id_reposicao' => $justificativa_falta['PLR_id']]
);
$dataEnvio = (new DateTime())->format('d/m/Y');
$statusJustificativa = $justificativa_falta['status'] ?? 'Pendente';
$feedbackCoordenador = $justificativa_falta['feedback'] ?? 'Nenhum feedback registrado.';

// Configuração do PDF
class CustomTCPDF extends TCPDF
{
    public function Header()
    {
        // Definir as dimensões da imagem
        $imageWidth = 80; // Largura da imagem em milímetros

        // Calcular a posição X para centralizar a imagem
        $pageWidth = $this->getPageWidth();
        $xPosition = ($pageWidth - $imageWidth) / 2;

        // Adicionar a imagem centralizada
        $this->Image(
            '../assets/images/logo-fatec_itapira.png', // Caminho da imagem
            $xPosition,  // Coordenada X calculada
            5,           // Coordenada Y
            $imageWidth  // Largura da imagem
        );
    }
}

$pdf = new CustomTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetTitle('Formulário de Justificativa de Faltas');
$pdf->SetFont('helvetica', '', 12);
$pdf->AddPage();


// Início do conteúdo
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Data de envio: ' . $dataEnvio, 0, 1);

$pdf->SetLineWidth(0.1); // Define a espessura da linha (fina)
$pdf->SetDrawColor(0, 0, 0); // Define a cor da linha (preto)

// Ajustar margens da linha
$marginLeft = 15; // Margem esquerda
$marginRight = 15; // Margem direita
$yPosition = $pdf->GetY(); // Posição Y atual

$pdf->Line($marginLeft, $yPosition, $pdf->getPageWidth() - $marginRight, $yPosition); // Linha horizontal

$pdf->Ln(5);
$pdf->SetTextColor(0, 79, 104);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Dados do Professor:', 0, 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Nome: ' . $justificativa_falta['USR_nome_completo'], 0, 1);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Matrícula: ' . $justificativa_falta['USR_numero_matricula'], 0, 1);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Função: Professor de Ensino Superior', 0, 1);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Regime jurídico: CLT', 0, 1);
$pdf->Ln(5);

$pdf->SetLineWidth(0.1); // Define a espessura da linha (fina)
$pdf->SetDrawColor(0, 0, 0); // Define a cor da linha (preto)

// Ajustar margens da linha
$marginLeft = 15; // Margem esquerda
$marginRight = 15; // Margem direita
$yPosition = $pdf->GetY(); // Posição Y atual

$pdf->Line($marginLeft, $yPosition, $pdf->getPageWidth() - $marginRight, $yPosition); // Linha horizontal

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->SetTextColor(0, 79, 104);
$pdf->Cell(0, 10, 'Justificativa de Falta', 0, 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Curso(s) envolvido(s) na ausência: ' . $disciplinas[0]['CUR_sigla'], 0, 1);
foreach ($disciplinas as $disciplina) {
    $pdf->SetX(20);
    $pdf->Cell(0, 10, 'Disciplina: ' . $disciplina['DCP_nome'], 0, 1);
}
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Falta referente ao dia: ' . $datasAusencias[0]['HRA_data_falta'], 0, 1);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Tipo de Falta: ' . $justificativa_falta['TPF_categoria'], 0, 1);
$pdf->SetX(20);
$pdf->MultiCell(
    0,                               // Largura (0 = até a margem)
    10,                              // Altura da linha
    'Descrição: ' . $justificativa_falta['TPF_descricao'], // Texto
    0,                               // Sem bordas
    'L',                             // Alinhamento à esquerda
    0                                // Sem preenchimento
);


$pdf->Ln(5);

$pdf->SetLineWidth(0.1); // Define a espessura da linha (fina)
$pdf->SetDrawColor(0, 0, 0); // Define a cor da linha (preto)

// Ajustar margens da linha
$marginLeft = 15; // Margem esquerda
$marginRight = 15; // Margem direita
$yPosition = $pdf->GetY(); // Posição Y atual

$pdf->Line($marginLeft, $yPosition, $pdf->getPageWidth() - $marginRight, $yPosition); // Linha horizontal

$pdf->Ln(5);
$pdf->SetTextColor(0, 79, 104);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Status da justificativa:', 0, 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(20);
$pdf->Cell(0, 10, $statusJustificativa, 0, 1);
$pdf->SetX(20);
$pdf->Cell(0, 10, 'Feedback do Coordenador: ' . $feedbackCoordenador, 0, 1);
$pdf->SetX(20);
// Plano de reposição de aulas

$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Plano de Reposição de Aulas', 0, 1, 'C'); // Título centralizado
$pdf->Ln(5);

// Configurar cabeçalho da tabela
$pdf->SetFillColor(88, 149, 168); // Fundo azul claro
$pdf->SetDrawColor(0, 0, 0); // Cor da borda
$pdf->SetFont('helvetica', 'B', 12);

// Cabeçalho da tabela
$pdf->Cell(60, 10, 'Data da Falta', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Data da Reposição', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Disciplina', 1, 1, 'C', 1);

// Configuração de linhas da tabela
$pdf->SetFont('helvetica', '', 12);
$pdf->SetFillColor(240, 240, 240); // Fundo cinza claro para linhas alternadas

$fill = 0; // Alterna cor de fundo
for ($i = 0; $i < count($datasAusencias); $i++) {
    $ausencia = $datasAusencias[$i];
    $dataAusencia = date_format(date_create($ausencia['HRA_data_falta']), "d/m/y");
    $horarioAusencia = $ausencia['HRF_horario_inicio'] . ' às ' . $ausencia['HRF_horario_inicio'];
    $dataHorarioAusencia = $dataAusencia . ' - ' . $horarioAusencia;

    if (isset($datasReposicoes[$i])) {
        $reposicao = $datasReposicoes[$i];
        $dataReposicao = date_format(date_create($reposicao['HRR_data_reposicao']), "d/m/y");
        $horarioReposicao = $reposicao['HRF_horario_inicio'] . ' - ' . $reposicao['HRF_horario_fim'];
        $dataHorarioReposicao = $dataReposicao . ' - ' . $horarioReposicao;
    }

    $conteudoCelulaDisciplina = $ausencia['DCP_nome'] ?? 'N/A';
    $larguraCelulaDisciplina = 60;
    $alturaCelulaDisciplina = $pdf->getStringHeight($larguraCelulaDisciplina, $conteudoCelulaDisciplina);

    $alturaLinhas = max(10, $alturaCelulaDisciplina);

    $pdf->Cell(60, $alturaLinhas, $dataHorarioAusencia ?? 'N/A', 1, 0, 'C', $fill);
    $pdf->Cell(60, $alturaLinhas, $dataHorarioReposicao ?? 'N/A', 1, 0, 'C', $fill);
    $pdf->MultiCell(60, $alturaLinhas, $ausencia['DCP_nome'], 1, 'C', $fill);


    // Linha da tabela
    // $pdf->Cell(60, 10, $dataHorarioAusencia ?? 'N/A', 1, 0, 'C', $fill);
    // $pdf->Cell(60, 10, $dataHorarioReposicao ?? 'N/A', 1, 0, 'C', $fill);
    // $pdf->MultiCell(60, 10, $ausencia['DCP_nome'] ?? 'N/A', 1, 'C', $fill);

    // MultiCell para quebrar o texto da coluna "Disciplina"
    $x = $pdf->GetX(); // Posição atual do cursor em X
    $y = $pdf->GetY();

    // Coluna "Data da Falta"
    // $pdf->MultiCell(40, 10, $dataHorarioAusencia ?? 'N/A', 1, 'C', $fill, 0);
    // $pdf->SetXY($x + 40, $y);

    // Coluna "Data da Reposição"
    // $pdf->MultiCell(40, 10, $dataHorarioReposicao ?? 'N/A', 1, 'C', $fill, 0);
    // $pdf->SetXY($x + 80, $y);

    // Coluna "Disciplina" (usar quebra de linha automática)
    // $disciplinaText = implode("\n", array_map(fn($d) => $d['DCP_nome'] ?? 'N/A', $disciplinas));

    // Alterna cor de fundo e salta para a próxima linha
    // $pdf->Ln();
    $fill = !$fill;
}
$pdf->Ln(10); // Espaço antes da imagem

// Verificar se há um comprovante para exibir
$pathComprovante = caminhoAbsoluto('private/comprovantes-faltas/comprovanteJustificativa' . $justificativa_falta['JUF_id'] . '.png');

if (file_exists($pathComprovante)) {
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Comprovante:', 0, 1, 'L');
    $pdf->Ln(5);

    // Definir dimensões da imagem do comprovante
    $largura = $pdf->getPageWidth() * 0.5;  // Largura da imagem em mm
    $xInicial = ($pdf->getPageWidth() - $largura) / 2; // Calcula X para centralizar
    $yInicial = $pdf->GetY(); // Coordenada Y atual

    $pdf->Image(
        $pathComprovante,   // Caminho da imagem
        $xInicial,          // Coordenada X (calculada para centralizar)
        $yInicial,          // Coordenada Y
        $largura,           // Largura em mm
        0,                  // Altura proporcional (definida automaticamente)
        '',                 // Tipo de imagem (auto detect)
        '',                 // URL de destino (caso seja clicável)
        '',                 // Alinhamento (não necessário pois já calculamos X)
        true,               // Redimensionar (false para não distorcer)
        300,                // Resolução em DPI
        '',                 // String de ajustes (caso necessário)
        false,              // Não ajustar proporção
        false,              // Não recortar
        0,                  // Margem
        '',                 // Alinhamento interno
        false               // Alterar estado
    );

    // Obter altura ocupada pela imagem
    $alturaComprovante = $pdf->getImageRBY() - $yInicial;

    // Ajustar a posição do cursor para evitar sobreposição
    $pdf->SetY($yInicial + $alturaComprovante + 10); // 10 mm de espaço extra após a imagem

} else {
    $pdf->Cell(0, 10, 'Nenhum comprovante anexado.', 0, 1, 'L');
    $pdf->Ln(5);
}
// Salvar e redirecionar
$pdf_data = $pdf->Output('temp_file.pdf', 'S');
file_put_contents(caminhoAbsoluto('private/temp_file.pdf'), $pdf_data);
if (isset($_GET['url_destino'])) {
    header('Location: ' . $_GET['url_destino'] . '?id_justificativa=' . $_GET['id_justificativa']);
} else {
    header('Location: ' . caminhoAbsoluto('private/temp_file.pdf', true));
}
