<?php
 if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
 
					?>

<div>
	
	
	<h3>laporan pembayaran</h3>
	  <form  class="form-horizontal" target="blank" method="POST" id="form1" 
	  action="../cetak/laporan_pembayaran.php">
	 <input type="submit" class="btn btn-success" name="Submit" value="cetak" />

	</form>
	<!--<a href='index.php?mod=stok&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<h2 id="headings"> Data stok</h2>
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>No Invoice  </b></td><td><b>Nama  </b></td><td><b>Email</b></td><td><b>Nama Rekening  </b></td><td><b>Bank</b></td><td><b>No Rekening</b></td><td><b>Nominal Transfer</b></td><td><b></th>
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
$query="SELECT transaksi.*,pelanggan.email,pelanggan.nama
 from transaksi,pelanggan
 where transaksi.idpelanggan=pelanggan.idpelanggan
 limit $posisi,$batas ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
				<td><?php echo $rows -> noinvoice ;?></td>
				<td><?php		echo $rows -> nama;?></td>
			<td align='right'><?php		echo $rows ->email;?></td>
			<td align='right'><?php		echo $rows ->nama_rekening;?></td>
			<td align='right'><?php		echo $rows ->bank;?></td>
			<td align='right'><?php		echo $rows ->rekening;?></td>
			<td align='right'><?php		echo $rows ->transfer;?></td>
			
			</tr>
			<?php	$no++;
	}?>

			
		</tbody>
	</table>
	<?php
//=============CUT HERE for paging====================================
$tampil2 = mysql_query("SELECT no_transaksi from transaksi");

$jmldata = mysql_num_rows($tampil2);
$jumlah_halaman = ceil($jmldata / $batas);
?>
<div class='pagination'> 
	<ul>
<?php
pagination($halaman, $jumlah_halaman,"transaksi");
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
