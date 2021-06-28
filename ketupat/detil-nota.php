<style>
  table {
    font-family: arial, sans-serif;
    font-size: 15px;
    border-collapse: collapse;
    width: 100%;
    background-color: #fff;
  }

  td, th {
    border: 2px solid #dddddd;
    text-align: left;
    padding: 0px;
  }

  tr:nth-child(even) {
    background-color: #ffffff;
  }
  h3,h4{
    color: #fff;
    border-color: #000;
  }
  body{
    background-image: url('ketupat.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }
</style>

<?php
include 'koneksi.php';
	
		if(isset($_GET['storeid']) AND isset($_GET['tgl']) ){
            $fid     = $_GET['storeid'];
            $docdate = $_GET['tgl'];
 error_reporting (E_ALL ^ E_NOTICE); 
    }
     
     if($fid=='15'){ //tidar
        $mid ='18';
        $kon =$conn1;
     }elseif($fid=='4'){ //jaksa
        $mid ='10';
        $kon =$conn2;
     }elseif($fid=='11'){ //cyber
        $mid ='18';
        $kon =$conn3;
     }else{

     }
         error_reporting (E_ALL ^ E_NOTICE); 

 		$sql = mysqli_query($kon, 
              "SELECT 
                a.docdate,
                a.docnum ,
                sum(a.totalnet) as tonet,  
                sum(c.amount) as amt,
                count(c.amount) as jmlvcr,
                d.description,
                f.id
              FROM sales as a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
              WHERE c.method_id='$mid' AND f.id='$fid' AND a.docdate = '$docdate' 
              GROUP BY a.docdate, a.docnum 
              ORDER BY a.docdate asc");

             $row= mysqli_fetch_array($sql);

        if($fid=='15'){
               error_reporting (E_ALL ^ E_NOTICE); 
          $fid='Toeng Market Tidar';
        }elseif ($fid=='4') {
               error_reporting (E_ALL ^ E_NOTICE); 
          $fid='Toeng Market Jaksa Agung';
        }elseif ($fid=='11') {
               error_reporting (E_ALL ^ E_NOTICE); 
          $fid='Toeng Market Cyber Malang';
        }else{

        }

    error_reporting (E_ALL ^ E_NOTICE); 
    echo "<center><h4 style='margin-top:20px'>Toko : ".$fid."</h4></center>";
    echo "<center><h4>Tanggal : ".$docdate."</h4></center>";
		 echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:80%;margin-bottom:30px' align='center'>";

             echo "<thead>";
               echo " <tr style='background-color: #ffd700' style='padding:100px'>";
               echo "   <th style='padding:5px'><center>No</center></th>";
               echo "   <th><center>Tanggal Claim</center></th>";
               echo "   <th><center>No Nota</center></th>";
               echo "   <th><center>Total Belanja</center></th>";
               echo "   <th><center>Total Voucher</center></th>";
               echo "   <th><center>Banyak Voucher</center></th>";
               echo "   <th><center>Jenis Voucher</center></th>";
               echo "   <th><center>Prosentase </center></th>";
               echo " </tr>";
             echo "</thead>";
             echo "<tbody>";
            

          $x = 1;
          do{
          echo "<tr>";
            echo "<td style='padding:3px'>"."<center>".$x++."</center>"."</td>";
            echo "<td>"."<center>".$row['docdate']."</center>"."</td>";
            echo "<td>"."<center>".$row['docnum']."</center>"."</td>";
            echo "<td>"."<center>".$row['tonet']."</center>"."</td>";
            echo "<td>"."<center>".$row['amt']."</center>"."</td>";
            echo "<td>"."<center>".$row['jmlvcr']."</center>"."</td>";
            echo "<td>"."<center>".$row['description']."</center>"."</td>";
            $bagi = ($row['amt'] / $row['tonet']);
            $persen = $bagi * '100';
             echo "<td>"."<center>".number_format($persen,2)." %"."</center>"."</td>";
          echo "</tr>";
          }while($row= mysqli_fetch_array($sql));


        if($fid=='Toeng Market Tidar'){
               error_reporting (E_ALL ^ E_NOTICE); 
          $fid='15';
          $kon =$conn1;
        }elseif ($fid=='Toeng Market Jaksa Agung') {
               error_reporting (E_ALL ^ E_NOTICE); 
          $fid='4';
          $kon =$conn2;
        }elseif ($fid=='Toeng Market Cyber Malang') {
               error_reporting (E_ALL ^ E_NOTICE); 
          $fid='11';
          $kon =$conn3;
        }else{

        }


          $tot = mysqli_query($kon, "SELECT a.docdate, sum(a.totalnet) as tonet, sum(c.amount) as amtt, f.id
              FROM sales as a LEFT JOIN payment b ON b.sales_id=a.id LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id WHERE c.method_id='".$mid."' AND f.id='".$fid."' AND a.docdate = '".$docdate."' GROUP BY a.docdate");
          $totrow= mysqli_fetch_assoc($tot);

          echo "<tr>";
          echo "<td colspan='3'>"."<center>"."<b>"."TOTAL VOUCHER DICLAIM"."</b>"."</center>"."</td>";
          echo "<td colspan='5' style='padding:10px'>"."<center>"."<b>"."Rp ".number_format($totrow['amtt'],2,',','.')."</b>"."</center>"."</td>";
           echo "</tr>";

          echo "</tbody>";
        echo "</table>";
      echo "</table>";
 ?>