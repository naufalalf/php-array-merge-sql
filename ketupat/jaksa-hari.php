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

      $currdate = date("Y-m-d");
      //query88.99
      $sql = mysqli_query($conn, 
              "SELECT 
                    x.tgl as 'tgl',
                    sum(x.jml_belanja) as 'blnj',
                    sum(x.nomin) as 'nomin',
                    x.store as 'store'
              FROM(SELECT 
                    date(a.tgl_undian) as tgl,
                    count(a.no_sales) as 'jml_sales',
                    a.jml_belanja,
                    sum(b.nominal) as 'nomin',
                    a.store
                    FROM log_undian as a
                    LEFT JOIN tbl_undian as b ON a.id_vocer=b.id
                    where a.store='TMJKT' 
                    GROUP BY a.no_member , a.no_sales) as X
              GROUP BY tgl, store");
      while ($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
        $rows[]=$row;
      }
            $store = $rows[0][3];

            if ($store='TMJKT') {
                $store= 'Toeng Market Jaksa Agung';
            }

      //query jaksa
       $sqlq = mysqli_query($conn2, 
              "SELECT 
                a.docdate,
                sum(a.totalnet) as tonet,   
                sum(c.amount) as amt,
                f.id as 'fid',
                c.method_id as 'mid'
              FROM sales a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
               WHERE c.method_id='10' AND date(a.createtime)>='2021-05-18' AND date(a.createtime)<='$currdate' AND f.id='4'
              GROUP by a.docdate");  
       while ($dataq = mysqli_fetch_array($sqlq,MYSQLI_NUM)){
          $datq[]=$dataq;
        }
        
        $newArray=array($rows,$datq);
        $result=array();
        foreach ($newArray as $value) {
            $result=array_merge($rows,$datq);
        }

		echo "<table style='width: 100%'>";
        echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%' align='center'>";

             echo "<center><h4>Toko : $store</h4></center>";
             echo "<thead>";
               echo "<tr style='background-color: #ffd700'>";
               echo " <th rowspan='2'><center>No</center></th>";
               echo " <th colspan='3' style='padding:5px'><center>Redeem Voucher</center></th>";
               echo " <th colspan='3'><center>Claim Voucher</center></th>";
               echo " <th colspan='2'><center>Prosentase</center></th>";
               echo "</tr>";
               echo "<tr style='background-color: #ffd700'>";
               echo "   <th style='padding:5px'><center>Tanggal Undian</center></th>";
               echo "   <th><center>Nominal Sales</center></th>";
               echo "   <th><center>Total Voucher Keluar</center></th>";
               echo "   <th><center>Tanggal Claim </center></th>";
               echo "   <th><center>Nominal Sales </center></th>";
               echo "   <th><center>Total Voucher Claim </center></th>";
               echo "   <th><center>Voucher Claim </center></th>";
               echo "</tr>";
             echo "</thead>";
             echo "<tbody>";
          

           $c=count($datq);
           $y=1;
           for($i=0; $i<$c; $i++){
             
            $docdate = $datq[$i][0];
            $fid     = $datq[$i][3];


            $tgl    = $rows[$i][0];
            $store  = $rows[$i][3]; 

            error_reporting (E_ALL ^ E_NOTICE); 
            $x=$i+31;

            echo "<tbody>";
            echo "<tr>";
              echo "<td style='padding:3px'>"."<center>".$y++."</center>"."</td>";
            if ($i<31) {
              echo "<td>"."<center>".$result[$i][0]."</center>"."</td>";
              echo "<td>"."<center>".$result[$i][1]."</center>"."</td>";
              // echo "<td>"."<center>".$result[$i][4]."</center>"."</td>";
              echo "<td>"."<center>"."<a target='_blank' href='detil-hari.php?tgl=$tgl&store=$store' method='GET'>".$result[$i][2]."</center>"."</td>";     
            }elseif (!$i<31) {
              echo "<td>"."<center>"." "."</center>"."</td>";
              echo "<td>"."<center>"." "."</center>"."</td>";
              echo "<td>"."<center>"." "."</center>"."</td>";  
            }
              echo "<td>"."<center>".$result[$x][0]."</center>"."</td>";
              echo "<td>"."<center>".$result[$x][1]."</center>"."</td>";
              echo "<td>"."<center>"."<a target='_blank' href='detil-nota.php?tgl=$docdate&storeid=$fid' method='GET'>".$result[$x][2]."</center>"."</td>";
              $bagi= ($result[$x][2] / $result[$x][1]);
              $persen = $bagi * 100;
              echo "<td>"."<center>".number_format($persen,2)." %"."</center>"."</td>";
            echo "</tr>";
            echo "</tbody>";
          }
        echo "</table>";
    echo "</table>";

 ?>
