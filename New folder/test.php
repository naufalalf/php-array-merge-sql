<style>
  table {
    font-family: arial, sans-serif;
    font-size: 15px;
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 0px;
  }

  tr:nth-child(even) {
    background-color: #ffffff;
    padding: 50px;
  }
</style>

<?php 
    include 'koneksi.php'; 

      //query 88.99
      $sql = mysqli_query($conn, 
              "SELECT 
                    date(a.tgl_undian) as tgl, 
                    count(a.no_sales) as nosel,
                    sum(b.nominal) as nomin,
                    a.store as store
              FROM log_undian as a
              LEFT JOIN tbl_undian as b ON a.id_vocer=b.id
              where a.store='TMMLC'
              GROUP BY tgl ");
      while ($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
        $rows[]=$row;
      }
              $store = $rows[0][3];

              if ($store='TMMLC') {
                $store= 'Toeng Market Cyber Malang';
              }
      
      //query cyber
        $sqlq = mysqli_query($conn3, 
              "SELECT 
                a.docdate,
                sum(a.totalnet) as tonet,  
                sum(c.amount) as amt
              FROM sales a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
              WHERE c.method_id='18' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-02-28' AND f.id='11'
              GROUP by a.docdate
              order by a.docdate asc");
        while ($dataq = mysqli_fetch_array($sqlq,MYSQLI_NUM)){
          $datq[]=$dataq;
        }

        $newArray=array($rows,$datq);
        $result=array();
        foreach ($newArray as $value) {
            $result=array_merge($rows,$datq);
        }

  echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%'  align='center'>";

             echo "<center><h4>Toko : $store</h4></center>";
             echo "<thead>";
               echo " <tr style='background-color: #f9ffa1'>";
               echo "   <th rowspan='2'><center>No</center></th>";
               echo " <th colspan='3'><center>Redeem Voucher</center></th>";
               echo " <th colspan='3'><center>Claim Voucher</center></th>";
               echo " </tr>";
               echo " <tr style='background-color: #f9ffa1'>";
               echo "   <th><center>Tanggal Undian</center></th>";
               echo "   <th><center>Jumlah Sales</center></th>";
               echo "   <th><center>Total Voucher Keluar</center></th>";
               echo "   <th><center>Tanggal Claim </center></th>";
               echo "   <th><center>Nominal Sales </center></th>";
               echo "   <th><center>Total Voucher Claim </center></th>";
               echo " </tr>";
             echo "</thead>";
             echo "<tbody>";


           $y=1;
           for($i=0; $i<28; $i++){
             
            $tgl  = $rows[$i][0];
            $tosel   = $rows[$i][1];
            $store = $rows[$i][3]; 

            error_reporting (E_ALL ^ E_NOTICE); 

            $x=$i+28;
       
            echo "<tbody>";
            echo "<tr>";
            echo "<td>"."<center>".$y++."</center>"."</td>";
            echo "<td>"."<center>".$result[$i][0]."</center>"."</td>";
            echo "<td>"."<center>".$result[$i][1]."</center>"."</td>";
            echo "<td>"."<center>"."<a target='_blank' href='detil-hari.php?tgl=$tgl&store=$store' method='GET'>".$result[$i][2]."</center>"."</td>";
            if (isset($x)) {
             echo "<td>"."<center>".$result[$x][0]."</center>"."</td>";
            echo "<td>"."<center>".$result[$x][1]."</center>"."</td>";
            echo "<td>"."<center>".$result[$x][2]."</center>"."</td>";
            }
            echo "</tr>";
            echo "</tbody>";
          }

?>