


<div>
	<h2 id="headings"> Data produk</h2>
	<form id="form1" name="form1" method="post" action="">

	<!--<a href='index.php?mod=produk&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<br />
  <table width="599" height="41" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="11" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="482" bgcolor="#CCCCCC"><label>Cari Data Berdasarkan No Transaksi :
          <input name="cari_data" type="text" id="cari_data" size="30" />
      </label></td>
      <td width="106"><label></label></td>
    </tr>
  </table>
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>Deskripsi</b></td><td><b>Kategori</b></td><td style='min-width: 100px'><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='10';
$tabel="produk";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT * from produk where nama_produk LIKE '$_POST[cari_data]%' ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php echo $rows -> nama_produk; ?></td>
				<td><?php echo $rows ->deskripsi; ?></td>
			
		
			<td><?php echo $rows -> nama_kategori; ?></td>
			
				<td>	
					
					<a href="index.php?mod=backend/pelanggan&pg=return&idproduk=<?= $rows -> idproduk; ?>"

				class='btn btn-warning'> <i class="icon-pencil"></i></a></td>
			</tr>
			<?php $no++;
				}
			?>

			
		</tbody>
	</table>
	<?php //=============CUT HERE for paging====================================
	$tampil2 = mysql_query("SELECT idproduk from produk");

	$jmldata = mysql_num_rows($tampil2);
	$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php pagination($halaman, $jumlah_halaman, "produk"); ?>
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
</form>