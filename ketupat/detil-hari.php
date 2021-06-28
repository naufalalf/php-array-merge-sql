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
    background-size: cover;
  }
</style>

<?php
include 'koneksi.php';
	
		if(isset($_GET['tgl']) AND isset($_GET['store'])){
            $tgl=$_GET['tgl'];
            $store=$_GET['store']; 
            error_reporting (E_ALL ^ E_NOTICE); 
    }
         error_reporting (E_ALL ^ E_NOTICE); 


 		$sql = mysqli_query($conn, 
              "SELECT 
                    date(a.tgl_undian) as tgl,
                    a.email as email,
                    a.no_member as no_mem , 
                    a.nm_member as namem,
                    a.no_sales as no_sal,
                    count(a.no_sales) as totvo,
                    sum(b.nominal) as nomin,
                    a.store as store
              FROM log_undian as a
              LEFT JOIN tbl_undian as b ON a.id_vocer=b.id
              where date(a.tgl_undian)='".$tgl."' and a.store='".$store."'
              GROUP BY a.no_sales, tgl
              ORDER BY a.tgl_undian ASC");

             $row= mysqli_fetch_array($sql);

        if($store=='TMTDT'){
               error_reporting (E_ALL ^ E_NOTICE); 
          $store='Toeng Market Tidar';
        }elseif ($store=='TMJKT') {
               error_reporting (E_ALL ^ E_NOTICE); 
          $store='Toeng Market Jaksa Agung';
        }elseif ($store=='TMMLC') {
               error_reporting (E_ALL ^ E_NOTICE); 
          $store='Toeng Market Cyber Malang';
        }else{

        }

echo $docdate;

    error_reporting (E_ALL ^ E_NOTICE); 
    echo "<center><h4 style='margin-top:20px'>Toko : ".$store."</h4></center>";
    echo "<center><h4>Tanggal : ".$tgl."</h4></center>";
		 echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%;margin-bottom:30px' align='center'>";

             echo "<thead>";
               echo " <tr style='background-color: #ffd700' style='padding:100px'>";
               echo "   <th style='padding:5px'><center>No</center></th>";
               echo "   <th><center>Tanggal Undian</center></th>";
               echo "   <th><center>Email</center></th>";
               echo "   <th><center>No Member</center></th>";
               echo "   <th><center>Nama Member</center></th>";
               echo "   <th><center>No Sales </center></th>";
               echo "   <th><center>Total Voucher </center></th>";
               echo "   <th><center>Nominal Voucher</center></th>";
               echo " </tr>";
             echo "</thead>";
             echo "<tbody>";
            

          $x = 1;
          do{
            
            $no_mem  = $row['no_mem'];
            $no_sal  = $row['no_sal'];
            $store   = $row['store'];

          echo "<tr>";
            echo "<td style='padding:3px'>"."<center>".$x++."</center>"."</td>";
            echo "<td>"."<center>".$row['tgl']."</center>"."</td>";
            echo "<td>"."<center>".$row['email']."</center>"."</td>";
            echo "<td>"."<center>".$no_mem."</center>"."</td>";
            echo "<td>"."<center>".$row['namem']."</center>"."</td>";
            echo "<td>"."<center>".$no_sal."</center>"."</td>";
            echo "<td>"."<center>".$row['totvo']."</center>"."</td>";
           echo "<td>"."<center>".$row['nomin']."</center>"."</td>";
          echo "</tr>";
          }while($row= mysqli_fetch_array($sql));

          $tot = mysqli_query($conn, "SELECT date(a.tgl_undian) as tgl, sum(b.nominal) as nomin, a.store as store FROM log_undian as a LEFT JOIN tbl_undian as b ON a.id_vocer=b.id where a.store='$store' and date(a.tgl_undian)='$tgl' GROUP BY tgl");
          $totrow= mysqli_fetch_assoc($tot);
          echo "<tr>";
          echo "<td colspan='3'>"."<center>"."<b>"."TOTAL VOUCHER KELUAR"."</b>"."</center>"."</td>";
          echo "<td colspan='5' style='padding:10px'>"."<center>"."<b>"."Rp ".number_format($totrow['nomin'],2,',','.')."</b>"."</center>"."</td>";
          echo "</tr>";

          echo "</tbody>";
        echo "</table>";
      echo "</table>";
 ?><!-- 
     <h3 style="margin: 20px 40px 10px 135px;">Ekspor Laporan Excel</h3>
      <div class="col-sm-4" style="margin: 0 650px 0 135px;">
        <form class="" action="printexceldh.php" method="post">
        <table>
        <tr>
          <td> 
            <label>&nbsp;</label>
            <button style="padding: 0.50rem 0.5rem;width: 65px;" id="start"
             class="btn btn-sm btn-success" type="submit" name="button">Ekspor</button>
          </td>

        </tr>
        </table>
        </form>
      </div>
        
        <div class="col-12">
          <a href="" id="cetak" name="cetak" class="jangan_cetak btn btn-default"><i class="fa fa-print"></i></a>
          <a href="export-equipment.php" class="btn btn-default"><i class="fa fa-file-excel-o"></i></a>
        </div> -->
