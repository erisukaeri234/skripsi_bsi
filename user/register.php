
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
    
    <section id="contactRow" class="row contentRowPad">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="row m0">
                         <?php
                        //jika login gagal 
                        if($_GET['loginerror']){
                            echo "<p class='text-error'>Maaf login gagal!</p>";
                                                    }   ?>      
                        <h4 class="contactHeading heading">contact form style</h4>
                    </div>
                    <div class="row m0 contactForm">
                        <form class="row m0" id="contactForm" method="post" name="contact" action="user/login_action.php">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="name">Email</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                                <div class="col-sm-12">
                                    <label for="email">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                           
                            <button class="btn btn-primary btn-lg filled" type="submit">Login</button>                            
                        </form>
                        <div id="success">
                                
                        </div>
                        <div id="error">
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row m0">
                        <h4 class="contactHeading heading">Register</h4>
                    </div>
                    <?php
                        //jika login gagal 
                        if(isset($_GET['status'])){
                            if($_GET['status']==0){
                                echo "<p class='text-success'>Proses Registrasi  berhasil, silahkan login!</p>";
                            }else {
                            echo "<p class='text-error'>Proses Registrasi  gagal!</p>";
                            }                       }   ?>      
                    <form class="row m0" id="contactForm" method="post" name="contact" action="user/register_action.php">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="name">Nama pelanggan</label>
                                    <input type="text" class="form-control" name="nama" id="nama" required>
                                </div>
                                <div class="col-sm-12">
                                    <label for="email">Jenis Kelamin</label>
                                    <div class="controls">
                                        <select name='kelamin' >
                                            <option value='L'>Laki laki</option>
                                            <option value='P'>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="name">Email</label>
                                    <input type="text" class="form-control" name="email1" id="email" required>
                                </div>
                                <div class="col-sm-12">
                                    <label for="name">Password</label>
                                    <input type="text" class="form-control" name="password1" id="nama" required>
                                </div>
                                <div class="col-sm-12">
                                    <label for="name">Telp</label>
                                    <input type="text" class="form-control" onkeypress='return hanyaAngka(event)'  name='telp'  id="telp" required>
                                </div>
                                <div class="col-sm-12">
                                    <label for="name">Kota</label>
                                    <input type="text" class="form-control" name='kota' id='kota' required>
                                </div>
                                <div class="col-sm-12">
                                    <label for="kodepos"> Kode poas</label>
                                    <input type="text" class="form-control" list="kodepos"  name='kodepos'  class='required'
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
                                <div class="col-sm-12">
                                    <label> Alamat</label>
                                    <textarea class="form-control" name="alamat"></textarea>
                                </div>
                            </div>
                           <br>
                            <button class="btn btn-primary btn-lg filled" type="submit">Register</button>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
