
<link type="text/css" href="../../css/smoothness/jquery-ui-1.8.24.custom.css" rel="stylesheet" />
		<script type="text/javascript" src="../../js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="../../js/jquery-ui-1.8.24.custom.min.js"></script>
		<script type="text/javascript">
		$(function() {
		$( "#tgl_masuk" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "2012:2013",
				dateFormat: "yy-mm-dd"
			});
		});
		function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
function hitung() {
        var dp = document.getElementById("uang_muka").value-0;
        var jml = document.getElementById("jml").value-0;
		var sisa = jml - dp;
		if (isNaN(sisa)) 
			 document.getElementById("sisa").value = 0;
		else
		{
		if(sisa < 0){
			document.getElementById("sisa").value = 0;
		}else{
			document.getElementById("sisa").value = sisa;
		}
		}
    }

		</script>
		<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />

<script type="text/javascript">

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

    $(function() {
        $( "#idproduk" ).autocomplete({
            source: "get.php",
            minLength: 1,
            select: function( event, ui ) {
            $('#nama_produk').val(ui.item.nm_part);
            }
        });
    });
</script>
<?php
error_reporting(0);
$aksi="act_return.php";
$cari = mysql_query("select * from produk WHERE idproduk = '$_GET[idproduk]'");
$data = mysql_fetch_array($cari);
$ceknomor=mysql_fetch_array(mysql_query("SELECT noreturn FROM tbl_return ORDER BY noreturn DESC LIMIT 1"));
	$cekQ=$ceknomor[noreturn];
	$awalQ=substr($cekQ,2-7);
	$next=$awalQ+1;
	$jnim=strlen($next);

	if($jnim==1)
	{ $no='TR00000'; }
	elseif($jnim==2)
	{ $no='TR0000'; }
	elseif($jnim==3)
	{ $no='TR000'; }
	elseif($jnim==4)
	{ $no='TR00'; }
	elseif($jnim==5)
	{ $no='TR0'; }
	elseif($jnim==6)
	{ $no='TR'; }
	$idpr=$no.$next;
$cari = mysql_query("select * from produk WHERE idproduk = '$_GET[idproduk]'");
$data = mysql_fetch_array($cari);
  $tgl = date('Y-m-d');
echo "<h2>Pengembalian produk</h2>";
if(isset($_GET['pesan'])){
		echo "
		
		<div class=\"ui-widget\">
			<div class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 0 .7em;\">
				<span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>
				<strong>".$_GET['pesan']."</strong>
			</div>
		</div>";
	}
echo "
          <form method=POST action='' name=text_form>
		  <p>
		    Kode produk : 
		      <input type=text name='idproduk' value='$data[idproduk]' id='idproduk'> 
		      <a href='index.php?mod=backend/pelanggan&pg=cari_barang'>cari</a></p>
		    <p>
		  Nama Produk : 
		    <input type=text name='nama_produk' value='$data[nama_produk]' id='nama_produk'>
		Jumlah : <input type=text name='qty' id='qty' size=2 onkeypress=\"return isNumberKey(event)\">&nbsp;
		<input type=submit class='btn btn-success' value='  Tambah  ' name='btnTambah' ><br>";
