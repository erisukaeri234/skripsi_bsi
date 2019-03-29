<?php

function kd_transaksi() {
	$kode_temp = fetch_row("SELECT noinvoice FROM invoice ORDER BY noinvoice DESC LIMIT 0,1");
	if ($kode_temp == '')
		$kode = "T00001";
	else {
		$jum = substr($kode_temp, 1, 6);
		$jum++;
		if ($jum <= 9)
			$kode = "T0000" . $jum;
		elseif ($jum <= 99)
			$kode = "T000" . $jum;
		elseif ($jum <= 999)
			$kode = "T00" . $jum;
		elseif ($jum <= 9999)
			$kode = "T0" . $jum;
		elseif ($jum <= 99999)
			$kode = "T" . $jum;
		else
			die("Kode pemesanan melebihi batas");
	}
	return $kode;
}

function writeShoppingchart() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return '<p>Anda belum membeli apapun</p>';
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);
		$s = (count($items) > 1) ? 's' : '';
		return '<h3>Ada <a href="index.php?mod=chart&pg=chart">' . count($items) . ' barang' . $s . ' di chart</a></h3>';
	}
}

function chartNotification() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return '0';
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);

		return count($items);
	}
}

function getQty() {
	$chart = $_SESSION['chart'];
	if (!$chart) {
		return 0;
	} else {
		// Parse the chart session variable
		$items = explode(',', $chart);
		$s = (count($items) > 1) ? 's' : '';
		return count($items);
	}
}

function showchart() {

	$chart = $_SESSION['chart'];
//	print_r($chart);
	if ($chart) {
		$items = explode(',', $chart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$output[] = "<table class=\"table table-striped \">";
		$output[] = "<th><td>Nama</td><td> Harga</td><td>jumlah</td><td>Ongkir</td><td>subtotal</td><td>Aksi</td></th>";
		$output[] = '<form action="index.php?mod=chart&pg=chart&action=update" method="post" id="chart">';
		$no = 1;
		foreach ($contents as $id => $qty ) {
		$query="select pelanggan.idpelanggan,ongkir from pelanggan inner join ongkir on pelanggan.kodepos=ongkir.kodepos WHERE idpelanggan='".$_SESSION['idpelanggan']."'";
    	$result=mysql_query($query);
    	$rw=mysql_fetch_object($result);
			$sql = "SELECT produk.*,stok.harga_jual from produk,stok WHERE produk.idproduk = '$id' and stok.idproduk = '$id'";
			$result = mysql_query($sql);
			$row = mysql_fetch_object($result);
			$output[] = '<tr><td>' . $no . '</td>';
		
			$output[] = '<td><img src=\'upload/produk/' . $row ->foto ;
			
			$output[] = '\' width=\'128px\' height=\'128px\'><br> '.$row ->nama_produk ;
			
			$output[] = '<td><input type="text" class="input-mini" name="harga_jual ' . $id . '" value="' . $row -> harga_jual . '"</td>';
			$output[] = '<td><input type="text" class="input-mini" name="qty' . $id . '" value="' . $qty . '"  /></td>';
			$output[] = '<td><input type="text" class="input-mini" name="ongkir' . $ongkir . '" value="' .  $rw -> ongkir . '"  /></td>';
			$output[] = '<td>' . format_rupiah($row -> harga_jual * $qty + $rw -> ongkir ) . '</td>';
			
			$tobrg += $row -> $qty + $qty;
			$total += $row -> harga_jual * $qty +$rw -> ongkir ;
			$harga += $row -> harga_jual   ;
			$ongkir += $rw -> ongkir   ;
	
			$output[] = '<td><a href="index.php?mod=chart&pg=chart&action=delete&id=' . $id . '" class="btn btn-danger">Hapus</a></td></tr>';
			$no++;
		}
		$output[] = "</table>";
		$qty = getQty();


		$output[] = '<h3>Total	Transaksi	: ' . format_rupiah($total) . '</h3>';

	
		$_SESSION['jmlbrg'] = $tobrg;
		$_SESSION['ongkir'] = $ongkir;
		$_SESSION['totalbayar'] = $total;
		$_SESSION['harga_jual'] = $harga;
		$output[] = '<button type="submit" class=\'btn btn-primary\'>Update cart</button>';
		$output[] = '</form>';
		$output[] ='<a href=\'chart/chart_action.php\' class=\'btn btn-primary\'>Check out</a>';
	} else {
		$output[] = '<p>Keranjang belanja masih kosong.</p>';
	}
	return join('', $output);
}

function insertToDB($kd_transaksi, $idpelanggan, $totalbayar,$jmlbrg,$ongkir) {
	
	$chart = $_SESSION['chart'];
	if ($chart) {
		$items = explode(',', $chart);
		$contents = array();
		foreach ($items as $item) {
			$contents[$item] = (isset($contents[$item])) ? $contents[$item] + 1 : 1;
		}
		$harga_jual = $_SESSION['harga_jual'];
		$sql_transaksi = "insert into invoice (noinvoice,tanggal,totalbayar,idpelanggan,jmlbrg) 
		values( '$kd_transaksi', now(),'$totalbayar','$idpelanggan','$jmlbrg')";
		//echo "SQL transaksi:".$sql_transaksi;
		mysql_query($sql_transaksi) or die(mysql_error());
		foreach ($contents as $id => $qty ) {
			$_SESSION['harga_jual'] = $harga_jual;
			$sql = "insert into detail_invoice(noinvoice,idproduk,jumlah,harga_jual,ongkir)
			values('$kd_transaksi','$id','$qty','$harga_jual','$ongkir')";
			//		echo "SQL transaksi:".$sql;
			$result = mysql_query($sql) or die(mysql_error());
		}
	} else {
		$output[] = '<p>Keranjang belanja masih kosong.</p>';
	}

}
?>