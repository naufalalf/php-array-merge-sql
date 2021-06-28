<?php include 'koneksi.php'; ?>

<?php
		echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%' align='center'>";

             echo "<center><h4>Toko : Toeng Market Jaksa Agung</h4></center>";
             echo "<thead>";
               echo " <tr style='background-color: #f9ffa1'>";
               echo "   <th><center>No</center></th>";
               echo "   <th><center>Tanggal Undian</center></th>";
               echo "   <th><center>Email</center></th>";
               echo "   <th><center>No Member</center></th>";
               echo "   <th><center>Nama Member</center></th>";
               echo "   <th><center>No Sales </center></th>";
               echo "   <th><center>Total Voucher</center></th>";
               echo " </tr>";
             echo "</thead>";
             echo "<tbody>";
             // $halaman = 25;
             // $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
             // $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;

             // $result = mysqli_query($conn,"select a.* FROM log_undian as a LEFT JOIN tbl_undian as b ON a.id_vocer=b.id
             //  where a.store='TMJKT'
             //  GROUP BY a.no_member ORDER BY a.tgl_undian ASC");
            
             // $total = mysqli_num_rows($result);
             // $pages = ceil($total/$halaman);
             $sql = mysqli_query($conn, 
              "SELECT 
                    date(a.tgl_undian) as tgl,
                    a.email,
                    a.no_member as nomem , 
                    a.nm_member as namem,
                    a.no_sales as nosel,
                    sum(b.nominal) as nomin
              FROM log_undian as a
              LEFT JOIN tbl_undian as b ON a.id_vocer=b.id
              where a.store='TMJKT'
              GROUP BY a.no_member ORDER BY a.tgl_undian ASC
             ");
             $no=1;

          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>"."<center>".$no++."</center>"."</td>";
            echo "<td>"."<center>".$data['tgl']."</center>"."</td>";
            echo "<td>"."<center>".$data['email']."</center>"."</td>";
            echo "<td>"."<center>".$data['nomem']."</center>"."</td>";
            echo "<td>"."<center>".$data['namem']."</center>"."</td>";
            echo "<td>"."<center>".$data['nosel']."</center>"."</td>";
            echo "<td>"."<center>".$data['nomin']."</center>"."</td>";
          echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
              // echo "<div class=' ' align='center' style='margin-top:5px'>";
              // for( $i=1; $i<=$pages; $i++){

              //   echo "<a href='?halaman=$i' style='margin-left:2px; margin-right:2px'>".$i."</a>";
              //   }
              //   echo "</div>";
          echo "</table>";

         echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%' align='center'>";
          echo "<h4 style='margin: 20px 0px 15px 0px;'><center>DATA CLAIM VOUCHER ANGPAO ONTOENG</center></h4>";
          echo "<thead>";
            echo  "<tr style='background-color: #f9ffa1; margin-top: 40px'>";
            echo      "<th><center>No</center></th>";
            echo      "<th><center>Tanggal Claim</center></th>";
            echo      "<th><center>Email</center></th>";
            echo      "<th><center>No Member</center></th>";
            echo      "<th><center>Nama Member</center></th>";
            echo      "<th><center>No Sales</center></th>";
            echo      "<th><center>Voucer Claimed</center></th>";
            echo  "</tr>";
          echo "</thead>";
          echo "<tbody>";
         //    $halaman1 = 25;
         //     $page1 = isset($_GET['halaman1']) ? (int)$_GET['halaman1'] : 1;
         //     $mulai1 = ($page1>1) ? ($page1 * $halaman1) - $halaman1 : 0;

         //     $result1 = mysqli_query($conn2,"select a.*  FROM sales a
         //      LEFT JOIN payment b ON b.sales_id=a.id
         //      LEFT JOIN paymentdetail c ON c.payment_id=b.id
         //      LEFT JOIN paymethod d ON d.id=c.method_id
         //      LEFT JOIN members e ON a.member_id=e.id
         //      left join location f on a.location_id=f.id
         //       WHERE c.method_id='10' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-02-28' AND f.id='4'
         //      GROUP by a.docnum");
            
         //     $total1 = mysqli_num_rows($result1);
         //     $pages1 = ceil($total1/$halaman1);

            $sqlq = mysqli_query($conn2, 
              "SELECT 
                a.docdate,
                e.email, 
                e.cardno,
                a.docnum,  
                e.name, 
                sum(c.amount) as amt
              FROM sales a
              LEFT JOIN payment b ON b.sales_id=a.id
              LEFT JOIN paymentdetail c ON c.payment_id=b.id
              LEFT JOIN paymethod d ON d.id=c.method_id
              LEFT JOIN members e ON a.member_id=e.id
              left join location f on a.location_id=f.id
               WHERE c.method_id='10' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-02-28' AND f.id='4'
              GROUP by a.docnum");
             $no1=1;

          while($dataq = mysqli_fetch_array($sqlq)){
          echo "<tr>";
                echo "<td>"."<center>".$no1++."</center>"."</td>";
                echo "<td>"."<center>".$dataq['docdate']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['email']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['cardno']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['name']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['docnum']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['amt']."</center>"."</td>";
          echo "</tr>";
          }
          echo "</tbody>";
          echo "</table>";
         //  echo "<div class=' ' align='center' style='margin-top:5px'>";
         //    for( $i=1; $i<=$pages; $i++){
         //  echo "<a href='?halaman=$i' style='margin-left:2px; margin-right:2px'>".$i."</a>";
         //  }
         //  echo "</div>";
          echo "</table>";
 ?>
