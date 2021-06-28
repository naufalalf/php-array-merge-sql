<?php
 $tgl=date('Y-m-d');


            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=detil-hari-".$tgl.".xls");
            include 'detil-hari.php';
  
?>

