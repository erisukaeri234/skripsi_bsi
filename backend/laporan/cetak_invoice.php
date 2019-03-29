<?php
error_reporting(0);
require('../../fpdf/fpdf.php');

$host="localhost";
$user="root";
$pass="root";
$db="dbskripsi";


$entries=10;
$waktu=date("Y-m-d H:i:s");
	
$koneksi=mysql_connect($host,$user,$pass);
mysql_select_db($db,$koneksi);

if($koneksi){
}else{
	echo "Gagal koneksi";
}


#ambil data di tabel   

 $cari_data = $_REQUEST['cari'];
//echo 'kode perusahaan : $kd_perusahaan';


$sql=mysql_query("SELECT invoice.noinvoice,invoice.transfer, invoice.tanggal, invoice.jmlbrg,invoice.totalbayar, pelanggan.nama,pelanggan.kodepos,stok.harga_jual, pelanggan.alamat, detail_invoice.noinvoice, detail_invoice.jumlah,detail_invoice.jumlah, produk.idproduk, produk.nama_produk from detail_invoice inner join invoice on detail_invoice.noinvoice = invoice.noinvoice inner join pelanggan on invoice.idpelanggan = pelanggan.idpelanggan inner join produk on detail_invoice.idproduk = produk.idproduk LEFT JOIN stok on produk.idproduk = stok.idproduk where invoice.noinvoice like '%$cari_data%'");//order by
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
$pdf->Cell(40,20,'MAKMUR SERVICE ELEKTRONIK');
$pdf->setFont('Arial','B',12);
$pdf->setXY(55,15);
$pdf->Cell(30,30,'Jl. Raya Rajek/guharajek rt.001/004 kec.Rajek Kab. Tangerang- Banten');
$pdf->setXY(123,15);
$pdf->setFont('Arial','B',10);
$pdf->setXY(90,34);
$pdf->Cell(40,10,'LAPORAN TRANSAKSI PENJUALAN ');
//Latar

//
$pdf->setXY(200,10);
$pdf->setFont('Arial','',10);
$pdf->Cell(68,67,date('D-d/m/Y'),0,1, 'C');
$pdf->setFont('Arial','',11);
$pdf->setXY(170,10);
$pdf->setXY(24,36);
$pdf->Cell(30,30,'No Transaksi');
$pdf->Cell(11,30,': '.$data['noinvoice'],0,1, 'L');
$pdf->setXY(24,40);
$pdf->Cell(30,30,'Nama ');
$pdf->Cell(40,30,': '.$data['nama'],0,1, 'L');
$pdf->setXY(24,44);
$pdf->Cell(30,30,'Alamat  ');
$pdf->Cell(40,30,': '.$data['alamat'],0,1, 'L');
$pdf->setXY(200,44);
$pdf->Cell(30,30,'Kode Pos  ');
$pdf->Cell(40,30,': '.$data['kodepos'],0,1, 'L');
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
$pdf->Cell(25,6,'Kode Produk',1,0,'C');
$pdf->Cell(40,6,'Nama Produk',1,0,'C');
$pdf->Cell(30,6,'Harga',1,0,'C');
$pdf->Cell(30,6,'Jumlah Beli',1,0,'C');
$pdf->Cell(30,6,'Ongkir',1,0,'C');
$pdf->Cell(40,6,'Total',1,0,'C');


include "../temp/koneksi.php";
$query = "SELECT invoice.noinvoice,invoice.transfer, invoice.tanggal, invoice.jmlbrg,invoice.totalbayar, pelanggan.nama,stok.harga_jual, pelanggan.alamat, detail_invoice.noinvoice, detail_invoice.jumlah,detail_invoice.jumlah,detail_invoice.ongkir, produk.idproduk, produk.nama_produk from detail_invoice inner join invoice on detail_invoice.noinvoice = invoice.noinvoice inner join pelanggan on invoice.idpelanggan = pelanggan.idpelanggan inner join produk on detail_invoice.idproduk = produk.idproduk LEFT JOIN stok on produk.idproduk = stok.idproduk where invoice.noinvoice like '%$cari_data%'" ;
$rs = mysql_query($query) or die(mysql_error());
$y = 70;
$no = 0;
$row = 6;
while($data = mysql_fetch_array($rs)){
$jumlah=$data['jumlah'];
$harga=$data['harga_jual'];
$ongkir=$data['ongkir'];
$total=$harga*$jumlah+$ongkir;
$sql2=mysql_query("SELECT sum(harga_jual*jumlah) as jml FROM detail_invoice where invoice='$invoice'");
	$rs2=mysql_fetch_array($sql2);
$no++;
$pdf->SetFont ('arial','','9');
$pdf->setY($y);
	$pdf->setXY(25,$y);

	$pdf->Cell(25,6,$data['idproduk'],1,0,'L');
	$pdf->Cell(40,6,$data['nama_produk'],1,0,'L');
	$pdf->Cell(30,6,$data['harga_jual'],1,0,'L');
	$pdf->Cell(30,6,$data['jumlah'],1,0,'L');
	$pdf->Cell(30,6,$data['ongkir'],1,0,'L');
	$pdf->Cell(40,6,$total,1,0,'L');
		$y = $y + $row;
		
	$pdf->setY($y);
	$pdf->setXY(25,$y);
	$pdf->Cell(155,6,'Subtotal',1,0,'L');
	$pdf->Cell(40,6,$data['totalbayar'],1,0,'L');
	$y = $y + $row;
	}

$data=mysql_fetch_array($sql);
	$pdf->setY($y);
	$pdf->setXY(25,$y);
	$pdf->Cell(30,30,' ');
	$pdf->Cell(40,30,': '.$data['nm_admin'],0,1, 'L');
	
$pdf->Output();

?>
