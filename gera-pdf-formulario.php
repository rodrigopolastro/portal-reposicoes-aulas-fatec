<?php
require 'vendor/autoload.php';

class CustomTCPDF extends TCPDF {
    // public function Header() {
    //     $image_file = 'img/logo-fatec_itapira.png'; // Replace with your image file path
    //     $this->Image($image_file, 10, 10, 200, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);   
    // }
}

$pdf = new CustomTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetTitle('Formulário de Justificativa de Faltas');
$pdf->AddPage();

$pdf->Cell(0, 10, 'Fatec "Ogari de Castro Pacheco - Itapira' , 0, 1);
$pdf->Cell(0, 10, $_POST['nome'], 0, 1);
$pdf->Cell(0, 10, $_POST['matricula'], 0, 1);
$pdf->Cell(0, 10, 'Cursos: ', 0, 1);
foreach($_POST['cursos'] as $curso){
    $pdf->Cell(0, 10, $curso, 0, 1);
}
if($_POST['tipo_periodo'] == 'dia'){
    $pdf->Cell(0, 10, $_POST['data_dia'], 0, 1);
} elseif ($_POST['tipo_periodo'] == 'periodo'){
    $string = 'Início: ' . $_POST['inicio_periodo'] . ' Fim: ' . $_POST['fim_periodo'];
    $pdf->Cell(0, 10, $string, 0, 1);
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