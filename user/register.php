
		<script type="text/javascript">
		
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
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' Harap di isi.\n'; }
  } if (errors) alert('Warning:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
<script type="text/javascript">

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	
$().ready(function() {
	$("#kodepos").autocomplete("get_list.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
</script>


<section class="main-content">				
				<div class="row">
					<div class="span5">					
						<h4 class="title"><span class="text"><strong>Login</strong> Form</span></h4>
						<?php
						//jika login gagal 
						if($_GET['loginerror']){
							echo "<p class='text-error'>Maaf login gagal!</p>";
													}	?>		
						<form id='form1' action="user/login_action.php"  method="post" class=''>
							<input type="hidden" name="next" value="/">
							<fieldset>
								<div class="control-group">
									<label class="control-label">email</label>
									<div class="controls">
										<input type="text" name='email' placeholder="Masukan email" id="email" class="input-xlarge required email">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">Password</label>
									<div class="controls">
										<input type="password" placeholder="masukan password" id="password" class="input-xlarge required" name='password' > 
									</div>
								</div>
								<div class="control-group">
									<input tabindex="3" class="btn btn-inverse large" type="submit" value="Sign into your account">
									<hr>
									
								</div>
							</fieldset>
						</form>	
						
					</div>
					<div class="span7">					
						<h4 class="title"><span class="text"><strong>Register</strong> Form</span></h4>
						<?php
						//jika login gagal 
						if(isset($_GET['status'])){
							if($_GET['status']==0){
								echo "<p class='text-success'>Proses Registrasi  berhasil, silahkan login!</p>";
							}else {
							echo "<p class='text-error'>Proses Registrasi  gagal!</p>";
							}						}	?>		
						<form action="user/register_action.php"  id='form2' method="post" class="form-horizontal">
							<fieldset>
									<div class="control-group">
		<label class="control-label" for="nama">Nama pelanggan</label>
		<div class="controls">
			<input type="text" name='nama' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Jenis kelamin</label>
		<div class="controls">
			<select name='kelamin' >
				<option value='L'>Laki laki</option>
				<option value='P'>Perempuan</option>
			</select>
			
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Email</label>
		<div class="controls">
			<input type="text" name='email1' id='email'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Password</label>
		<div class="controls">
			<input type="password" name='password1' id='password'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >telp</label>
		<div class="controls">
			<input type="text" onkeypress='return hanyaAngka(event)'  name='telp' id='telp' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Kota</label>
		<div class="controls">
			<input type="text" name='kota' id='kota' class='required'
			>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" >Kode Post</label>
		<div class="controls">
			<input type="text" list="kodepos"  name='kodepos'  class='required'
			>
			<datalist id="kodepos">
<?php 
include "inc/config.php";
$qry=mysql_query("SELECT * From ongkir");
while ($t=mysql_fetch_array($qry)) {
echo "<option value='$t[kodepos] $t[kabupaten] '>";
}
?>
</datalist>

		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="alamat">Alamat</label>
		<div class="controls">
			<textarea name='alamat' class="input-xlarge">
					
				</textarea>
		</div>
	</div>

	
	


	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success" onClick="MM_validateForm('nama','','R','kelamin','','R','email1','','R','password1','','R','telp','','R','kota','','R','kodepos','','R','alamat','','R');return document.MM_returnValue" name='aksi'value='register'>
				Register
			</button>
		</div>
	</div>
							</fieldset>
						</form>					
					</div>				
				</div>
			</section>			