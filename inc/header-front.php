<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from premiumlayers.net/demo/html/furniture/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Apr 2019 15:58:46 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kurir Kopi</title>
    
    <!--Favicons-->

    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/logov.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/logov.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/logov.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    <!--Bootstrap and Other Vendors-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/owl.carousel/css/owl.carousel.css">    
    
    <link rel="stylesheet" type="text/css" href="assets/vendors/lightbox/css/lightbox.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="assets/vendors/flexslider/flexslider.css" media="screen" />
    
    <!--Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800|Montserrat:400,700' rel='stylesheet' type='text/css'>
    
    <!--Mechanic Styles-->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
  <![endif]-->

</head>
<body>

    <header class="row" id="header">
        <div class="row m0 top_menus">
            <div class="container">
                <div class="row">
                    <ul class="nav nav-pills fleft">
                        <li><a href="index.php">home</a></li>
                        <li><a href="index.php?mod=page&pg=about">about</a></li>
                        <li><a href="index.php?mod=page&pg=contact">contact us</a></li>
                    </ul>
                    <ul class="nav nav-pills fright">
                        <li><a href="index.php?mod=chart&pg=chart">cart</a></li><!-- 
                        <li><a href="#">track order</a></li> -->
                        <li><a href="#">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row m0 logo_line">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 logo">
                        <a href="index.html" class="logo_a"><img src="assets/images/logo.png" alt="Furniture House"></a>
                    </div>
                    <div class="col-sm-7 searchSec">
                        <div class="fleft searchForm">
                            <form action="#" method="get">
                                <div class="input-group">
                                    <input type="hidden" name="search_param" value="all" id="search_param">
                                    <input type="search" class="form-control" placeholder="Search Products">
                                    <div class="input-group-btn searchFilters">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span id="searchFilterValue">All Categories</span> <i class="fa fa-angle-down"></i>
                                        </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <?php
                                        $query="SELECT * from kategori";
                                        $result=mysql_query($query) or die(mysql_error());
                                        while($rows=mysql_fetch_object($result)){
                                                ?>
                                                <li><a href="#all"><?php echo $rows->nama_kategori; ?></a></li>
                                                
                                        <?php } ?>
                                            </ul>
                                    </div><!-- /btn-group -->
                                    <span class="input-group-btn searchIco">
                                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                                    </span>
                                </div><!-- /input-group -->
                            </form>
                        </div>
                        <div class="fleft wishlistCompare">
                            <ul class="nav">
                                <li><a href="#"><i class="fa fa-heart"></i> Wishlist (3)</a></li>
                                <li><a href="#"><i class="fa fa-exchange"></i> Compare (2)</a></li>
                            </ul>
                        </div>
                        <div class="">                        
                            <div  >
                                <a href="index.php?mod=chart&pg=chart"> <i class="fleft cartCount"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-default m0 navbar-static-top">
            <div class="container-fluid container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                        <i class="fa fa-bars"></i> Navigation
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="mainNav">
                	<?php if(empty($_SESSION['idpelanggan'])){ ?>
                        <ul class="nav navbar-nav">

                            <li><a href="index.php">Home</a></li>
                            <li><a href="index.php?mod=user&pg=register">Register/Login</a></li>
                            <li><a href="index.php?mod=page&pg=about">About Us</a></li>
                            <li><a href="index.php?mod=page&pg=contact">Contac Us</a></li>
                        </ul>  
                    <?php }else{ ?>    
                        <ul class="nav navbar-nav">
                         <li><a href="index.php?mod=chart&pg=chart">Chart</a></li>	
                         <li><a href="index.php?mod=chart&pg=invoice">Invois</a></li>
                         <li><a href="index.php?mod=backend/produk&pg=transfer">Konfirmasi</a></li>
                         <li><a href="index.php?mod=backend/pelanggan&pg=return">Return</a></li>	
                         <li><a href="index.php?mod=user&pg=profil">Profil</a></li>	
                         <li><a href="user/logout.php">logout</a></li>	
                         </ul><?php	} ?>        
                     </div><!-- /.navbar-collapse -->
                 </div><!-- /.container-fluid -->
             </nav>

         </header> <!--Header-->

         <!--Slider-->
         <div class="hero-unit"><br>
          <p><a class="btn btn-primary btn-lg filled" href="index.php?mod=page&pg=produk">Mulai Berbelanja &raquo;</a></p>

      </div>