<?php 
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
<style>
  table {
    font-family: arial, sans-serif;
    font-size: 15px;
    border-collapse: collapse;
    width: 100%;
    background-color: #fff;
  }
  td, th {
    border: 1px solid #dddddd;
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
    <h3>REPORT CLAIM VOUCHER KETUPAT OENTOENG</h3>
  <form class="col-5" method="post">
          <select class="col-3 form-control" name="model" id="model" required="" style="height: 30px;width: 115px; font-size: 17px;border-radius: 10px 10px 10px 10px; text-align: center;">
            <option value="" disabled="" selected="">model</option>
            <option value="2">Hari</option>
            <option value="3">Toko</option>
          </select>
          <select class="col-3 form-control" name="toko" id="toko" required="" style="height: 30px;width: 115px; font-size: 17px;border-radius: 10px 10px 10px 10px;">
            <option value="" disabled="" selected=""> store</option>
            <option value="1">Tidar</option>
            <option value="2">Jaksa</option>
            <option value="3">Cyber</option>
          </select>
          <button type="submit" name="submit" class="btn btn-default col-3" style="height: 30px;border-radius: 10px 10px 10px 10px;">
            <i class="fa fa-search"><b>Search</b></i></button>   
    </form>

 <?php


         if( isset($_POST['submit'])){
         
          $model = $_POST['model'];
          $toko = $_POST['toko'];

          if ($model == 1 and $toko == 1){

            include 'tidar-normal.php';

          } else if ($model == 2 and $toko==1){

          include 'tidar-hari.php';
          ?>
           <div class="col-sm-4" style="margin: 0 900px 0 0px;">
            <form class="" action="printexcelch.php" method="POST">
            <table>
              <tr>
               <h3 style="margin: 20px 70px 10px 165px;" >Ekspor Laporan Excel</h3>
                <label>&nbsp;</label>
                <button style="margin: 0px 70px 10px 45px; padding: 0.50rem 0.5rem;width: 65px;" id="start"
                 class="btn btn-sm btn-success" type="submit" name="button">Ekspor</button>
                 </tr>
            </table>
            </form>
          </div>
          <?php

          } else if ($model == 3 and $toko==1){
              
              include 'tidar-global.php';
          ?>
           <div class="col-sm-4" style="margin: 0 900px 0 0px;">
            <form class="" action="printexceltg.php" method="POST">
            <table>
               <h3 style="margin: 20px 70px 10px 165px;" >Ekspor Laporan Excel</h3>
                <label>&nbsp;</label>
                <button style="margin: 0px 70px 10px 45px; padding: 0.50rem 0.5rem;width: 65px;" id="start"
                 class="btn btn-sm btn-success" type="submit" name="button">Ekspor</button>
            </table>
            </form>
          </div>
          <?php
          } else if ($model == 1 and $toko==2){
              
              include 'jaksa-normal.php';

          } else if ($model == 2 and $toko==2){
              
              include 'jaksa-hari.php';
          ?>

           <div class="col-sm-4" style="margin: 0 900px 0 0px;">
            <form class="" action="printexceljh.php" method="POST">
            <table>
              <tr>
               <h3 style="margin: 20px 70px 10px 165px;" >Ekspor Laporan Excel</h3>
                <label>&nbsp;</label>
                <button style="margin: 0px 70px 10px 45px; padding: 0.50rem 0.5rem;width: 65px;" id="start"
                 class="btn btn-sm btn-success" type="submit" name="button">Ekspor</button>
              </tr>
            </table>
            </form>
          </div>

          <?php
          } else if ($model == 3 and $toko==2){
              
              include 'jaksa-global.php';
          ?>

           <div class="col-sm-4" style="margin: 0 900px 0 0px;">
            <form class="" action="printexceljg.php" method="POST">
            <table>
              <tr>
               <h3 style="margin: 20px 70px 10px 165px;" >Ekspor Laporan Excel</h3>
                <label>&nbsp;</label>
                <button style="margin: 0px 70px 10px 45px; padding: 0.50rem 0.5rem;width: 65px;" id="start"
                 class="btn btn-sm btn-success" type="submit" name="button">Ekspor</button>
              </tr>
            </table>
            </form>
          </div>

          <?php   
          } else if ($model == 1 and $toko==3){
              
              include 'cyber-normal.php';

          } else if ($model == 2 and $toko==3){
              
              include 'cyber-hari.php';
          ?>

           <div class="col-sm-4" style="margin: 0 900px 0 0px;">
            <form class="" action="printexcelch.php" method="POST">
            <table>
              <tr>
               <h3 style="margin: 20px 70px 10px 165px;" >Ekspor Laporan Excel</h3>
                <label>&nbsp;</label>
                <button style="margin: 0px 70px 10px 45px; padding: 0.50rem 0.5rem;width: 65px;" id="start"
                 class="btn btn-sm btn-success" type="submit" name="button">Ekspor</button>
              </tr>
            </table>
            </form>
          </div>

          <?php
          } else if ($model == 3 and $toko==3){
             
              include 'cyber-global.php';
          ?>

           <div class="col-sm-4" style="margin: 0 900px 0 0px;">
            <form class="" action="printexcelcg.php" method="POST">
            <table>
              <tr>
               <h3 style="margin: 20px 70px 10px 165px;" >Ekspor Laporan Excel</h3>
                <label>&nbsp;</label>
                <button style="border-radius: 10px 10px 10px 10px; margin: 0px 70px 10px 45px; padding: 0.50rem 0.5rem; width: 65px; " id="start"
                 class="btn btn-sm btn-success" type="submit" name="button" >Ekspor</button>
              </tr>
            </table>
            </form>
          </div>

          <?php
          } else {

          }
          }
          ?>
 
    </center>
   
</body>
</html>
