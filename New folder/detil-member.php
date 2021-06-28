<style>
  table {
    font-family: arial, sans-serif;
    font-size: 15px;
    border-collapse: collapse;
    width: 100%;

  }

  td, th {
    border: 2px solid #dddddd;
    text-align: left;
    padding: 0px;
  }

  tr:nth-child(even) {
    background-color: #ffffff;
  }
</style>

<?php
include 'koneksi.php';

   
        if (isset($_GET['member']) and isset($_gET['sales'])) {
          // $nomem=$_GET['member'];
          // $nosal=$_GET['sales'];
            
          }

          $nomem='1001699619421107';



		$sqlq = mysqli_query($conn, 
              "SELECT 
	              a.email as email,
	              a.no_member as nomember,
	              a.nm_member as nama, 
	              date(a.tgl_undian) as tgl, 
	              count(a.no_sales) as nosel, 
	              b.nominal as nomin
              FROM log_undian as a 
              LEFT JOIN tbl_undian as b ON a.id_vocer=b.id 
              WHERE a.no_member='".$nomem."' 
              GROUP by b.nominal 
              ORDER BY a.tgl_undian ASC");

              $rows= mysqli_fetch_array($sqlq);


		 echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%;margin-bottom:100px' align='center'>";
          
         	 echo "No Member : ".$nomem." <br>";
         	 echo "Nama Member : ".$rows['nama'];
             echo "<thead>";
               echo " <tr style='background-color: #f9ffa1'>";
               echo "   <th><center>No</center></th>";
               echo "   <th><center>Tanggal Undian</center></th>";
               echo "   <th><center>Nominal Voucher</center></th>";
               echo "   <th><center>Jumlah</center></th>";
               echo " </tr>";
             echo "</thead>";
             echo "<tbody>";
            
          $x = 1;
          do{
          echo "<tr>";
            echo "<td>"."<center>".$x++."</center>"."</td>";
            echo "<td>"."<center>".$rows['tgl']."</center>"."</td>";
            echo "<td>"."<center>".$rows['nomin']."</center>"."</td>";
            echo "<td>"."<center>".$rows['nosel']."</center>"."</td>";
          echo "</tr>";
          }while($rows = mysqli_fetch_array($sqlq));

          $tot = mysqli_query($conn,"SELECT a.no_member as nomember, sum(b.nominal) as nomin
              FROM log_undian as a LEFT JOIN tbl_undian as b ON a.id_vocer=b.id 
              WHERE a.no_member='".$nomem."'");
          $totmem= mysqli_fetch_assoc($tot);
          echo "<tr>";
          echo "<td colspan='2'>"."<center>"."<b>"."TOTAL VOUCHER REDEEM"."</b>"."</center>"."</td>";
          echo "<td colspan='2' style='padding:px'>"."<center>"."<b>"."Rp".number_format($totmem['nomin'],2,',','.')."</b>"."</center>"."</td>";
          echo "</tr>";
          echo "</tbody>";
          echo "</table>";
          echo "</table>";

 ?>