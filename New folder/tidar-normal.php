<!-- <style>
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
</style> -->
 <!-- css bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<?php include 'koneksi.php'; ?>

<?php
    echo "<center><h4>Toko : Toeng Market Tidar</h4></center>"; 
	 echo "<table style='width: 100%'>";
         echo "<table class='table table-striped table-bordered table-hover' id='myTable' style='width:80%' align='center'>";
             echo "<thead>";
              echo  "<tr style='background-color: #f9ffa1; margin-top: 40px; padding:100px'>";
               echo "   <th style='padding:5px'><center>No</center></th>";
               echo "   <th><center>Tanggal Undian</center></th>";
               echo "   <th><center>Email</center></th>";
               echo "   <th><center>No Member</center></th>";
               echo "   <th><center>Nama Member</center></th>";
               echo "   <th><center>No Sales </center></th>";
               echo "   <th><center>Total Voucher</center></th>";
               echo " </tr>";
             echo "</thead>";
             echo "<tbody>";

          $page = (isset($_GET['page']))? (int) $_GET['page'] : 1;

          $limit = 10;

          $limitStart = ($page - 1) * $limit;

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
              where a.store='TMTDT'
              GROUP BY a.no_member 
              ORDER BY a.tgl_undian ASC 
              limit ".$limitStart.",".$limit);

          $no = $limitStart + 1;

          // $x = 1;
          while($data = mysqli_fetch_assoc($sql)){
          echo "<tr>";
            echo "<td style='padding:2px'>"."<center>".$no++."</center>"."</td>";
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
          ?>

<!--         button pagination -->
         <div align="center">
           <ul class="pagination">
             <?php
             if ($page==1) {
             ?>
             <li class="disabled"><a href="#">Previous</a></li>
             <?php
              }else{
                $LinkPrev = ($page > 1)? - 1 : 1;
             ?>
             <li><a href="tidar-normal.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
             <?php
              }
             ?>

             <?php
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
              where a.store='TMTDT'
              GROUP BY a.no_member 
              ORDER BY a.tgl_undian ASC");

             $jumlahData = mysqli_num_rows($sql);
             
             $jumlahPage = ceil($jumlahData / $limit);

             $jumlahNumber = 1;

             $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1;

             $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage;

             for($i = $startNumber; $i<=$endNumber; $i++){
              $linkActive = ($page == $i)? ' class ="active"' : '';
              ?>
              <li <?php echo $linkActive;?>><a href="tidar-normal.php?page=<?php echo $i;?>"><?php echo $i;?> </a></li>
              <?php
             }
             ?>

             <?php
              if ($page == $jumlahPage) {
              ?>
              <li class="disabled"><a href="#">Next</a></li>
              <?php
              } else {
                $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
              ?>
              <li><a href="tidar-normal.php?page=<?php echo $linkNext; ?>">Next</a></li>
              <?php
              }
             ?>
           </ul>
         </div>
<!--          end buton pagination -->
        <?php
         // echo "<table style='width: 100%'>";
         // echo "<table class='table table-striped table-bordered' id='myTable' style='width:80%' align='center'>";
         //  echo "<h4 style='margin: 20px 0px 15px 0px;'><center>DATA CLAIM VOUCHER ANGPAO ONTOENG</center></h4>";
         //    echo  "<tr style='background-color: #f9ffa1; margin-top: 40px; padding:100px' >";
         //    echo      "<th style='padding:5px'><center>No</center></th>";
         //    echo      "<th><center>Tanggal Claim</center></th>";
         //    echo      "<th><center>Email</center></th>";
         //    echo      "<th><center>No Member</center></th>";
         //    echo      "<th><center>Nama Member</center></th>";
         //    echo      "<th><center>No Sales</center></th>";
         //    echo      "<th><center>Voucer Claimed</center></th>";
         //    echo  "</tr>";

            // $sqlq = mysqli_query($conn1, 
            //   "SELECT 
            //     a.docdate,
            //     e.email, 
            //     e.cardno,
            //     a.docnum,  
            //     e.name, 
            //     sum(c.amount) as amt
            //   FROM sales a
            //   LEFT JOIN payment b ON b.sales_id=a.id
            //   LEFT JOIN paymentdetail c ON c.payment_id=b.id
            //   LEFT JOIN paymethod d ON d.id=c.method_id
            //   LEFT JOIN members e ON a.member_id=e.id
            //   left join location f on a.location_id=f.id
            //   WHERE c.method_id='18' AND date(a.createtime)>='2021-02-02' AND date(a.createtime)<='2021-02-28' 
            //   AND f.id='15'
            //   GROUP by e.cardno, a.docnum
            //   order by a.docdate asc");

          // $y=1;
          // while($dataq = mysqli_fetch_array($sqlq)){
          // echo "<tr>";
          //       echo "<td>"."<center>".$y++."</center>"."</td>";
          //       echo "<td>"."<center>".$dataq['docdate']."</center>"."</td>";
          //       echo "<td>"."<center>".$dataq['email']."</center>"."</td>";
          //       echo "<td>"."<center>".$dataq['cardno']."</center>"."</td>";
          //       echo "<td>"."<center>".$dataq['name']."</center>"."</td>";
          //       echo "<td>"."<center>".$dataq['docnum']."</center>"."</td>";
          //       echo "<td>"."<center>".$dataq['amt']."</center>"."</td>";
          // echo "</tr>";
          // }
          // echo "</table>";
          // echo "</table>";
 ?>
