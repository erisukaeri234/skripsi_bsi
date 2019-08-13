<section id="slider" class="row">
    <div class="row sliderCont flexslider m0">
        <ul class="slides nav">
            <li>
                <img src="assets/images/slider/kopi.jpg" alt="">
                <div class="text_lines row m0">
                    <div class="container p0">
                        <h3>Inilah analogi kehidupan</h3>
                        <h2>Bahwa keindahan selalu tercipta ketika kita bisa memaknai kepahiran</h2>
                        <a href="#"><h4>show more</h4></a>
                    </div>
                </div> <!--Text Lines-->
            </li>
            <li>
                <img src="assets/images/slider/kopi2.jpeg" alt="">
                <div class="text_lines row m0">
                    <div class="container p0">
                        <h3>Mungkin perasaan masih bisa diatur</h3>
                        <h2>Tapi bagaimana dengan rindu</h2>
                        <a href="#"><h4>show more</h4></a>
                    </div>
                </div> <!--Text Lines-->
            </li>
            <li>
                <img src="assets/images/slider/kopi3.jpg" alt="">
                <div class="text_lines row m0">
                    <div class="container p0">
                        <h3>Kopi dan perempuan, mereka</h3>
                        <h2>saudara kembar. dua - duanya keras kepala perihal rasa</h2>
                        <a href="#"><h4>show more</h4></a>
                    </div>
                </div> <!--Text Lines-->
            </li>
        </ul>
    </div>
</section> 
<div class="row topFeatures m0">
    <div class="container">
        <ul class="nav nav-justified text-center">
            <li><img src="assets/images/icons/returns.png" alt="">30-days returns</li>
            <li><img src="assets/images/icons/delivery-car.png" alt="">fast delivery</li>
            <li><img src="assets/images/icons/tel24-7.png" alt="">24/7 customer support</li>
        </ul>
    </div>
</div>
<section id="furnitureHouse" class="row contentRowPad">
    <div class="container">
        <div class="row sectionTitle">
            <h3>this is Kopi</h3>
            <h5>shop over our best brands</h5>
        </div>
        <?php
//cek_akses_langsung();
        ?>
        <?php 
        $query = " SELECT produk.*,stok.* from produk,stok
        where produk.idproduk=stok.idproduk
        ";
        $id = $_GET['idkategori'];
        if(!empty($id)){				
            $query = " SELECT produk.*,stok.*
            from produk,stok
            where produk.idkategori='$id'
            and produk.idproduk=stok.idproduk";
        }
        $result = mysql_query($query) or die(mysql_error());
        $no = 1;
//proses menampilkan data
        while($rows = mysql_fetch_object($result)) {
            ?>
            <div class="row">
                <div class="col-sm-4 product">
                    <div class="productInner row m0">
                        <div class="row m0 imgHov">
                            <a href="#">    <?php
                            if (!empty($rows -> foto)) {
                             echo "<img src='upload/produk/" . $rows -> foto . "' />";
                         }
                         ?>	</a>
                         <div class="row m0 hovArea">
                            <div class="row m0 icons">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-exchange"></i></a></li>
                                    <li><a href="#"><i class="fa fa-expand"></i></a></li>
                                </ul>                                    
                            </div>
                            <div class="row m0 proType"><a href="#"><?=$rows->nama_produk?></a></div>
                            <div class="row m0 proRating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="row m0 proPrice"><i class="fa fa-usd"></i><?=format_rupiah($rows->harga_jual)?></div>
                        </div>
                    </div>
                    <div class="row m0 proName"><a href="single-product.html"><?=$rows->deskripsi?></a></div>
                    <div class="row m0 proBuyBtn">
                       <?php
                       if(!empty($_SESSION['idpelanggan']) && ($rows->jumlah>0)){ ?>
                        <a href="index.php?mod=chart&pg=chart&action=add&id=<?=$rows->idproduk?> " class='btn btn-warning' >add to cart</a><?php } ?>
                    </div>
                </div>
                </div><?php } ?>
                
            </div>
        </div>
    </div>
</section> <!--Feature Products 4 Collumn-->

