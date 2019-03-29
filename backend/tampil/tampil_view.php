<?php
if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
?>



<div>
	<h2 id="headings"> Data Transaksi</h2>
	 <form  class="form-horizontal" target="blank" method="POST" id="form1" 
	  action="../cetak/laporan_transaksi.php">
	 <input type="submit" class="btn btn-success" name="Submit" value="cetak" />

	</form>
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>alamat </b></td><td><b>Kd Transaksi</b></td><td><b>Tanggal Transaksi</b></td><td><b>Jumlah Barang</b></td><td><b>Total Transaksi</b></td><td><b>Pembayaran</b></td></th>
		</thead>
		<tbody>
<?php
$batas='5';
$tabel="tampil";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT invoice.noinvoice,nama,alamat,jmlbrg,tanggal,totalbayar,transfer from invoice inner join pelanggan on invoice.idpelanggan=pelanggan.idpelanggan where transfer != '0'
 limit $posisi,$batas ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php echo $rows -> nama; ?></td>
				<td><?php echo $rows -> alamat; ?></td>
			<td><a href='index.php?mod=invoice&pg=invoice_detail&id=<?php echo $rows -> noinvoice; ?>'><?php echo $rows -> noinvoice; ?></a></td>
			<td><?php echo $rows -> tanggal; ?></td>
			<td><?php echo $rows -> jmlbrg; ?></td>
				<td><?php echo format_rupiah($rows ->totalbayar); ?></td>
		
			<td><?php echo get_status_invoice($rows -> transfer); ?></td>
		
				
				</td>
			
				
			</tr>
			<?php $no++;
				}
			?>

			
		</tbody>
	</table>
	<?php //=============CUT HERE for paging====================================
	$tampil2 = mysql_query("SELECT noinvoice from invoice");

	$jmldata = mysql_num_rows($tampil2);
	$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php pagination($halaman, $jumlah_halaman, "tampil"); ?>
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