<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/portal-reposicoes-aulas-fatec/helpers/caminho-absoluto.php';
require_once caminhoAbsoluto('vendor/autoload.php');

class CustomTCPDF extends TCPDF
{
    public function Header()
    {
        $this->Image(
            'img/logo-fatec_itapira.png', // File
            0,               // X coordinate
            5,               // Y coordinate
            80,              // Width
            0,               // Height
            '',               // Type (inferred from file extension)
            '', // Link
            '',              // Align
            true,             // Resize
            300,              // DPI
            'C',               // PAlign
            false,            // IsMask
            false,            // ImgMask
            0,                // Border
            false,            // FitBox
            false,            // Hidden
            true,            // FitOnPage
            false,            // Alt
            []                // AltImgs
        );
    }
}

$pdf = new CustomTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetTitle('Formulário de Justificativa de Faltas');
$pdf->SetFont('helvetica', '', 12);

$pdf->AddPage();
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Dados do Professor', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Nome: ' . 'Ana Célia Ribeiro Bizigato Portes', 0, 1);
$pdf->Cell(0, 10, 'Matrícula: ' . '0000000000005', 0, 1);
$pdf->Cell(0, 10, 'Regime jurídico: CLT', 0, 1);
$pdf->Cell(0, 3, '', 0, 1);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 15, 'Justificativa de Falta', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
$pdf->write(10, 'Cursos: ');
if(isset($_POST['cursos'])){
    foreach ($_POST['cursos'] as $curso) {
        $pdf->write(10, strtoupper($curso) . ',');
    }
}
$pdf->write(10, '', '', '', '', 1);
if ($_POST['tipo_periodo'] == 'dia') {
    $date = DateTimeImmutable::createFromFormat(
        'Y-m-d',
        $_POST['data_dia'],
        new DateTimeZone('America/Sao_Paulo')
    );
    $pdf->Cell(0, 10, 'Falta referente ao dia: ' . $date->format('d/m/Y'), 0, 1);
} elseif ($_POST['tipo_periodo'] == 'periodo') {
    $date_start = DateTimeImmutable::createFromFormat(
        'Y-m-d',
        $_POST['inicio_periodo'],
        new DateTimeZone('America/Sao_Paulo')
    );
    $date_end = DateTimeImmutable::createFromFormat(
        'Y-m-d',
        $_POST['fim_periodo'],
        new DateTimeZone('America/Sao_Paulo')
    );
    $string = 'Período de ' . $_POST['dias_periodo'] . ' dias: ' . $date_start->format('d/m/Y') . ' até ' . $date_end->format('d/m/Y');
    $pdf->Cell(0, 10, $string, 0, 1);
}
$pdf->SetFont('helvetica', '', 12);
$pdf->write(10, 'Motivo: ');
switch ($_POST['tipo_falta']) {
    case 'licenca_medica':
        $pdf->Write(10, $_POST['tipo_licenca_medica']);
        if (isset($_POST['motivo_falta_medica'])) {
            $pdf->Cell(0, 10, $_POST['motivo_falta_medica'], 0, 1);
        } elseif (isset($_POST['comparecimento_inicio']) && isset($_POST['comparecimento_fim'])) {
            $pdf->Cell(0, 10, $_POST['comparecimento_inicio'] . ' às ' . $_POST['comparecimento_fim'], 0, 0);
        }
        break;
    case 'falta_injustificada':
        if ($_POST['tipo_falta_injustificada'] == 'falta') {
            $pdf->Cell(0, 10, 'Falta Injustificada.', 0, 1);
        } else {
            $pdf->Write(10, 'Atraso ou Saída Antecipada no período: ');
            $pdf->Write(10, $_POST['inicio_atraso_saida_injustificada'] . ' às ' . $_POST['fim_atraso_saida_injustificada']);
        }
        break;
    case 'falta_justificada':
        if ($_POST['tipo_falta_justificada'] == 'motivo_adicional') {
            $pdf->Write(10, 'Falta por motivo de: ');
            $pdf->Write(10, $_POST['motivo_falta_justificada']);
        } else {
            $pdf->Write(10, 'Atraso ou Saída Antecipada no período: ');
            $pdf->Write(10, $_POST['inicio_atraso_saida_justificada'] . ' às ' . $_POST['fim_atraso_saida_justificada']);
            $pdf->Write(10, ' por motivo de: ' . $_POST['motivo_atraso_saida_antecipada']);
        }
        break;
    case 'legislacao_trabalhista':
        $pdf->Write(10, 'Falta prevista na legislação trabalhista: ' . $_POST['trabalhista']);
        break;
}
$pdf->Cell(0, 10, '', 0, 1);
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 15, 'Comprovante Anexado', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 12);
if (isset($_FILES['comprovante']) && $_FILES['comprovante']['error'] === UPLOAD_ERR_OK) {
    $file_temp_path = $_FILES['comprovante']['tmp_name'];
    $file_name = $_FILES['comprovante']['name'];
    $file_name_parts = explode(".", $file_name);
    $file_extension = strtolower(end($file_name_parts));

    $file_content = file_get_contents($file_temp_path);
    $attachment_height = ($pdf->getPageHeight() - $pdf->GetY()) * 0.8;
    $pdf->Image(
        $file_temp_path, // File
        $pdf->GetX(),               // X coordinate
        $pdf->GetY(),               // Y coordinate
        0,              // Width
        $attachment_height,               // Height
        '',               // Type (inferred from file extension)
        '',              // Link
        '',              // Align
        true,             // Resize
        300,              // DPI
        'C',               // PAlign
        false,            // IsMask
        false,            // ImgMask
        0,                // Border
        false,            // FitBox
        false,            // Hidden
        true,            // FitOnPage
        false,            // Alt
        []                // AltImgs
    );
} else {
    $pdf->Cell(0, 10, 'Nenhum documento foi anexado.', 0, 1, 'C');
}

