<?php include 'koneksi.php'; ?>
<?php
    echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%; font-size:20px;' align='center'>";

             echo "<center><h4>Toko : JAKSA</h4></center>";
             echo "<thead>";
               echo " <tr style='background-color: #f9ffa1'>";
               echo "   <th><center>No</center></th>";
               echo "   <th><center>Tanggal Undi</center></th>";
               echo "   <th><center>Total Voucher Keluar</center></th>";
               echo "   <th><center>Tanggal Claim</center></th>";
               echo "   <th><center>Nominal Sales</center></th>";
               echo "   <th><center>Total Voucher Kembali</center></th>";
               echo " </tr>";
             echo "</thead>";
            
            //query1
             $sql = mysqli_query($conn, 
              "SELECT 
                    date(a.tgl_undian) as tgl,
                    count(a.no_sales) as nosel,
                    sum(b.nominal) as nomin
              FROM log_undian as a
              LEFT JOIN tbl_undian as b ON a.id_vocer=b.id
              where a.store='TMTDT'
               group by tgl order by tgl asc");

             $data = mysqli_fetch_array($sql,MYSQLI_ASSOC);


      echo "<br>";
             //query2
            $sqlq = mysqli_query($conn1, 
              "SELECT 
                count(a.docnum) as dcm, 
                a.docdate as dcdate,
                sum(a.totalnet) as tnet,
                sum(c.amount) as amt
              FROM sales a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
              WHERE c.method_id='18' AND date(a.createtime)>='2021-02-01' AND date(a.createtime)<='2021-02-28' AND f.id='15'
              group BY a.docdate
              ORDER BY a.docdate asc");



           // while(
            $dataq = mysqli_fetch_array($sqlq,MYSQLI_ASSOC);
          // ){

           
            // echo "<pre>";
            //      print_r($dataq);
            // echo "</pre>";
            // echo $dataq['amt'];
           // }
        
           
          
          //query union 
          $data3= array_merge($data,$dataq);
        print_r($data3);
        // echo "<br>";
        // print_r($dataq);
        // echo "<br>";
        // print_r($data);
          
          echo "<tbody>";
          $tgl = date('Y-m-d');
          $y=1;
          
        
        foreach ($data3 as $key) {
        
          echo "<tr>";
                echo "<td>"."<center>".$y++."</center>"."</td>";
                echo "<td>"."<center>".isset($key['tgl'])."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format(isset($key['nomin']),2,',','.')."</center>"."</td>";
                echo "<td>"."<center>".isset($key['dcdate'])."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format(isset($key['tnet']),2,',','.')."</center>"."</td>";
                echo "<td>"."<center>"."Rp ".number_format(isset($key['amt']),2,',','.')."</center>"."</td>";
          echo "</tr>";
         
        } 
          echo "</tbody>";
        echo "</table>";
  echo "</table>";


// print_r($dataq);
// echo "<br>";
// print_r($data);
// $data3=array_merge($data,$dataq);
// echo "<br>";
// print_r($data3);
// echo "<br>";
// echo $data3[0]." ";
// echo "<br>";
// echo $data3[2]." ";
// echo " ". $data3[4];
// echo "<br>";
// $data1=array('a','b','c','d','e','f');
// $data2=array('1','2','3','4','5','6');
// //datd3 adalah gabungann dari array data1 dan data2
// $data13=array_merge($data1,$data2);
// print_r($data13);
// while($data3){
//    echo "<td>"."<center>".$data3[0]."</center>"."</td>";
//                  echo "<td>"."<center>".$data3[1]."</center>"."</td>";
//                  echo "<td>"."<center>".$data3[2]."</center>"."</td>";
//                  echo "<td>"."<center>".$data3[3]."</center>"."</td>";
// }

 ?>