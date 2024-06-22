<?php
require 'vendor/autoload.php';

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



// var_dump($_FILES);
var_dump($_POST);

$pdf = new CustomTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

$pdf->SetTitle('Formulário de Justificativa de Faltas');
$pdf->AddPage();
// var_dump($_POST['nome']);

// Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Cell(0, 10, 'Dados do Professor', 0, 1, 'C');
$pdf->Cell(0, 10, 'Nome: ' . $_POST['nome'], 0, 1);
$pdf->Cell(0, 10, 'Matrícula: ' . $_POST['matricula'], 0, 1);
$pdf->write(10, 'Cursos: ');
foreach ($_POST['cursos'] as $curso) {
    $pdf->write(10, strtoupper($curso) . ',');
}
$pdf->Cell(0, 10, '', 0, 1);
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
$pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetX() + 180, $pdf->GetY());
$pdf->Cell(0, 10, 'Motivo da Falta', 0, 1, 'C');
switch ($_POST['tipo_falta']) {
    case 'licenca_medica':
        $pdf->Cell(0, 10, $_POST['tipo_licenca_medica'], 0, 0);
        if($_POST['motivo_falta_medica']){
            $pdf->Cell(0, 10, $_POST['motivo_falta_medica'], 0, 0);
        } elseif($_POST['comparecimento_inicio'] && $_POST['comparecimento_fim']){
            $pdf->Cell(0, 10, $_POST['comparecimento_inicio'] . ' às ' . $_POST['comparecimento_fim'], 0, 0);
        }
        break;
    case 'falta_injustificada':
        $pdf->Cell(0, 10, $_POST['tipo_falta '], 0, 0);
        break;
    case 'falta_justificada':
        break;
    case 'legislacao_trabalhista':
        break;
}
$pdf->Cell(0, 10, '', 0, 1, '');

if (isset($_FILES['comprovante']) && $_FILES['comprovante']['error'] === UPLOAD_ERR_OK) {
    $file_temp_path = $_FILES['comprovante']['tmp_name'];
    $file_name = $_FILES['comprovante']['name'];
    $file_name_parts = explode(".", $file_name);
    $file_extension = strtolower(end($file_name_parts));

    $pdf->Cell(0, 20, 'Comprovante Anexado:', 0, 1);
    $file_content = file_get_contents($file_temp_path);
    $pdf->Image(
        $file_temp_path, // File
        $pdf->GetX(),               // X coordinate
        $pdf->GetY(),               // Y coordinate
        $pdf->getPageWidth() * 0.8,              // Width
        0,               // Height
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
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Embedded PDF Example</title>
</head>

<body>
    <h1>Revise os dados preenchidos antes de enviar o formulário</h1>
    <embed src="pdfs-formularios/temp_file.pdf" type="application/pdf" width="100%" height="600px" />
    <form method="POST" action="save-pdf.php">
        <input type="hidden" name="file_name" value="<?= $final_file_name ?>">
        <input type="submit" value="Enviar">
    </form>
</body>

</html>