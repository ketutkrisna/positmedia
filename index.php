<?php  
	
	session_start();
	require'functions.php';

	if(!isset($_SESSION['login'])){
		header('location:login.php');
	}

  

	$id=$_SESSION['login'];
	$sql=mysqli_query($koneksi,"SELECT * FROM user WHERE id='$id'");
	$fet=mysqli_fetch_assoc($sql);
	$nama=$fet['nama'];

  // if(session_destroy()){
  //   $onlinea=mysqli_query($koneksi,"UPDATE online SET id_login='0' WHERE id_session=$id");
  // }

	date_default_timezone_set('Asia/Jakarta');
  $tanggal=date('d m Y');
  $waktu=date('H i');
  
	if(isset($_POST['submit'])){
		$ketik=htmlspecialchars($_POST['ketik']);
    $tipe=htmlspecialchars($_POST['tipe']);
    $fotof=htmlspecialchars($_POST['fotof']);
		$datastatus="INSERT INTO status VALUES('','$id','$tanggal','$waktu','$ketik','kosong','status')";
		$sqlstatus=mysqli_query($koneksi, $datastatus);
    header('location: index.php');
    return false;
	}
  if(isset($_POST['upload'])){

    $foto=uploadgaleri();
    if(!$foto){
    return false;
  }
    $datafoto="INSERT INTO status VALUES('','$id','$tanggal','$waktu','kosong','$foto','foto')";
    $sqlfoto=mysqli_query($koneksi, $datafoto);
  }

	$pilihstatus=mysqli_query($koneksi,"SELECT id,ids,idk,nama,tanggal,tanggalk,jam,jamk,isistatus,foto,fotof,tipe,idstatus,isikomentar,iduserk,iduser  FROM user LEFT JOIN status ON user.id=status.iduser LEFT JOIN tbkomentar ON status.ids=tbkomentar.idstatus AND tbkomentar.iduserk=user.id ORDER BY ids desc");
  $pilihstatusnotif=mysqli_query($koneksi,"SELECT id,ids,idk,nama,tanggal,tanggalk,jam,jamk,isistatus,foto,fotof,tipe,idstatus,isikomentar,iduserk,iduser,notif from status left join tbkomentar on status.ids=tbkomentar.idstatus left join user on user.id=status.iduser where iduser=$id and iduserk!=user.id order by idk desc");
  $fetnotifikasi=mysqli_fetch_assoc($pilihstatusnotif);
  // $pilihstatusds=mysqli_query($koneksi,"SELECT id,ids,nama,tanggal,jam,isistatus,foto,fotof,tipe,idstatus,isikomentar,iduserk,iduser  FROM user LEFT JOIN status ON user.id=status.iduser LEFT JOIN tbkomentar ON status.ids=tbkomentar.idstatus");


  $online=mysqli_query($koneksi,"UPDATE online SET id_login='$id' WHERE id_session=$id");

  $useronline=mysqli_query($koneksi,"SELECT * FROM online WHERE id_login>0");
  $gabung=mysqli_query($koneksi,"SELECT id,id_login,nama FROM user INNER JOIN online ON user.id=online.id_login");

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
      <title>Beranda</title>
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
                    <input style="margin-left: -20px; background-color: white; height:30px; width: 250px;" type="text" name="keyword" id="keyword" placeholder="Cari">
                  </li>
                  <li><a href="index.php">Beranda</a></li>
                  <li></li>
                  <li><a href="profil.php?id=<?=$id; ?>"><span><img style="margin-bottom:-8px;" class="circle" width="25" height="25" src="images/slider/<?=$fet['foto']; ?>"></span> <?=$fet['nama']; ?> </a></li>
                  <li id="notifikasi"><a href="#">Notifikasi <?php
                    $angka=mysqli_query($koneksi,"SELECT id,ids,idk,nama,tanggal,tanggalk,jam,jamk,isistatus,foto,fotof,tipe,idstatus,isikomentar,iduserk,iduser,notif from status join tbkomentar on status.ids=tbkomentar.idstatus and status.iduser=$id join user on user.id=status.iduser and tbkomentar.iduserk!=user.id where notif='belum' order by idk desc");
                    $row=mysqli_num_rows($angka);
                    if($row==0){

                    }else{
                    echo '<span style="font-weight:bold;background-color:red;border-radius:50%;padding:0px 6px 2px 6px;">'.mysqli_num_rows($angka).'</span>';
                    } 
                   ?></a>
                    <li class="fixed" id="barnotif" style="width:265px;background-color:#fff;position:absolute;margin-left: 259px;margin-top:64px;max-height:300px;overflow:auto;border:1px solid grey;">

                <?php foreach($pilihstatusnotif as $notif): ?>
                  
                    <?php if($notif['notif']=='belum'){ ?>
                      <span><a class="<?=$notif['notif']; ?>" style="height:40px;line-height:20px;font-size:13px;color:black;" href="komentar.php?id=<?=$notif['ids']; ?>&idkomentar=<?=$notif['idk']; ?>">
                        <span>NEW komentar : <?=$notif['isikomentar']; ?></span>
                       </a></span>
                    <?php }else{ ?>
                      <span><a class="<?=$notif['notif']; ?>" style="height:40px;line-height:20px;font-size:13px;color:black;" href="komentar.php?id=<?=$notif['ids']; ?>&idkomentar=<?=$notif['idk']; ?>">
                        <span>komentar : <?=$notif['isikomentar']; ?></span>
                       </a></span>
                    <?php } ?>
                <?php endforeach; ?>

                    </li>
                  </li>
                  <li id="setting"><a href="#">Setting</a>
                    <li class="fixed" id="barsetting" style="width:78px;background-color:#eee;position:absolute;margin-left: 523px;margin-top:64px;border:1px solid grey;">
                      <a style="height:35px;line-height:30px;color:black;" href="setting.php">Setting</a>
                      <a style="height:35px;line-height:30px;color:black;" href="logout.php">Logout</a>
                    </li>
                  </li>
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
            <a style="color: white;margin-top: -20px;font-size: 19px;" href="profil.php?id=<?=$id; ?>"><?=$fet['nama']; ?></a>
          </li>
          
          <li><a href="index.php">Beranda</a></li>
          <li><a href="#">Notifikasi</a></li>
          <li><a href="logout.php">Keluar</a></li>
        </ul>

        <!-- slider -->
         <div class="slider">
          <ul class="slides">
            <li>
              <img src="images/slider/satu.png">
              <div class="caption center-align">
                <h3>hello, <?=$fet['nama']; ?></h3>
                <!-- <h5 class="light grey-text text-lighten-3">Here's is slider</h5> -->
              </div>
            </li>
            <li>
              <img src="images/slider/dua.png">
              <div class="caption center-align">
                <h3>Semoga sehat selalu!</h3>
                <!-- <h5 class="light grey-text text-lighten-3">Here's is slider</h5> -->
              </div>
            </li>
            <li>
              <img src="images/slider/tiga.png">
              <div class="caption center-align">
                <h3>Semoga harimu menyenangkan!</h3>
                <!-- <h5 class="light grey-text text-lighten-3">Here's is slider</h5> -->
              </div>
            </li>
            <li>
              <img src="images/slider/empat.png">
              <div class="caption center-align">
                <h3>Selamat berkunjung di sini!</h3>
                <!-- <h5 class="light grey-text text-lighten-3">Here's is slider</h5> -->
              </div>
            </li>
          </ul>
        </div>

        <!-- carousel -->
        <!-- <div class="carou">
          <div class="carousel">
            <a class="carousel-item" href="#one!"><img class="materialboxed" src="images/slider/<?= $fet['foto']; ?>"></a>

            <?php foreach($status as $stat):?>
            	<a class="carousel-item" href="#one!"><img class="materialboxed" src="images/slider/<?= $stat['foto']; ?>"></a>
            <?php endforeach; ?> -->
            <!-- <a class="carousel-item" href="#two!"><img class="materialboxed" src="images/slider/dua.png"></a>
            <a class="carousel-item" href="#three!"><img class="materialboxed" src="images/slider/tiga.png"></a>
            <a class="carousel-item" href="#four!"><img class="materialboxed" src="images/slider/empat.png"></a>
            <a class="carousel-item" href="#two!"><img class="materialboxed" src="images/slider/dua.png"></a>
            <a class="carousel-item" href="#three!"><img class="materialboxed" src="images/slider/tiga.png"></a>
            <a class="carousel-item" href="#four!"><img class="materialboxed" src="images/slider/empat.png"></a>
            <a class="carousel-item" href="#two!"><img class="materialboxed" src="images/slider/dua.png"></a> -->
         <!--  </div>
        </div> -->



        <section class="tambah center" style="margin-top: 50px;margin-bottom: 30px;">
        	<div class="container">
            <div class="center fixed" id="datacari" style="position: fixed;z-index: 99; margin: -249px auto; left: 0;right: 0;background-color:white; width: 50%;font-size: 17px;">
            </div>
            <h4>User online <?=mysqli_num_rows($useronline)-1; ?></h4>
            <div class="daftar">
              <?php foreach($gabung as $daftar): ?>
                <?php if($daftar['id']==$id){}else{?>
                <li style="color: green;"><span><a href="profil.php?id=<?=$daftar['id']; ?>"><?=$daftar['nama']; ?></a></span></li>
                <?php } ?>
              <?php endforeach; ?>
            </div>
        		<form action="" method="post">
        			<input type="hidden" name="tipe" value="status">
              <input type="hidden" name="fotof" value="kosong">

              <div class="input-field col s12">
              <textarea style="height: 70px; border:1px solid #bbb;" id="textarea1" class="materialize-textarea" name="ketik" cols="25" rows="5" required></textarea>
              <label for="textarea1">Apa yang anda pikirkan...</label>
              </div>

              <button class="btn waves-effect waves-light btn-center" type="submit" name="submit">Kirim
              </button>
        		</form>
            
            <form action="" method="post" enctype="multipart/form-data">
               <div class="file-field input-field">
                  <div class="btn">
                    <span>File</span>
                    <input type="hidden" name="tipee" value="foto">
                    <input type="hidden" name="status" value="kosong">
                    <input type="file" multiple name="foto">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="silahkan pilih gambar">
                  </div>
                </div>
               <button class="btn waves-effect waves-light btn-center" type="submit" name="upload">Upload
              </button>
            </form>
        	</div>
        </section>

        <div class="container">
        <nav class="grey center">
          <div class="nav-wrapper">
            <ul id="nav-mobile">
              <li style="width: 100%"><a href="index.php">Recent Post</a></li>
            </ul>
          </div>
        </nav><hr>
        </div>

    <?php foreach($pilihstatus as $tampil): ?>

        <?php 
          $b=$tampil['ids']; 
          $a=mysqli_query($koneksi,"SELECT * from tbkomentar where idstatus=$b"); 
        ?>

      <?php if($tampil['tipe']=='status'){ ?>
    	<section class="statu">
        	<div class="container">

        		<div class="col s12 m8 offset-m2 l6 offset-l3">
			        <div class="card-panel grey lighten-5 z-depth-1">
			          <div class="row valign-wrapper">
			            <div class="col ">
			              <a href="profil.php?id=<?=$tampil['id']; ?>"><img width="50" height="50" src="images/slider/<?=$tampil['foto'];?>" alt="" class="circle"></a> <!-- notice the "circle" class -->
			            </div>
			            <div class="col">
			              <span class="black-text">
			                <a style="margin-left: -10px; font-size: 20px;"  href="profil.php?id=<?=$tampil['id']; ?>"><?=$tampil['nama']; ?></a><br>
			              <span style="font-size: 12px;margin-left: -10px;color:grey;"><?=$tampil['tanggal']." ".$tampil['jam']; ?></span>
			              </span>
			            </div>
			          </div>
		        		<span style="font-size: 16px;"><?=$tampil['isistatus'];?></span><br>
		        	
			        	<div class="aksi center">
			        	<p>
                  <span style="padding: 7px; font-size: 15px;"><a href="">suka</a></span> 
                  <span style="padding:7px; font-size: 15px;"><a href="komentar.php?id=<?=$tampil['ids']; ?>&idkomentar=<?=$tampil['idk']; ?>">komentar <?php if(mysqli_num_rows($a)==0){
                    echo '';
                    }else{
                     echo mysqli_num_rows($a); 
                    } ?> 
                    </a></span>

                  <?php if($tampil['id']==$id): ?>
                  <span style="padding:7px;"><a href="hapus/hapusstatus.php?ids=<?=$tampil['ids']; ?>" onclick="return confirm('Yakin ingin hapus status ini?');">hapus</a></span>
                  <?php endif; ?>

                </p>
			        	</div>
	        		</div>
			  	</div>


        	</div>
        </section>

        <?php }else if($tampil['tipe']=='foto'){ ?>

          <section class="statu">
          <div class="container">
            
            <div class="col s12 m8 offset-m2 l6 offset-l3">
              <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                  <div class="col ">
                    <a href="profil.php?id=<?=$tampil['id']; ?>"><img width="50" height="50" src="images/slider/<?=$tampil['foto'];?>" alt="" class="circle"></a> <!-- notice the "circle" class -->
                  </div>
                  <div class="col">
                    <span class="black-text">
                      <a style="margin-left: -10px; font-size: 20px;"  href="profil.php?id=<?=$tampil['id']; ?>"><?=$tampil['nama']; ?></a><br>
                    <span style="font-size: 12px;margin-left: -10px;color:grey;"><?=$tampil['tanggal']." ".$tampil['jam']; ?></span>
                    </span>
                  </div>
                </div>

                <span><img class="materialboxed" src="images/album/<?=$tampil['fotof'];?>" width="250" height="140"></span><br>
                <div class="aksi center">
                <p>
                  <span style="padding: 7px; font-size: 15px;"><a href="">suka</a></span> 
                  <span style="padding:7px; font-size: 15px;"><a href="komentar.php?id=<?=$tampil['ids']; ?>&idkomentar=<?=$tampil['idk']; ?>">komentar <?php if(mysqli_num_rows($a)==0){
                    echo '';
                    }else{
                     echo mysqli_num_rows($a); 
                    } ?>
                </a></span>
              <?php if($tampil['id']==$id): ?>
                <a href="hapus/hapusstatus.php?ids=<?=$tampil['ids']; ?>" onclick="return confirm('Yakin ingin hapus status ini?');">hapus</a>
              <?php endif; ?>
                </p>
                </div>
              </div>
          </div>

          </div>
        </section>

        <?php } ?>
      
    <?php endforeach; ?>

			        





        		

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

        var slider=document.querySelectorAll('.slider');
        M.Slider.init(slider,{
          indicators:false,
          interval:3000,
          height:200
        });

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