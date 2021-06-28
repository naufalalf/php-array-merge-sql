<?php include 'koneksi.php'; ?>
<?php

 echo "<table style='width: 100%; background-color:#fffff'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:80%; font-size:20px;' align='center'>";

             echo "<center><h3>Toko : Toeng Market Tidar</h3></center>";
             echo "<thead>";
               echo " <tr style='background-color: #ffd700'>";
               echo "   <th rowspan='2'><center>No</center></th>";
               echo "   <th colspan='3' style='padding:5px'><center>Redeem Voucher</center></th>";
               echo "   <th colspan='2'><center>Claim Voucher</center></th>";
               echo " <th colspan='2'><center>Prosentase</center></th>";
               echo " </tr>";
               echo " <tr style='background-color: #ffd700'>";
               echo "   <th style='padding:5px'><center>Tanggal</center></th>";
               echo "   <th><center>Nominal Sales</center></th>";
               echo "   <th><center>Total Voucher Keluar</center></th>";
               echo "   <th><center>Nominal Sales</center></th>";
               echo "   <th><center>Total Voucher Kembali</center></th>";
               echo "   <th><center>Voucher Claim </center></th>";
               echo " </tr>";
             echo "</thead>";
            
            $currdate = date('Y-m-d');

            //query1
             $sql = mysqli_query($conn, 
              "SELECT 
                    sum(x.jml_belanja) as 'blnj',
                    sum(x.nomin) as 'nomin'
              FROM(
                  SELECT 
                      date(a.tgl_undian) as 'tgl',
                      count(a.no_sales) as 'jml_sales',
                      a.store, a.jml_belanja,
                      sum(b.nominal) as 'nomin'
                    FROM log_undian_baru as a
                    LEFT JOIN history_tbl_undian as b ON a.id_vocer=b.id
                    where a.store='TMTDT'
                    GROUP BY a.no_member , a.no_sales) as X
              GROUP BY x.store");

             $data = mysqli_fetch_array($sql,MYSQLI_NUM);
    
             //query2
            $sqlq = mysqli_query($conn1, 
              "SELECT 
                count(a.docnum) as dcm, 
                sum(a.totalnet) as tnet,
                sum(c.amount) as amt
              FROM sales a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
              WHERE c.method_id='18' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-03-31' AND f.id='15'");
          
           $dataq = mysqli_fetch_array($sqlq,MYSQLI_NUM);


        
          
          //query union 
          $data3=array_merge($data,$dataq);

          $tgl = "$currdate";
          $y=1;
          echo "<tbody>";
          echo "<tr>";
                echo "<td style='padding:3px'>"."<center>".$y++."</center>"."</td>";
                echo "<td>"."<center>".$tgl."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format($data3[0],2,',','.')."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format($data3[1],2,',','.')."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format($data3[3],2,',','.')."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format($data3[4],2,',','.')."</center>"."</td>";
                $bagi= ($data3[4] / $data3[3]);
                $persen = $bagi * 100;
                echo "<td>"."<center>".number_format($persen,2)." %"."</center>"."</td>";
          echo "</tr>";
          echo "</tbody>";
        echo "</table>";
  echo "</table>";

 ?>
