<?php
    $file_name = $_POST['file_name'];
    $final_path = 'pdfs-formularios/' . $file_name;
    
    if(rename('pdfs-formularios/temp_file.pdf', $final_path)){
        echo 'deu certo!';
    } else {
        echo 'deu errado...';
    }
?>