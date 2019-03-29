<?php

 
include ('../../inc/config.php');
include('../../inc/function.php');
//data dari produk
if(isset($_POST)){
$kodepos=$_POST['kodepos'];
$desa=$_POST['desa'];
$kecamatan=$_POST['kecamatan'];
$kabupaten=$_POST['kabupaten'];
$provinsi=$_POST['provinsi'];
$ongkir=$_POST['ongkir'];
$aksi = $_POST['aksi'];
$id = $_POST['id'];



if($aksi == 'tambah') {
	$sql = "INSERT INTO ongkir(kodepos,desa,kecamatan,
	kabupaten,provinsi,ongkir)
		VALUES('$kodepos',
		'$desa','$kecamatan','$kabupaten','$provinsi','$ongkir')";
}else if($aksi== 'edit') {
	if($ukuran_file > 0){
	$sql = "update ongkir set desa='$desa',
	kecamatan='$kecamatan',kabupaten='$kabupaten',provinsi='$provinsi',ongkir='$ongkir'
	where kodepos='$id'";

	}else{
		$sql = "update ongkir set desa='$desa',
	kecamatan='$kecamatan',kabupaten='$kabupaten',provinsi='$provinsi',ongkir='$ongkir'
	where kodepos='$id'";
	
	}
}

$result = mysql_query($sql) or die(mysql_error());

//check if query successful
if($result) {
	header('location:../index.php?mod=ongkir&pg=ongkir_view&status=0');
} else {
	header('location:../index.php?mod=ongkir&pg=ongkir_view&status=1');
}
}
?>