$pdf_data = $pdf->Output('temp_file.pdf', 'S');
file_put_contents('pdfs-formularios/temp_file.pdf', $pdf_data);

$date = new DateTime();
$final_file_name = $date->format("Y-m-d-H-i-s ") . '.pdf';
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Formulário de Justificativa de Falta</title>

</head>

<body>
    <header>
        <div class="topo">
            <div class="fundo"><img src="img/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo"></div>
            <div class="fundo2"><img src="img/logo-fatec_itapira.png" alt="logo" class="logo-fatec"></div>
        </div>
        <nav>
            <a href="index-professor.html" class="botao-nav">Início</a>
            <a href="enviar-formularios.html" class="botao-nav">Enviar formulário</a>
            <a href="lista-enviados.html" class="botao-nav">Formulários enviados</a>
            <a href="#" class="botao-nav">Sair</a>
        </nav>
    </header>
    <main>
        <h1 style="text-align: center; margin:0; padding-bottom: 25px;">Revise os dados preenchidos antes de enviar o formulário</h1>
        <div style="display: flex; justify-content: center; align-items: center;">
            <embed src="pdfs-formularios/pdf-justifativa.pdf" type="application/pdf" width="60%" height="1200px" />
        </div>
        <form method="POST" action="save-pdf.php">
            <input type="hidden" name="file_name" value="<?= $final_file_name ?>">
            <div style="display: flex; justify-content: center;">
                <input style="margin-top: 25px; padding: 20px; width: 500px;" type="submit" value="Enviar">
                <button onclick="history.go(-2);">Corigir dados</button>
            </div>
        </form>
    </main>
    <footer class="site-footer">
        <div class="footer">
            <img src="img/logo-governo-do-estado-sp.png" alt="logo" class="logo-governo-rodape">
            <p class="rodape">Fatec Ogari de Castro Pacheco - Rua Tereza Lera Paoletti, 570/590 - Jardim Bela Vista - CEP: 13974-080</p>
            <p class="rodape">Telefone: (19) 3843-1996 | (19) 3863-5210 (WhatsApp)</p>
            <p class="rodape">&copy; 2024 Equipe 6Tec. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>