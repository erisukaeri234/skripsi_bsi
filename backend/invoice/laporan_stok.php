<?php

 	if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
 				//===========CODE DELETE RECORD ================

					if(isset($_GET['act'])) {
						$id = $_GET['id'];
						$sql = "delete from stok where idstok='$idstok' ";
						mysql_query($sql) or die(mysql_error());

					}
					?>

<div>
	<h2 id="headings"> Data stok</h2>
	<!--<a href='index.php?mod=pelanggan&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>Email</b></td><td><b>No Telp</b></td><td><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='5';
$tabel="stok";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT stok.*
 from stok
 limit $posisi,$batas ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php		echo $rows -> harga_beli;?></td>
			<td><?php		echo $rows ->harga_jual;?></td>
			<td><?php		echo $rows->jumlah;?></td>
			
				<td>	
					
					<a href="index.php?mod=pelanggan&pg=pelanggan_form&id=<?=	$rows -> idpelanggan;?>"

				class='btn btn-warning'> <i class="icon-pencil"></i></a><a href="index.php?mod=pelanggan&pg=pelanggan_view&act=del&id=<?=	$rows -> idpelanggan;?>"
				onclick="return confirm('Yakin data akan dihapus?') ";
				class='btn btn-danger'> <i class="icon-trash"></i></a></td>
			</tr>
			<?php	$no++;
	}?>

			<tr>
				<td colspan='4' ></td><td><a href="index.php?mod=pelanggan&pg=pelanggan_form"
				class='btn btn-primary'	><i class="icon-plus"></i></a></td>
			</tr>
		</tbody>
	</table>
	<?php
//=============CUT HERE for paging====================================
$tampil2 = mysql_query("SELECT idstok from stok");

$jmldata = mysql_num_rows($tampil2);
$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php
pagination($halaman, $jumlah_halaman,"stok");
?>
	</ul>
</div>
<div class='well'>Jumlah data :<strong><?=$jmldata;?> </strong></div>
<?php
// KODE UNTUK MENAMPILKAN PESAN STATUS
if(isset($_GET['status'])) {
	if($_GET['status'] == 0) {
		echo " Operasi data berhasil";
	} else {
		echo "operasi gagal";
	}
}

//close database?>

</div>
<?php

 	if(empty($_SESSION['username'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
 				//===========CODE DELETE RECORD ================

					if(isset($_GET['act'])) {
						$id = $_GET['id'];
						$sql = "delete from pelanggan where idpelanggan='$id' ";
						mysql_query($sql) or die(mysql_error());

					}
					?>

<div>
	<h2 id="headings"> Data pelanggan</h2>
	<!--<a href='index.php?mod=pelanggan&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>Email</b></td><td><b>No Telp</b></td><td><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='5';
$tabel="pelanggan";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT pelanggan.*
 from pelanggan
 limit $posisi,$batas ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php		echo $rows -> nama;?></td>
			<td><?php		echo $rows ->email;?></td>
			<td><?php		echo $rows->telp;?></td>
			
				<td>	
					
					<a href="index.php?mod=pelanggan&pg=pelanggan_form&id=<?=	$rows -> idpelanggan;?>"

				class='btn btn-warning'> <i class="icon-pencil"></i></a><a href="index.php?mod=pelanggan&pg=pelanggan_view&act=del&id=<?=	$rows -> idpelanggan;?>"
				onclick="return confirm('Yakin data akan dihapus?') ";
				class='btn btn-danger'> <i class="icon-trash"></i></a></td>
			</tr>
			<?php	$no++;
	}?>

			<tr>
				<td colspan='4' ></td><td><a href="index.php?mod=pelanggan&pg=pelanggan_form"
				class='btn btn-primary'	><i class="icon-plus"></i></a></td>
			</tr>
		</tbody>
	</table>
	<?php
//=============CUT HERE for paging====================================
$tampil2 = mysql_query("SELECT idpelanggan from pelanggan");

$jmldata = mysql_num_rows($tampil2);
$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php
pagination($halaman, $jumlah_halaman,"pelanggan");
?>
	</ul>
</div>
<div class='well'>Jumlah data :<strong><?=$jmldata;?> </strong></div>
<?php
// KODE UNTUK MENAMPILKAN PESAN STATUS
if(isset($_GET['status'])) {
	if($_GET['status'] == 0) {
		echo " Operasi data berhasil";
	} else {
		echo "operasi gagal";
	}
}

//close database?>

</div>
