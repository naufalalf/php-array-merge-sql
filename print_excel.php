<?php
session_start();
include "koneksi.php";
$store  = $_SESSION['store'];
// $awal   = $_POST['awal']." 00:00:00";
// $akhir  = $_POST['akhir']." 23:59:59";

// Load plugin PHPExcel nya
require_once 'PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
// $excel->getProperties()->setCreator('Toeng Makmur')
//              ->setLastModifiedBy('Toeng Makmur')
//              ->setTitle("DATA TUKAR VOUCHER KABISAT")
//              ->setSubject("KABISAT OENTOENG")
//              ->setDescription("DATA TUKAR VOUCHER KABISAT")
//              ->setKeywords("TUKAR VOUCHER KABISAT OENTOENG");
$excel->getProperties()->setCreator('Toeng Makmur')
             ->setLastModifiedBy('Toeng Makmur')
             ->setTitle("DATA VOUCHER ANGPAO OENTOENG")
             ->setSubject("DATA VOUCHER ANGPAO OENTOENG")
             ->setDescription("DATA VOUCHER ANGPAO OENTOENG")
             ->setKeywords("DATA VOUCHER ANGPAO OENTOENG");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
  'font' => array('bold' => true), // Set font nya jadi bold
  'alignment' => array(
    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
  'alignment' => array(
    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
  ),
  'borders' => array(
    'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
  )
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA VOUCHER ANGPAO OENTOENG"); //HEADER
$excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai L1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
$excel->setActiveSheetIndex(0)->setCellValue('B3', "TGL"); 
$excel->setActiveSheetIndex(0)->setCellValue('C3', "NO. MEMBER"); 
$excel->setActiveSheetIndex(0)->setCellValue('D3', "NO. SALES"); 
$excel->setActiveSheetIndex(0)->setCellValue('E3', "NOMINAL"); 
$excel->setActiveSheetIndex(0)->setCellValue('F3', "QTY"); 
// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

$sql = "SELECT a.tgl_undian,a.no_member,a.no_sales,a.store as str,b.nominal,count(b.nominal) as jml
FROM log_undian a 
left join tbl_undian b on b.id=a.id_vocer
where (a.tgl_undian>='".$awal."' and a.tgl_undian<='".$akhir."') 
and a.store='".$store."' group by a.no_sales,a.no_member,b.nominal ";
$rs_result = mysqli_query ($con,$sql);  

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while ($data = mysqli_fetch_array($rs_result)) { 
  
  // $tgl = date("d/m/y",strtotime($data['tgl_undian']));
  $tgl = date("y/m/d",strtotime($data['tgl_undian']));
include 'index.php';
 
  if($toko==1) { 
  $data['store'] = 'Tidar'; } 
  else if($toko==2) {  
  $data['store'] = 'Jaksa Agung'; }
  else if($toko==3) {  
  $store = 'Cybermall MLG';
  } else{
  $store = '-';
  }

  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $tgl);
  $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['no_member']);
  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['no_sales']);
  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nominal']);
  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['jml']);
  
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);

  $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
  
  $no++; // Tambah 1 setiap kali looping
  $numrow++; // Tambah 1 setiap kali looping

  //$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['jumlah'].' Lembar');
  //$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data['total']);

  //$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
  //$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
}


// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("DATA VOUCHER ANGPAO OENTOENG"); //gabisa panjang-panjang maksimal 31 karakter
$excel->setActiveSheetIndex(0);

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
  $store = $_SESSION['user']['store'];
  $dat = date("d/m/Y");
  
  if(strcmp($store,'TMTDT')==0) { 
  header('Content-Disposition: attachment; filename="Tidar-'.$dat.'.xls"');  
  } 
  else if(strcmp($store,'TMJKT')==0) {  
  header('Content-Disposition: attachment; filename="Jaksa-'.$dat.'.xls"');  
  }
  else if(strcmp($store,'TMMLC')==0) {  
  header('Content-Disposition: attachment; filename="Cybermall-'.$dat.'.xls"');  
  } else{
  header('Content-Disposition: attachment; filename="Tenagabaru-'.$dat.'.xls"');  
  }

// header('Content-Disposition: attachment; filename="abc.xls"'); 
header('Cache-Control: max-age=0');

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$write->save('php://output');
?>
