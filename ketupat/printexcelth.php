<?php
 $tgl=date('Y-m-d');

		
						header("Content-type: application/vnd-ms-excel");
						header("Content-Disposition: attachment; filename=tidar-hari-".$tgl.".xls");
						include 'tidar-hari.php';
	
?>

