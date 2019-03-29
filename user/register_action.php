
 
<?php
include ('../inc/config.php');
include ('../inc/function.php');
//data dari pelanggan
if(isset($_POST)){
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$email1 = $_POST['email1'];
$password1 = md5($_POST['password1']);
$telp = $_POST['telp'];
$kodepos = $_POST['kodepos'];
$kelamin = $_POST['kelamin'];
$aksi = $_POST['aksi'];
$kota = $_POST['kota'];
$sqlcek=mysql_query("SELECT email from pelanggan where email='$_POST[email1]'");
$rscek=mysql_num_rows($sqlcek);
if($rscek > 0){
			echo "<script>window.alert('Email sudah terdaftar')
    window.location='../index.php?mod=user&pg=register'</script>";
    }

else if(strlen($_POST['telp']) != 12){
	echo "<script>window.alert('Nomor telepon max 12 digit')
    		window.location='../index.php?mod=user&pg=register'</script>";
	}
else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email1'])){
   echo "<script>window.alert('Format email salah')
    window.location='../index.php?mod=user&pg=register'</script>";
}
else {  
	$sql = "INSERT INTO pelanggan(nama,alamat,kelamin,
	kodepos,email,telp,password,tanggal_daftar,kota)
		VALUES('$nama',
		'$alamat','$kelamin','$kodepos','$email1','$telp','$password1',curdate(),'$kota')";
} if ($aksi == 'edit') {

	$sql = "update pelanggan set nama='$nama',
	,kodepos='$kodepos',email='$email',alamat='$ikategori',telp='$telp',password='$password'
	where idpelanggan='$id'";

}

$result = mysql_query($sql) or die(mysql_error());

//check if query successful
if ($result) {
	header('location:../index.php?mod=user&pg=register&status=0');
} else {
	header('location:../index.php?user&pg=register&status=1');
}
}
?>