<?php
if(empty($_SESSION['username'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
?>
<?php 
//===========CODE DELETE RECORD ================

if (isset($_GET['act'])) {
	$act=$_GET['act'];
	if($act=='del'){
	$id = $_GET['id'];
	$sql = "delete from transaksi where noinvoice='$id' ";
	mysql_query($sql) or die(mysql_error());
	$sql = "delete from invoice where noinvoice='$id' ";
	mysql_query($sql) or die(mysql_error());
	}else if($act=='bayar'){
	$id = $_GET['id'];
	$sql = "update  invoice set transfer='1' where noinvoice='$id' ";
	mysql_query($sql) or die(mysql_error());
	//kode untuk mengurangi barang 
	//1. dapatkan idbarang dan jumlah pada transaksi tersebut 
	$sql = "select idproduk,jumlah from detail_invoice where  noinvoice='$id' ";
	$res=mysql_query($sql) or die(mysql_error());
	while($rows=mysql_fetch_object($res)){
		//2. kurangi barang sejumlah pembelian 
		$query="update stok set jumlah=jumlah - ".$rows->jumlah." where idproduk=".$rows->idproduk;
		mysql_query($query) or die(mysql_error());
	}
	
	
	}else if($act=='kirim'){
	$id = $_GET['id'];
	$sql = "update invoice set tglkirim=now() where noinvoice='$id' ";
	//echo $sql;
	mysql_query($sql) or die(mysql_error());

	}
	

}
?>

<div>
	<h2 id="headings"> Data Transaksi</h2>
	<!--<a href='index.php?mod=invoice&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>alamat </b></td><td><b>Kd Transaksi</b></td><td><b>Tanggal Transaksi</b></td><td><b>Total Transaksi</b></td><td><b>Pembayaran</b></td><td><b>Tgl Kirim</b></td><td><b>Aksi</b></td></th>
		</thead>
		<tbody>
<?php
$batas='5';
$tabel="invoice";
$halaman=$_GET['halaman'];
$posisi=null;
if(empty($halaman)){
$posisi=0;
$halaman=1;
}else{
$posisi=($halaman-1)* $batas;
}
$query="SELECT invoice.*,pelanggan.nama,pelanggan.alamat
 from invoice,pelanggan
 where invoice.idpelanggan=pelanggan.idpelanggan
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
				<td><?php echo format_rupiah($rows ->totalbayar); ?></td>
		
			<td><?php echo get_status_invoice($rows -> transfer); ?></td>
			<td><?php echo tglkirim($rows -> tglkirim); ?>
				
				</td>
			
				<td>	
				<a href='laporan/cetak_invoice.php?cari=<?php echo $rows -> noinvoice; ?>'target='_blank''
				class='btn btn-success'> <i class="icon-print"></i>Cetak</a>	
				<a href="index.php?mod=invoice&pg=invoice_view&act=bayar&id=<?= $rows -> noinvoice; ?>"
				onclick="return confirm('Tandai sudah bayar?') ";
				class='btn btn-success'> <i class="icon-ok"></i>Konfirmasi</a>
				<a href="index.php?mod=invoice&pg=invoice_view&act=kirim&id=<?= $rows -> noinvoice; ?>"
				onclick="return confirm('Kirim barang sekarang?') ";
				class='btn btn-success'> <i class="icon-ok"></i>Kirim </a>
					
				</i></a>
				<td></td>
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
<?php pagination($halaman, $jumlah_halaman, "invoice"); ?>
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