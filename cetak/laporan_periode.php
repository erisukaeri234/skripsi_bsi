<?php
error_reporting(0);
require('../fpdf/fpdf.php');

$host="localhost";
$user="root";
$pass="";
$db="penjualan_kopi";

$entries=10;
$waktu=date("Y-m-d H:i:s");
	
$koneksi=mysql_connect($host,$user,$pass);
mysql_select_db($db,$koneksi);

if($koneksi){
}else{
	echo "Gagal koneksi";
}

function rupiah($angka){
	$hasil = "Rp" . number_format($anggka,2,',',',');
	return $hasil_rupiah;
}
#ambil data di tabel   

 $tanggal_awal =$_POST['tanggal_awal'];
  $tanggal_akhir =$_POST['tanggal_akhir'];
$sql=mysql_query("SELECT invoice.noinvoice,invoice.transfer, invoice.tanggal, invoice.jmlbrg,invoice.totalbayar, pelanggan.nama, pelanggan.alamat, detail_invoice.noinvoice, detail_invoice.jumlah,detail_invoice.jumlah, produk.idproduk, produk.nama_produk from detail_invoice inner join invoice on detail_invoice.noinvoice = invoice.noinvoice inner join pelanggan on invoice.idpelanggan = pelanggan.idpelanggan inner join produk on detail_invoice.idproduk = produk.idproduk where invoice.tanggal between '$tanggal_awal' and '$tanggal_akhir' order by invoice.tanggal");//order by
$data=mysql_fetch_array($sql);
//data surat

//deklarasi FPDF
class PDF extends FPDF {
	//inisialisasi Header DOkumen PDF
	function Header() {
		//load image logo
		$this->Image('logo1.jpg',2.5,1,'C');
		//setting format font
		$this->SetFont('Arial','B',14);
		//header text
		$this->Ln(1);
		$this->Cell(0,2.5,' PENUNJUKAN PEMBIMBING SKRIPSI / TUGAS AKHIR ',0,0,'C');
		//ganti baris
		//$this->Ln();
		//setting format font
		
	}
 
}

//Membuat Objej fpdf
$pdf = new FPDF ('L','mm','letter');
//buat Halaman baru
$pdf->AddPage();

//Set Huruf arial,
$pdf->SetFont ('arial','B','14');
//Mencetak Huruf di Dalam File
$pdf->setXY(85,15);
$pdf->Cell(40,20,'KURIR KOPI');
$pdf->setFont('Arial','B',12);
$pdf->setXY(55,15);
$pdf->Cell(30,30,'Kp. Cihampelas RT/RW 01 05 Desa Sindang sari Kec.Pesah Kab. Bandung');
$pdf->setXY(123,15);
$pdf->setFont('Arial','B',10);
$pdf->setXY(90,34);
$pdf->Cell(40,10,'LAPORAN TRANSAKSI PENJUALAN ');

//Latar
$pdf->setXY(110,10);
$pdf->setFont('Arial','B',14);

$pdf->setFont('Arial','',11);
$pdf->setXY(170,10);
$pdf->setFont('Arial','',10);
$pdf->Cell(68,67,date('D-d/m/Y'),0,1, 'C');
$pdf->setFont('Arial','',11);
$pdf->setXY(170,10);
$pdf->setXY(24,36);
$pdf->Cell(30,30,'Periode');
$pdf->Cell(11,30,': '.$tanggal_awal =$_POST['tanggal_awal'],0,1, 'L');
$pdf->setXY(24,40);
$pdf->Cell(30,30,' ');
$pdf->Cell(40,30,': '.$tanggal_akhir =$_POST['tanggal_akhir'],0,1, 'L');
$pdf->Line(25,34,260,34);
$pdf->SetLineWidth(0,5);
$pdf->Line(25,35,260,35);
$pdf->setXY(20,30);
//

$y_initial = 10;
$y_axis1 = 35;
$pdf->SetFont ('arial','B','10');
$pdf->setY($y_axis1);
$pdf->setXY(25,64);
$pdf->Cell(20,6,'No Invoice',1,0,'C');
$pdf->Cell(35,6,'Nama Pelanggang',1,0,'C');
$pdf->Cell(40,6,'Tanggal',1,0,'C');
$pdf->Cell(40,6,'Barang',1,0,'C');
$pdf->Cell(20,6,'Jumlah ',1,0,'C');
$pdf->Cell(40,6,'Pembayaran',1,0,'C');
$pdf->Cell(40,6,'Total Bayar',1,0,'C');


include "../inc/config.php";
$tanggal_awal =$_POST['tanggal_awal'];
  $tanggal_akhir =$_POST['tanggal_akhir'];
$query = "SELECT invoice.noinvoice,invoice.transfer, invoice.tanggal, invoice.jmlbrg,invoice.totalbayar, pelanggan.nama, pelanggan.alamat, detail_invoice.noinvoice, detail_invoice.jumlah,detail_invoice.jumlah, produk.idproduk, produk.nama_produk from detail_invoice inner join invoice on detail_invoice.noinvoice = invoice.noinvoice inner join pelanggan on invoice.idpelanggan = pelanggan.idpelanggan inner join produk on detail_invoice.idproduk = produk.idproduk where invoice.tanggal between '$tanggal_awal' and '$tanggal_akhir' order by invoice.tanggal " ;
$rs = mysql_query($query) or die(mysql_error());
$y = 70;
$no = 0;
$row = 6;
while($data = mysql_fetch_array($rs)){
$tanggal= date("Y-m-d", strtotime($data['tanggal']));
$sql2=mysql_query("SELECT sum(totalbayar) as totalbayar FROM invoice");
	$rs2=mysql_fetch_array($sql2);
$no++;
$pdf->SetFont ('arial','','9');
$pdf->setY($y);
	$pdf->setXY(25,$y);
	$pdf->Cell(20,6,$data['noinvoice'],1,0,'L');
	$pdf->Cell(35,6,$data['nama'],1,0,'L');
	$pdf->Cell(40,6,$tanggal,1,0,'L');
	$pdf->Cell(40,6,$data['nama_produk'],1,0,'L');
	$pdf->Cell(20,6,$data['jumlah'],1,0,'L');
	$pdf->Cell(40,6,'Sudah lunas',1,0,'L');
	$pdf->Cell(40,6,"Rp" . number_format($data['totalbayar']),1,0,'L');
		$y = $y + $row;
		}
	$pdf->setY($y);
	$pdf->setXY(25,$y);
	$pdf->Cell(195,6,'Total ',1,0,'L');
	$pdf->Cell(40,6,"Rp" . number_format($rs2['totalbayar']),1,0,'L');
	
$pdf->Output();

?>
