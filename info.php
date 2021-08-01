<?php 
	session_start();
	require'functions.php';

	if(!isset($_SESSION['login'])){
		header('location:login.php');
	}
	$iduser=$_GET['id'];
	$idl=$_SESSION['login'];
	$sqlstatus=mysqli_query($koneksi,"SELECT id,ids,nama,tanggal,jam,isistatus FROM user INNER JOIN status ON user.id=status.iduser WHERE id='$iduser'");
	$fets=mysqli_fetch_assoc($sqlstatus);
	$sqlkomentar=mysqli_query($koneksi,"SELECT id,iduserk,isistatus,idstatus,nama,tanggal,jam,tanggalk,jamk,isikomentar,foto,alamat,tgllahir,jnskelamin,notlp FROM user left JOIN tbkomentar ON user.id=tbkomentar.iduserk left JOIN status ON tbkomentar.idstatus=status.ids WHERE id='$iduser'");
	$feti=mysqli_fetch_assoc($sqlkomentar);
	// var_dump($feti)['foto'];die;
	$sqluser=mysqli_query($koneksi,"SELECT * FROM user WHERE id='$idl'");
	$fet=mysqli_fetch_assoc($sqluser);
	// var_dump($sqlstatus);
	// $sqlkomentar=mysqli_query($koneksi,'SELECT ids, nama,isikomentar FROM user INNER JOIN status ON user.id=status.iduser INNER JOIN tbkomentar ON status.ids=tbkomentar.idstatus WHERE id=$_SESSION["login"]');

?>
<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="css/style.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title><?= $feti['nama']; ?></title>
    </head>

    <body>
        <div class="navbar-fixed">
          <nav class="blue">
            <div class="container">
              <div class="nav-wrapper">
                <a href="#!" class="brand-logo">PositMedia</a>
                <a href="#" data-target="mobile-nav" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
                  <li>
                    <input style="margin-left: -20px; background-color: white; height:30px; width: 270px;" type="text" name="keyword" id="keyword" placeholder="Cari">
                  </li>
                  <li><a href="index.php">Beranda</a></li>
                  <li><a href="profil.php?id=<?=$fet['id']; ?>"><?=$fet['nama']; ?></a></li>
                  <li><a href="ganti.php">ganti</a></li>
                  <li><a href="logout.php">keluar</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>

        <!-- side nav -->
        <ul class="sidenav" id="mobile-nav">
          <li class="center">
            <div class="container">
                    <input style="height:30px;margin-top: 20px;border:1px solid grey;" type="text" name="keywords" id="keywords" placeholder="Search">
            </div>
            <div class="container">
          <li id="datadata" class="center" style="position: absolute; left:0;right:0;margin:-9px auto;font-size: 16px;background-color: white; width: 91%;"></li>
          </div>
          </li>
          
          <li class="center grey darken-4" style="height: 160px;">
            <img style="margin-top: 30px;" class="circle center" width="70" height="70" src="images/slider/<?=$fet['foto']; ?>">
            <a style="color: white;margin-top: -20px;font-size: 19px;" href="profil.php?id=<?=$fet['id']; ?>"><?=$fet['nama']; ?></a>
          </li>
          
          <li><a href="index.php">Beranda</a></li>
          <li><a href="ganti.php">ganti</a></li>
          <li><a href="logout.php">keluar</a></li>
        </ul>

        <!-- slider -->
        <section class="profil">
        	<div class="container center">

            <div class="center fixed" id="datacari" style="position: fixed;z-index: 99; margin: -18px auto; left: 0;right: 0;background-color:white; width: 50%;font-size: 17px;">
            </div>

        		<img class="materialboxed center" style="border-radius: 50%; margin:20px auto;" src="images/slider/<?= $feti['foto']; ?>" width="230" height="230">
        		<a href="profil.php?id=<?=$feti['id']; ?>"><h2 style="margin-top: -20px; padding-bottom: 20px;"><?=$feti['nama']; ?></h2></a>

            <!-- <div class="container"> -->
            <nav class="grey center">
              <div class="nav-wrapper">
                <ul id="nav-mobile">
                  <li style="width: 33%"><a href="profil.php?id=<?=$feti['id']; ?>">Post</a></li>
                  <li style="width: 33%"><a href="album.php?id=<?=$feti['id']; ?>">Album</a></li>
                  <li class="aktif" style="width: 34%"><a href="info.php?id=<?=$feti['id']; ?>">Info</a></li>
                </ul>
              </div>
            </nav><hr>
            <!-- </div> -->


            
            <div id="infouserdetai" class="grey lighten-2" style="margin-top: -6px;padding: 5px;">
              <!-- <h5>Nama : <span><?=$feti['nama']; ?></span></h5> -->
              <h5>Alamat : <span><?=$feti['alamat']; ?></span></h5>
              <h5>Tgl lahir : <span><?=$feti['tgllahir']; ?></span></h5>
              <h5>Jenis Kelamin : <span><?=$feti['jnskelamin']; ?></span></h5>
              <h5>No tlp : <span><?=$feti['notlp']; ?></span></h5>
            </div>
        	</div>
        </section>
        <!-- <section class="detailkomen" id="detailkome">
        	<div class="container"> -->
       <!-- footer -->

       <footer class="page-footer blue">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>

        

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/javascript.js"></script>
      <script>
        var sidenav=document.querySelectorAll('.sidenav');
        M.Sidenav.init(sidenav);

        // var slider=document.querySelectorAll('.slider');
        // M.Slider.init(slider,{
        //   indicators:false,
        //   interval:3000,
        //   height:500
        // });

        // var carousel=document.querySelectorAll('.carousel');
        // M.Carousel.init(carousel,{
        // fullWidth: false,
        // numVisible:10,
        // padding:20,
        // shift:0
        // });

        var box=document.querySelectorAll('.materialboxed');
        M.Materialbox.init(box,{
          inDuration:500,
        });
      </script>
    </body>
  </html>