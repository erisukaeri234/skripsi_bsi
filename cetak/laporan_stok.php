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


#ambil data di tabel   

 $tanggal_awal =$_POST['tanggal_awal'];
  $tanggal_akhir =$_POST['tanggal_akhir'];
$sql=mysql_query("select stok.idstok,harga_beli,harga_jual,jumlah,nama_produk from stok inner join produk on stok.idproduk=produk.idproduk");//order by
$data=mysql_fetch_array($sql);
//data surat
$idstok=$data['idstok'];
$nama_produk=$data['nama_produk'];
$jumlah=$data['jumlah'];
$harga_beli=$data['harga_beli'];
$harga_jual=$data['harga_jual'];

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
$pdf->Cell(40,10,'LAPORAN STOK BARANG ');

//Latar
$pdf->setXY(110,10);
$pdf->setFont('Arial','B',14);

$pdf->setFont('Arial','',11);
$pdf->setXY(24,36);
$pdf->Cell(30,30,'Dicetak ');
$pdf->Cell(11,30,': '.date('D-d/m/Y'),0,1, 'L');

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
$pdf->Cell(25,6,'id produk',1,0,'C');
$pdf->Cell(50,6,'nama produk',1,0,'C');
$pdf->Cell(40,6,'harga beli',1,0,'C');
$pdf->Cell(40,6,'harga jual',1,0,'C');
$pdf->Cell(40,6,'jumlah',1,0,'C');



include "../inc/config.php";
$query = "select stok.idstok,harga_beli,harga_jual,jumlah,nama_produk from stok inner join produk on stok.idproduk=produk.idproduk" ;
$rs = mysql_query($query) or die(mysql_error());
$y = 70;
$no = 0;
$row = 6;
while($data = mysql_fetch_array($rs)){
$sql2=mysql_query("SELECT sum(jumlah) as jumlah FROM stok");
	$rs2=mysql_fetch_array($sql2);
$no++;
$pdf->SetFont ('arial','','9');
$pdf->setY($y);
	$pdf->setXY(25,$y);
	$pdf->Cell(25,6,$data['idstok'],1,0,'L');
	$pdf->Cell(50,6,$data['nama_produk'],1,0,'L');
	$pdf->Cell(40,6,$data['harga_jual'],1,0,'L');
	$pdf->Cell(40,6,$data['harga_beli'],1,0,'L');
	$pdf->Cell(40,6,$data['jumlah'],1,0,'L');
	
		$y = $y + $row;
		}
	$pdf->setY($y);
	$pdf->setXY(25,$y);
	$pdf->Cell(155,6,'jumlah',1,0,'L');
	$pdf->Cell(40,6,$rs2['jumlah'],1,0,'L');
	
$pdf->Output();

?>
