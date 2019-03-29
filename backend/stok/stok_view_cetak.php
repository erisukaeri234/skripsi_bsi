<?php
 if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
 
 				//===========CODE DELETE RECORD ================

					if(isset($_GET['act'])) {
						$id = $_GET['id'];
						$sql = "delete from stok where idstok='$id' ";
						mysql_query($sql) or die(mysql_error());

					}
					if(isset($_POST['update'])) {
						$persen = $_POST['persen'];
						$persen=$persen/100;
						$sql = "update stok set harga_jual=harga_jual+(harga_jual*$persen) ";
						mysql_query($sql) or die(mysql_error());

					}
					?>

<div>
	
	
	<h3>laporan stok barang</h3>
	  <form  class="form-horizontal" target="blank" method="POST" id="form1" 
	  action="../cetak/laporan_stok.php">
	 <input type="submit" class="btn btn-success" name="Submit" value="cetak" />

	</form>
	<!--<a href='index.php?mod=stok&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<h2 id="headings"> Data stok</h2>
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama produk </b></td><td><b>Harga Beli</b></td><td><b>Harga Jual</b></td><td><b>jumlah</b></td><td><b></th>
		</thead>
		<tbody>
<?php
$batas='10';
$tabel="stok";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT stok.*,produk.nama_produk
 from stok,produk
 where stok.idproduk=produk.idproduk
 limit $posisi,$batas ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php		echo $rows -> nama_produk;?></td>
			<td align='right'><?php		echo format_rupiah($rows ->harga_beli);?></td>
			<td align='right'><?php		echo format_rupiah($rows ->harga_jual);?></td>
			<td align='right'><?php		echo $rows ->jumlah;?></td>
			
			</tr>
			<?php	$no++;
	}?>

			
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
