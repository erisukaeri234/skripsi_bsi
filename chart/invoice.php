<?php
cek_status_login($_SESSION['idpelanggan']);
?>
<section id="contactRow" class="row contentRowPad">
 	 <div class="container">
            <div class="row">

	


	<h4 id="headings"> Data Transaksi</h4>
	<!--<a href='index.php?mod=invoice&pg=peta'><i class="icon-map-marker"></i>Map View</a>-->
	<table  class="table table-striped table-condensed">
		<thead>
			<th><td><b>Nama </b></td><td><b>Kd Transaksi</b></td><td><b>Tanggal Transaksi</b></td><td><b>Total Transaksi</b></td><td><b>Pembayaran</b></td><td><b>Tgl Kirim</b></td></th>
		</thead>
		<tbody>
<?php
error_reporting(0);
$id=$_SESSION['idpelanggan'];
$query="SELECT invoice.*,pelanggan.nama
 from invoice,pelanggan
 where invoice.idpelanggan=pelanggan.idpelanggan
 and pelanggan.idpelanggan='$id'
";
$result=mysql_query($query) or die(mysql_error());
$no=1;
//proses menampilkan data
while($rows=mysql_fetch_object($result)){

			?>
			<tr>
				<td><?php echo $posisi+$no
				?></td>
			
				<td><?php echo $rows -> nama;?></td>
			<td><a href='index.php?mod=chart&pg=invoice_detail&id=<?php echo $rows -> noinvoice; ?>'><?php echo $rows -> noinvoice; ?></a></td>
			<td><?php echo $rows -> tanggal; ?></td>
				<td><?php echo format_rupiah($rows ->totalbayar); ?></td>
		
			<td><?php echo get_status_invoice($rows -> transfer); ?></td>
			<td><?php echo tglkirim($rows -> tglkirim); ?>
				
				</td>
			
				
			</tr>
			<? $no++;
				}
			?>

			
		</tbody>
	</table>	

</div>

		

	</div>
</section>	
