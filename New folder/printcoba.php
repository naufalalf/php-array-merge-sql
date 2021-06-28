<?php
 $tgl=date('Y-m-d');

    
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=cobalagi-".$tgl.".xls");
            include 'cobalagi.php';
  
?>

