<?php

 if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
?>
<div>
	<h2 id="headings">  Bukti Pembayaran</h2>
	<!--<a href='index.php?mod=pelanggan&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>No Invoice </b></td><td><b>Pelanggan</b></td><td><b>Nama Rekening</b></td><td><b>Bank</b></td><td><b>No Rekening</b></td><td><b>Nominal Transfer</b></td><td><b>Bukti</b></td></th>
		</thead>
		<tbody>
<?php
$batas='10';
$tabel="pelanggan";
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
 where transaksi.idpelanggan=pelanggan.idpelanggan  ";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?> 
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php		echo $rows -> noinvoice;?></td>
			<td><?php		echo $rows -> nama;?></td>
			<td><?php		echo $rows->	nama_rekening;?></td>
			<td><?php		echo $rows -> bank;?></td>
			<td><?php		echo $rows ->rekening;?></td>
			<td><?php		echo $rows->transfer;?></td>
			<td width='50' height='20' ><?php
						if (!empty($rows -> foto)) {
							echo "<img src='../upload/produk/" . $rows -> foto . "' />";
						}
					?> </td>
			
			</tr>
			<?php	$no++;
	}?>

		</tbody>
	</table>


</div>
