<?php

 
include ('../../inc/config.php');
include('../../inc/function.php');
//data dari produk
if(isset($_POST)){
$nama=$_POST['nama'];
$noinvoice=$_POST['noinvoice'];
$idpelanggan=$_POST['idpelanggan'];
$nama_rekening=$_POST['nama_rekening'];
$bank=$_POST['bank'];
$rekening=$_POST['rekening'];
$transfer=$_POST['transfer'];

$aksi = $_POST['aksi'];


$lokasi_file = $_FILES['foto']['tmp_name'];
$foto_file = $_FILES['foto']['name'];
$tipe_file = $_FILES['foto']['type'];
$ukuran_file = $_FILES['foto']['size'];
$direktori = "../../upload/produk/$foto_file";
$sql = null;
$MAX_FILE_SIZE = 1000000;
//100kb
if($ukuran_file > $MAX_FILE_SIZE) {
	header("Location:../index.php?mod=produk&pg=produk_form&status=1");
	exit();
}
$sql = null;
if($ukuran_file > 0) {
	move_uploaded_file($lokasi_file, $direktori);
}

if($aksi == 'tambah') {
	$sql = "INSERT INTO transaksi(noinvoice,idpelanggan,nama_rekening,
	bank,rekening,transfer,foto)
		VALUES('$noinvoice',
		'$idpelanggan','$nama_rekening','$bank','$rekening','$transfer','$foto_file')";
}
}

$result = mysql_query($sql) or die(mysql_error());

//check if query successful
if($result) {
	header('location:../../index.php?mod=backend/produk&pg=transfer=0');
} else {
	header('location:../../index.php?mod=backend/produk&pg=transfer=1');

}
?>
