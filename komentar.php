<?php 
	session_start();
	require'functions.php';

	if(!isset($_SESSION['login'])){
		header('location:login.php');
	}
	$idstatus=$_GET['id'];
  $idkomentar=$_GET['idkomentar'];
	$idl=$_SESSION['login'];

  $update=mysqli_query($koneksi,"UPDATE tbkomentar SET notif='sudah' WHERE idk=$idkomentar");

  date_default_timezone_set('Asia/Jakarta');
  $tanggal=date('d m Y');
  $waktu=date('H i');

  if(isset($_POST['submit'])){
    $komentar=htmlspecialchars($_POST['komentar']);
    $datakomentar="INSERT INTO tbkomentar VALUES('','$idstatus','$idl','$tanggal','$waktu','$komentar','belum')";
    $updatekomentar=mysqli_query($koneksi, $datakomentar);
  }


	$sqlstatus=mysqli_query($koneksi,"SELECT id,ids,nama,tanggal,jam,isistatus,foto,fotof,tipe FROM user INNER JOIN status ON user.id=status.iduser WHERE ids='$idstatus'");
	$fets=mysqli_fetch_assoc($sqlstatus);
	$sqlkomentar=mysqli_query($koneksi,"SELECT id,idk,iduserk,isistatus,idstatus,nama,tanggalk,jamk,isikomentar,foto,fotof,tipe FROM user left JOIN tbkomentar ON user.id=tbkomentar.iduserk left JOIN status ON tbkomentar.idstatus=status.ids WHERE ids='$idstatus' ORDER BY idk asc");
	$feti=mysqli_fetch_assoc($sqlkomentar);
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
      <title>posit</title>
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
                  <li><!-- <img style="margin-bottom:-8px;" class="circle" width="25" height="25" src="images/slider/<?=$fet['foto']; ?>"> --><a href="profil.php?id=<?=$fet['id']; ?>"><?=$fet['nama']; ?></a></li>
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
        <section class="statu">
        	<div class="container">

            <div class="center fixed" id="datacari" style="position: fixed;z-index: 99; margin: -5px auto; left: 0;right: 0;background-color:white; width: 50%;font-size: 17px;">
            </div>

        		<div class="col s12 m8 offset-m2 l6 offset-l3">
			        <div class="card-panel grey lighten-5 z-depth-1">
			          <div class="row valign-wrapper">
			            <div class="col ">
			              <a href="profil.php?id=<?=$fets['id']; ?>"><img width="50" height="50" src="images/slider/<?=$fets['foto'];?>" alt="" class="circle"></a> <!-- notice the "circle" class -->
			            </div>
			            <div class="col">
			              <span class="black-text">
			                <a style="margin-left: -10px; font-size: 25px;font-weight: bold;"  href="profil.php?id=<?=$fets['id']; ?>"><?=$fets['nama']; ?></a><br>
			              <span style="font-size: 12px;margin-left: -10px;color:grey;"><?=$fets['tanggal']." ".$fets['jam']; ?></span>
			              </span>
			            </div>
			          </div>

                <?php if($fets['tipe']=='status'){ ?>
		        		  <span style="font-size: 20px;"><?=$fets['isistatus'];?></span><br>
                <?php }else{ ?>
                  <span><img class="materialboxed" src="images/album/<?=$fets['fotof'];?>" width="100%" height="300"></span><br>
                <?php } ?>

		        	<?php if($fets['id']==$idl): ?>
		        		<a href="hapus/hapusstatus.php?id=<?=$fets['ids']; ?>" onclick="return confirm('Yakin ingin hapus status ini?');">hapus</a>
		        	<?php endif; ?>
		        		<br>

		        	  <div class="komentar">
        	<!-- <div class="container"> -->
		        		<span style="font-size: 20px; font-weight: bold;">komentar(<?php if($feti['idstatus']==$idstatus){
		        			echo mysqli_num_rows($sqlkomentar);
		        		}else{
		        			echo"0";
		        		}?>)</span><br>
				        	<hr>


		        		<?php foreach($sqlkomentar as $status): ?>
                  <?php if(empty($status['isikomentar'])){
                    echo"";
                  }else{ ?>
                  <span><img style="border-radius: 50%;" src="images/slider/<?= $status['foto']; ?>" width="25" height="25"></span>
		        			<span style="font-size: 17px; font-weight: bold;"><a href="profil.php?id=<?=$status['id']; ?>"><?= $status['nama']; ?></a></span>
		        			<span style="font-size: 17px"><?= $status['isikomentar']; ?></span><br>
		        			<span style="font-size: 11px; margin-bottom: 10px;color: grey;"><?= $status['tanggalk']." ".$status['jamk']; ?></span>
		        		<?php if($status['iduserk']==$idl): ?>
		        			<a href="hapus/hapuskomentar.php?id=<?=$status['idk']; ?>&idstatus=<?=$idstatus; ?>" onclick="return confirm('Yakin ingin hapus komentar ini?');">hapus</a>
		        		<?php endif; ?><br><br>
                <?php } ?>
		        		<?php endforeach; ?>

		        		<form action="" method="post">
				            <div class="row">
				              <div class="col s12">
				                <div class="row">

				                  <div class="input-field col s12">

                            <textarea style="height: 70px; border:1px solid #bbb;" id="textarea1" class="materialize-textarea" name="komentar" cols="25" rows="5" required></textarea>
                            <label for="textarea1">Ketikan komentar...</label>
                            <button class="btn waves-effect waves-light btn-center" type="submit" name="submit">Kirim
                              <i class="material-icons right">send</i>
                            </button>

                          </div>

				                </div>
				              </div>
				            </div>
			          	</form>
	        		</div>
			  	</div>

        	</div>
        </section>

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
          inDuration:500
        });
      </script>
    </body>
  </html>