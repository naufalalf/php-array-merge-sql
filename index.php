
<!DOCTYPE html>
<html>
<head>
<style>
  h1,h4{
    color: #fff;
    border-color: #000;
    font-size: 45px;
  }
  body{
   /* background-color: #2883fa;*/
    background-image: url("https://images.tokopedia.net/img/cache/500-square/product-1/2016/6/14/9955428/9955428_a0fc729b-bec3-4b65-a1df-6c37da139428.jpg.webp");
    background-repeat: no-repeat;
    background-size: cover;
  }
  option{
    font-weight: bold ;
  }
  select{
    font-weight: bold;
  }

  
</style>
</head>
<body>
 
  <center>
    <h1 class="stroke" style="margin-top: 80px;">REPORT CLAIM </h1>
    <h1 class="stroke">VOUCHER OENTOENG</h1>
    <h1 class="stroke"> TOENG MARKET</h1>
  <form class="col-5" target="_blank" method="post">
          <select class="col-3 form-control" name="tipe" id="tipe" required="" style="height: 40px;width: 250px; font-size: 17px; border-radius: 10px 10px 10px 10px;">
            <option value="" disabled="" selected="" style="padding: 10px;">Pilih Voucher</option>
            <option value="1"><b>Voucher Angpao Ontoeng</b></option>
            <option value="2"><b>Voucher Ketupat Ontoeng</b></option>
          </select>
          <button type="submit" name="submit" class="btn btn-default col-3" style="height: 40px;border-radius: 10px 10px 10px 10px">
            <i class="fa fa-search"><b>Search</b></i></button>   
    </form>

 <?php

          if( isset($_POST['submit'])){
         
          $tipe = $_POST['tipe'];

            if ($tipe == 1 ){

             header("location: angpao/index-angpao.php");
           
            } else if ($tipe == 2 ){
            
              header("location: ketupat/index-ketupat.php");
            
            } else{

            }
          }

  ?> 
 
    </center>
   
</body>
</html>