<?php
$query="select * from pelanggan where idpelanggan='".$_SESSION['idpelanggan']."'";
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
$aksi = "tambah";
?>
<script type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>


	<!--kolom kiri-->

		
 <section id="contactRow" class="row contentRowPad">
 	 <div class="container">
            <div class="row">
                <div class="col-sm-12">
 	 <h2> Form Konfirmasi Pembayaran</h2>		
<form  class="form-horizontal" method="POST" id="form1"  enctype="multipart/form-data"
action="backend/produk/transfer_action.php">
	<input type='hidden' name='idpelanggan' value="<?php echo $row['idpelanggan'] ?>">	
	<div class="control-group">
			<label class="control-label" for="noinvoice">No Invoice </label>
			<div class="controls">
				<input type="text" name='noinvoice' class="form-control" value='' class='required'
				>
			</div>
		</div>
		
	<div class="control-group">
			<label class="control-label" for="nama_rekening">Nama Rekening </label>
			<div class="controls">
				<input class="form-control" type="text" name='nama_rekening' value='' class='required'
				>
			</div>
		</div>
	<div class="control-group">
			<label class="control-label" for="bank">Bank Anda </label>
			<div class="controls">
				<input type="text" class="form-control" name='bank' value='' class='required'
				>
			</div>
		</div>
	<div class="control-group">
			<label class="control-label" for="rekening">Rekening anda </label>
			<div class="controls">
				<input type="text" name='rekening' class="form-control" value='' class='required'
				>
			</div>
		</div>
	<div class="control-group">
			<label class="control-label" for="transfer">Nominal </label>
			<div class="controls">
				<input type="text" class="form-control" name='transfer' value='' class='required'
				>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" class="form-control" for="foto">Bukti Transfer</label>
			<div class="controls">
				<input type="file" name='foto' 
				>
			</div>
		</div><br>
				<button type="submit" class="btn btn-primary btn-lg filled" name='aksi' onClick="MM_validateForm('noinvoice','','R','nama_rekening','','R','bank','','R','rekening','','R','transfer','','R','foto','','R');return document.MM_returnValue"  value='<?=$aksi?>'>
				<?=$aksi?>
				</button>

</form>
</div>
</div>
</div>
</section>