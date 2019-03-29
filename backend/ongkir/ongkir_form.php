<?php
	
if(empty($_SESSION['email'])){
			echo "<p style='color:red'>akses denied</p>";
		exit();		
	}
	$aksi = null;
	if(isset($_GET['id'])) {
		$aksi = "edit";
		$id = $_GET['id'];
		//baris dibawah ini disesuaikan dengan nama tabel dan idtabelnya
			$sql = "select * from ongkir where kodepos='$id' ";
		$result = mysql_query($sql) or die(mysql_error());
		$data = mysql_fetch_object($result);

	} else {
		$aksi = "tambah";
	}?>



	<!--kolom kiri-->

		<h2> Form produk</h2>
		
<form  class="form-horizontal" method="POST" id="form1"  enctype="multipart/form-data"
action="ongkir/ongkir_action.php">
	
		<?php		$id = $_GET['id'];?>
		<input type='hidden' name='id' value="<?=$id?>">
	<div class="control-group">
			<label class="control-label" for="kodepos">Kode Pos</label>
			<div class="controls">
				<input type="text" name='kodepos' value='<?=$data->kodepos?>'class='required'
				>
			</div>
		</div>
	<div class="control-group">
			<label class="control-label" for="desa">Desa</label>
			<div class="controls">
				<input type="text" name='desa' value='<?=$data->desa?>'class='required'
				>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="kecamatan">Kecamatan</label>
			<div class="controls">
				<input type="text" name='kecamatan' value='<?=$data->kecamatan?>'class='required'
				>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="kabupaten">Kabupaten</label>
			<div class="controls">
				<input type="text" name='kabupaten' value='<?=$data->kabupaten?>'class='required'
				>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="provinsi">Provinsi</label>
			<div class="controls">
				<input type="text" name='provinsi' value='<?=$data->provinsi?>'class='required'
				>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="ongkir">Ongkir</label>
			<div class="controls">
				<input type="text" name='ongkir' value='<?=$data->ongkir?>'class='required'
				>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-success" name='aksi'value='<?=$aksi?>'>
				<?=$aksi?>
				</button>
			</div>
		</div>

</form>
</div>