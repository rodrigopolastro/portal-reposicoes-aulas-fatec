<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('vendor/autoload.php');
require_once caminhoAbsoluto('controllers/justificativas-faltas.php');
require_once caminhoAbsoluto('controllers/disciplinas.php');
require_once caminhoAbsoluto('controllers/horarios-ausencias.php');

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

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Dados do Professor:', 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Nome: ' . $justificativa_falta['USR_nome_completo'], 0, 1);
$pdf->Cell(0, 10, 'Matrícula: ' . $justificativa_falta['USR_numero_matricula'], 0, 1);
$pdf->Cell(0, 10, 'Função: Professor de Ensino Superior', 0, 1);
$pdf->Cell(0, 10, 'Regime jurídico: CLT', 0, 1);

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Justificativa de Falta', 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Curso(s) envolvido(s) na ausência: ' . $disciplinas[0]['CUR_sigla'], 0, 1);
foreach ($disciplinas as $disciplina) {
    $pdf->Cell(0, 10, 'Disciplina: ' . $disciplina['DCP_nome'], 0, 1);
}
$pdf->Cell(0, 10, 'Falta referente ao dia: ' . $datasAusencias[0]['HRA_data_falta'], 0, 1);
$pdf->Cell(0, 10, 'Tipo de Falta: ' . $justificativa_falta['TPF_categoria'], 0, 1);
$pdf->MultiCell(
    0,                               // Largura (0 = até a margem)
    10,                              // Altura da linha
    'Descrição: ' . $justificativa_falta['TPF_descricao'], // Texto
    0,                               // Sem bordas
    'L',                             // Alinhamento à esquerda
    0                                // Sem preenchimento
);


$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Status da justificativa:', 0, 1);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, $statusJustificativa, 0, 1);
$pdf->Cell(0, 10, 'Feedback do Coordenador: ' . $feedbackCoordenador, 0, 1);

// Plano de reposição de aulas
$pdf->Ln(10); // Espaço antes da tabela
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Plano de Reposição de Aulas', 0, 1, 'C'); // Título centralizado
$pdf->Ln(5);

// Configurar cabeçalho da tabela
$pdf->SetFillColor(200, 200, 255); // Fundo azul claro
$pdf->SetDrawColor(0, 0, 0); // Cor da borda
$pdf->SetFont('helvetica', 'B', 12);

// Cabeçalho da tabela
$pdf->Cell(40, 10, 'Data da Falta', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Data da Reposição', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Horário', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Disciplina', 1, 1, 'C', 1);

// Configuração de linhas da tabela
$pdf->SetFont('helvetica', '', 12);
$pdf->SetFillColor(240, 240, 240); // Fundo cinza claro para linhas alternadas

$fill = 0; // Alterna cor de fundo
foreach ($datasAusencias as $data) {
    $horarioInicio = $data['HRA_horario_inicio'] ?? 'N/A';
    $horarioFim = $data['HRA_horario_fim'] ?? 'N/A';
    $horario = $horarioInicio . ' - ' . $horarioFim;

    $dataReposicao = $data['HRA_data_reposicao'] ?? 'N/A';

    // Posições iniciais
    $x = $pdf->GetX();
    $y = $pdf->GetY();

    // Coluna "Data da Falta"
    $pdf->MultiCell(40, 10, $data['HRA_data_falta'] ?? 'N/A', 1, 'C', $fill, 0);
    $pdf->SetXY($x + 40, $y);

    // Coluna "Data da Reposição"
    $pdf->MultiCell(40, 10, $dataReposicao, 1, 'C', $fill, 0);
    $pdf->SetXY($x + 80, $y);

    // Coluna "Horário"
    $pdf->MultiCell(60, 10, $horario, 1, 'C', $fill, 0);
    $pdf->SetXY($x + 140, $y);

    // Coluna "Disciplina" (usar quebra de linha automática)
    $disciplinaText = implode("\n", array_map(fn($d) => $d['DCP_nome'] ?? 'N/A', $disciplinas));
    $pdf->MultiCell(50, 10, $disciplinaText, 1, 'C', $fill);

    // Alterna cor de fundo e salta para a próxima linha
    $pdf->Ln();
    $fill = !$fill;
}
$pdf->Ln(10); // Espaço antes da imagem

// Verificar se há um comprovante para exibir
$pathComprovante = caminhoAbsoluto('private/comprovantes-faltas/comprovanteJustificativa' . $justificativa_falta['JUF_id'] . '.png');

if (file_exists($pathComprovante)) {
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->Cell(0, 10, 'Comprovante:', 0, 1, 'L');
    $pdf->Ln(5);

    // Definir dimensões da imagem do comprovante
    $xInicial = 15;          // Posição X
    $largura = 180;          // Largura da imagem em mm
    $yInicial = $pdf->GetY(); // Coordenada Y atual

    $pdf->Image(
        $pathComprovante,   // Caminho da imagem
        $xInicial,          // Coordenada X (esquerda da página)
        $yInicial,          // Coordenada Y
        $largura,           // Largura em mm
        0,                  // Altura proporcional (definida automaticamente)
        '',                 // Tipo de imagem (auto detect)
        '',                 // URL de destino (caso seja clicável)
        '',                 // Alinhamento
        false,              // Redimensionar (false para não distorcer)
        300,                // Resolução em DPI
        '',                 // String de ajustes (caso necessário)
        false,              // Não ajustar proporção
        false,              // Não recortar
        0,                  // Margem
        'M',                // Alinhamento interno (M: meio)
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
