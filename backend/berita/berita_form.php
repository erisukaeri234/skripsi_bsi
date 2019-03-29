<script type="text/javascript">

    function hanyaAngka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
    </script>
<?php
cek_status_login($_SESSION['email']); 
	$aksi = null;
	if(isset($_GET['id'])) {
		$aksi = "edit";
		$id = $_GET['id'];
		//baris dibawah ini disesuaikan dengan nama tabel dan idtabelnya
		$sql = "select * from berita where idberita='$id' ";
		$result = mysql_query($sql) or die(mysql_error());
		$baris = mysql_fetch_object($result);

	} else {
		$aksi = "tambah";
	}?>
	<script type="text/javascript" src="../assets/bootstrap/js/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src='../assets/bootstrap/js/editor.js'></script> 

<form  class="form-horizontal" method="POST" id="form1" action="berita/berita_action.php" enctype="multipart/form-data">
 <legend>  berita</legend>
	<input type='hidden' name='id' value="<?=$id?>">
  <div class="control-group">
    <label class="control-label" for="judul">judul</label>
    <div class="controls">
      <input type="text" class='required' name='judul' id="judul" c
      value='<?=$baris->judul;?>' >
    </div>
   </div>
    
  <div class="control-group">
    <label class="control-label" for="gambar">Gambar</label>
    <div class="controls">
      <input type="file" name='gambar' id="gambar" 
       >
    </div>
   </div>
   <div class="control-group">
    <label class="control-label" for="isi">isi</label>
    <div class="controls">
      <textarea name='isi'   rows="20" class='required'><?=$baris->isi;?> </textarea>
     
    </div>
  </div>

  <div class="control-group">
    <div class="controls">
     
      <button type="submit" class="btn btn-success" name='aksi'value=<?=$aksi?> ><?=$aksi?></button>
    </div>
  </div>
</form>

<div id="form1_errorloc"  class="text-error"></div>
