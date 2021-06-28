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
    background-image: url('imlek.png');
    background-repeat: no-repeat;
    background-size: 100% 100%;
  }
</style>

<?php 
    include 'koneksi.php'; 

      $currdate = date("Y-m-d");
      //query 88.99
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
                    FROM log_undian_baru as a
                    LEFT JOIN history_tbl_undian as b ON a.id_vocer=b.id
                    where a.store='TMMLC'
                    GROUP BY a.no_member , a.no_sales) as X
              GROUP BY tgl, store");
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
                sum(c.amount) as amt,
                f.id as 'fid'
              FROM sales a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
              WHERE c.method_id='18' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-03-31' AND f.id='11'
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
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%' align='center'>";

             echo "<center><h4>Toko : $store</h4></center>";
             echo "<thead>";
              echo " <tr style='background-color: #ffd700'>";
               echo "   <th rowspan='2'><center>No</center></th>";
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
             
            $tgl    = $rows[$i][0];
            $tosel  = $rows[$i][1];
            $store  = $rows[$i][3];

            $docdate = $datq[$i][0];
            $fid     = $datq[$i][3]; 

            error_reporting (E_ALL ^ E_NOTICE); 
            $x=$i+28;
       
            echo "<tbody>";
            echo "<tr>";
              echo "<td style='padding:3px'>"."<center>".$y++."</center>"."</td>";
            if ($i<28) {
              echo "<td>"."<center>".$result[$i][0]."</center>"."</td>";
              echo "<td>"."<center>".$result[$i][1]."</center>"."</td>";
              echo "<td>"."<center>"."<a target='_blank' href='detil-hari.php?tgl=$tgl&store=$store' method='GET'>".$result[$i][2]."</center>"."</td>";
            }elseif (!$i<28) {
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
