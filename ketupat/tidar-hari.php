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
      //query 88.99
      $sql = mysqli_query($conn, 
              "SELECT 
                    y.tgl as 'tgl',
                    sum(y.jml_belanja) as 'blnj',
                    sum(y.nomin) as 'nomin',
                    y.store as 'store'
              FROM(SELECT 
                    date(c.tgl_undian) as tgl,
                    count(c.no_sales) as 'jml_sales',
                    c.jml_belanja,
                    sum(d.nominal) as 'nomin',
                    c.store
                    FROM log_undian as c
                    LEFT JOIN tbl_undian as d ON c.id_vocer=d.id
                    where c.store='TMTDT'
                    GROUP BY c.no_member , c.no_sales) as Y
              GROUP BY tgl, store");
       while ($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
        $rowr[]=$row;
       }
             $store = $rowr[0][3];

              if ($store='TMTDT') {
                $store= 'Toeng Market Tidar';
              } 
              
      //query tidar
      $querytdr = mysqli_query($conn1, 
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
              WHERE c.method_id='18' AND date(a.createtime)>='2021-05-18' AND date(a.createtime)<='$currdate' 
              AND f.id='15'
              GROUP by a.docdate");
       while ($data_q = mysqli_fetch_array($querytdr,MYSQLI_NUM)){
          $dtq[]=$data_q;
        }
 
        $newArray=array($rowr,$dtq);
        $result=array();
        foreach ($newArray as $value) {
            $result=array_merge($rowr,$dtq);
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
             
              
          $c=count($dtq);
          $w=1;
           for($i=0; $i<$c; $i++){
             

            $docdate = $dtq[$i][0];
            $fid     = $dtq[$i][3];

            $tgl    = $rowr[$i][0];
            $store  = $rowr[$i][3];



            error_reporting (E_ALL ^ E_NOTICE); 
            $x=$i+31;
            echo "<tbody>";
            echo "<tr>";
              echo "<td style='padding:3px'>"."<center>".$w++."</center>"."</td>";
            if ($i<31) {
              echo "<td>"."<center>".$result[$i][0]."</center>"."</td>";
              echo "<td>"."<center>".$result[$i][1]."</center>"."</td>";
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