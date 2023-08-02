<?php

if(isset($_POST['download'])) {
    $filename = "example.php";
    header("Content-Disposition: attachment; filename=" . $filename);
    header("Content-Type: application/octet-stream");
    readfile($filename);
    exit();
 }
 
?>