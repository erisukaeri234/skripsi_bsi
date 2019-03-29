
<?php
session_start();

require_once ('../inc/config.php');
require_once ('../inc/function.php');
require_once ('../chart/chart.inc.php');
$idpelanggan=$_SESSION['idpelanggan'];

	/* menambahkan kode pesan dan detail pesan kedalam database*/
	$kd_transaksi = kd_transaksi();
	$jmlbrg = $_SESSION['jmlbrg'];
	$total_bayar = $_SESSION['totalbayar'];
	$harga_jual = $_SESSION['harga_jual'];
	$ongkir = $_SESSION['ongkir'];

	insertToDB($kd_transaksi,$idpelanggan,$total_bayar,$jmlbrg,$ongkir);
 unset($_SESSION['chart']); 
	//check if query successful

$link="location:../index.php?mod=chart&pg=finish&total_bayar=$total_bayar&kd_transaksi=$kd_transaksi";
		header($link);

?>
