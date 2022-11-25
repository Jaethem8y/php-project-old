<?php
    $filepath = "pics/".$_GET['file'];
    $filename = $_GET['file'];

    if(!is_file($filepath)||!file_exists($filepath)){
        echo "파일이 존재하지 않습니다";
        exit;
    }
    $path_parts = pathinfo($filepath);
    $file_name = $path_parts['basename'];
    $file_size = filesize($filepath);

    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=".$file_name."");
    header("Content-Transfer_Encoding: binary");
    header("Content-Lenght: ".$file_size);
    header("Pragma: no-cache");
    header("Expires: 0");
    
    $fp = fopen($filepath,"r");
    fpassthru($fp);
    fclose($fp);
?>