echo" <table>
          <tr>
		  <th>No</th>
		  <th width=75>Kode</th>
		  <th width=200>Nama Produk</th>
		  <th width=50>Jumlah</th>
		  <th width=70>Hapus</th>
		  </tr>"; 
    $tampil=mysql_query("SELECT * FROM tmp");
	$no=1;

	$counter = 1;
    while ($r=mysql_fetch_array($tampil)){
	if ($counter % 2 == 0) $warna = $warnaGenap;
	else $warna = $warnaGanjil;
       echo "<tr bgcolor='".$warna."'>
			 <td align=center>$no</td>
			 <td align=center>$r[idproduk]</td>";
			 
				$sql=mysql_query("SELECT * FROM produk where idproduk='$r[idproduk]'");
				$rs=mysql_fetch_array($sql);
				echo "<td>$rs[nama_produk]</td>";
			
       echo "
             
			 <td align=center>$r[jumlah]</td>";
			 
		echo "
			
			 <td align=center>
	               <a href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=barangmasuk&act=hapus&id=$r[id]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><img src='gambar/hapus.png' title='Hapus' alt='Hapus' width='14' height='14'></a>
				   
             </td></tr>";
      $no++;
	  $counter++;
    }
	
	$sql2=mysql_query("SELECT sum(jumlah) as jml FROM tmp");
	$rs2=mysql_fetch_array($sql2);
	$query="select * from pelanggan where idpelanggan='".$_SESSION['idpelanggan']."'";
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
    echo "
	<tr>
    <td colspan='3' align='right'><b>Jumlah: </b></td>
	
    <td align='center'><b>$rs2[jml]</b><input type=hidden name=total id=total value=$rs2[jml]></td>
	</tr>
	</table>
          <table>
		  <tr><td>No Return</td>   <td> : <input type=text name='noreturn' id='noreturn' value='$idpr' ></td></tr>
		   <tr><td>Invoice </td>   <td> : <input type=text name='noinvoice' id='noinvoice'><input type=hidden name=idpelanggan id=idpelanggan value=$row[idpelanggan]></td></tr>
          <tr><td>Tanggal </td>   <td> : <input type=text id='tgl_return' name='tgl_return' value='$tgl'></td></tr>
          <tr><td>Keterangan </td>   <td> : <input type=text id='keterangan' name='keterangan' value=''></td></tr>
		  

          </table>
		
		<input type=submit class='btn btn-success' value='  Simpan  ' name='btnSimpan' ></form><br>
		";

		if($_POST) {
			if(isset($_POST['btnTambah'])){
			if(trim($_POST[idproduk])==""){
				echo"<script>alert('Isi Dulu barang nya !!!',document.location.href='index.php?mod=backend/pelanggan&pg=return')</script>";
			}else if(trim($_POST[qty])==""){
				echo"<script>alert('Jumlah  Kosong !!!',document.location.href='index.php?mod=backend/pelanggan&pg=return')</script>";
			}else{
				$brg=substr($_POST[idproduk],0,5);
				mysql_query("INSERT INTO tmp(
								  idproduk,
								  jumlah) 
							VALUES(
								'$brg',
								'$_POST[qty]')");
				echo "<meta http-equiv='refresh' content='0; url='>";
			}
			}
		
			$noinvoice=substr($_POST[noinvoice],0,5);
			if(isset($_POST['btnSimpan'])){
			$sqlcek=mysql_query("SELECT * FROM tmp");
			$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
				mysql_query("INSERT INTO tbl_return(
								  noreturn,
								  noinvoice,
								  idpelanggan,
								  tgl_return,
								  total,
								  keterangan) 
							VALUES(
								'$_POST[noreturn]',
								'$noinvoice',
								'$row[idpelanggan]',
								'$_POST[tgl_return]',
								'$_POST[total]',
								'$_POST[keterangan]')");
				$sql=mysql_query("SELECT * FROM tmp");
				while($rs=mysql_fetch_array($sql)){
					mysql_query("INSERT INTO tbl_dreturn(
								  noreturn,
								  idproduk,								  
								  jumlah) 
							VALUES(
								'$_POST[noreturn]',
								'$rs[idproduk]',
								'$rs[jumlah]')");
					
				}
				
				mysql_query("truncate table tmp");
				
				echo"<script>alert('Data berhasil disimpan',document.location.href='index.php?mod=backend/pelanggan&pg=return')</script>";
				
				}
				else{
					echo"<script>alert('Data Kosong !!!!',document.location.href='index.php?mod=backend/pelanggan&pg=return')</script>";
				
				}
			}
		} 
?>
