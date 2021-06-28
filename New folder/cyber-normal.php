<?php include 'koneksi.php'; ?>

<?php
		echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%' align='center'>";

             echo "<center><h4>Toko : Toeng Market Cyber Malang</h4></center>";
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
              where a.store='TMMLC'
              GROUP BY a.no_member ORDER BY a.tgl_undian ASC
              ");

          $x = 1;
          while($data = mysqli_fetch_array($sql)){
          echo "<tr>";
            echo "<td>"."<center>".$x++."</center>"."</td>";
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
          echo "</table>";

         echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered' id='myTable' style='width:75%' align='center'>";
          echo "<h4 style='margin: 20px 0px 15px 0px;'><center>DATA CLAIM VOUCHER ANGPAO ONTOENG</center></h4>";
            echo  "<tr style='background-color: #f9ffa1; margin-top: 40px'>";
            echo      "<th><center>No</center></th>";
            echo      "<th><center>Tanggal Claim</center></th>";
            echo      "<th><center>Email</center></th>";
            echo      "<th><center>No Member</center></th>";
            echo      "<th><center>Nama Member</center></th>";
            echo      "<th><center>No Sales</center></th>";
            echo      "<th><center>Voucer Claimed</center></th>";
            echo  "</tr>";

            $sqlq = mysqli_query($conn3, 
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
               WHERE c.method_id='18' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-02-28' AND f.id='11'
              GROUP by a.docnum");

          $y=1;
          while($dataq = mysqli_fetch_array($sqlq)){
          echo "<tr>";
                echo "<td>"."<center>".$y++."</center>"."</td>";
                echo "<td>"."<center>".$dataq['docdate']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['email']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['cardno']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['name']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['docnum']."</center>"."</td>";
                echo "<td>"."<center>".$dataq['amt']."</center>"."</td>";
          echo "</tr>";
          }
          echo "</table>";
          echo "</table>";
 ?>
</tbody>

     </table>
 </table>