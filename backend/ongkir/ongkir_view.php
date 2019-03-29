<?php //===========CODE DELETE RECORD ================
if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}


					?>

<div>
	<h2 id="headings"> Data Ongkir</h2>
	<!--<a href='index.php?mod=produk&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Kode Pos </b></td><td><b>Desa</b></td><td><b>Kecamata</b></td><td><b>Kabupaten</b></td><td><b>Provinsi</b></td><td><b>Ongkos kirim</b></td><td style='min-width: 100px'><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='10';
$tabel="ongkir";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT * from ongkir
 limit $posisi,$batas ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php echo $rows -> kodepos; ?></td>
				<td><?php echo $rows -> desa; ?></td>
			
		
			<td><?php echo $rows -> kecamatan; ?></td>
			<td><?php echo $rows -> kabupaten; ?></td>
			<td><?php echo $rows -> provinsi; ?></td>
			<td><?php echo $rows -> ongkir; ?></td>
				<td>	
					
					<a href="index.php?mod=ongkir&pg=ongkir_form&id=<?= $rows -> kodepos; ?>"

				class='btn btn-warning'> <i class="icon-pencil"></i></a><a href="index.php?mod=ongkir&pg=ongkir_view&act=del&id=<?= $rows -> kodepos; ?>"
				onclick="return confirm('Yakin data akan dihapus?') ";
				class='btn btn-danger'> <i class="icon-trash"></i></a></td>
			</tr>
			<?php $no++;
				}
			?>

			<tr>
				<td colspan='4' ></td><td><a href="index.php?mod=ongkir&pg=ongkir_form"
				class='btn btn-primary'	><i class="icon-plus"></i></a></td>
			</tr>
		</tbody>
	</table>
	<?php //=============CUT HERE for paging====================================
	$tampil2 = mysql_query("SELECT kodepos from ongkir");

	$jmldata = mysql_num_rows($tampil2);
	$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php pagination($halaman, $jumlah_halaman, "ongkir"); ?>
	</ul>
</div>
<div class='well'>Jumlah data :<strong><?= $jmldata; ?> </strong></div>
<?php
// KODE UNTUK MENAMPILKAN PESAN STATUS
if (isset($_GET['status'])) {
	if ($_GET['status'] == 0) {
		echo " Operasi data berhasil";
	} else {
		echo "operasi gagal";
	}
}

//close database
?>

</div>
