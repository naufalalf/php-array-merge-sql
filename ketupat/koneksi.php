<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'toengmar_undian';

$conn=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Koneksi ke database gagal!");

$dbhost1 = '192.168.81.100';
$dbuser1 = 'root';
$dbpass1 = 'superman';
$dbname1 = 'tmtdtl1';

$conn1=mysqli_connect($dbhost1, $dbuser1, $dbpass1, $dbname1) or die("Koneksi ke database gagal!");

$dbhost2 = '192.168.82.2';
$dbuser2 = 'root';
$dbpass2 = 'superman';
$dbname2 = 'tmjktl1';

$conn2=mysqli_connect($dbhost2, $dbuser2, $dbpass2, $dbname2) or die("Koneksi ke database gagal!");

$dbhost3 = '192.168.83.2';
$dbuser3 = 'root';
$dbpass3 = 'superman';
$dbname3 = 'tmmlcl1';

$conn3=mysqli_connect($dbhost3, $dbuser3, $dbpass3, $dbname3) or die("Koneksi ke database gagal!");

?>

