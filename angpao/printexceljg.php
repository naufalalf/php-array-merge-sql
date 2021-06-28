<?php
 $tgl=date('Y-m-d');

		
						header("Content-type: application/vnd-ms-excel");
						header("Content-Disposition: attachment; filename=jaksa-toko-".$tgl.".xls");
						include 'jaksa-global.php';
	
?>

