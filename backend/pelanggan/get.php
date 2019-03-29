

<link href="../js/biru.min.css" rel="stylesheet" type="text/css" />

<a href=''>CARI DATA</a>
<p>&nbsp;</p>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(function() {

$("#search_box").keyup(function() {
    var search_word = $("#search_box").val();
    var dataString = 'search_word='+ search_word;
	if(search_word=='')
	{
	}
	else
	{
	$.ajax({
	type: "GET",
    url: "cari_barang.php",
    data: dataString,
    cache: false,
    beforeSend: function(html) {
   
	document.getElementById("insert_search").innerHTML = ''; 
	$("#flash").show();
	$("#searchword").show();
	$(".searchword").html(search_word);
	$("#flash").html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;Loading Results...');
	               
            },
    success: function(html){
   $("#insert_search").show();
   $("#insert_search").append(html);
   $("#flash").hide();
  }
});
		
	}
		

    return false;
	});



});

</script>
<form method="get" class="form-search">
		<div class="">
			<input type="text"  name="search" id="search_box"
			placeholder=" Nama Barang? "
			class="input-xxlarge search-query">
			
		</div>
	</form>
		<br /><br />	  
  <div>
			  <div id="flash"></div>
			  <table id="insert_search" class="update" cellpadding=0 cellspacing=0 border=1 width=100%>
				
			  </table>
  </div>
</div>

