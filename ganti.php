<?php 

	session_start();
	require'functions.php';

	if(!isset($_SESSION['login'])){
		header('location:login.php');
	}
	$id=$_SESSION['login'];
	// $resul=mysqli_query($koneksi,"SELECT * FROM user WHERE id=$id");
	// $fetr=mysqli_fetch_assoc($resul);

	if(isset($_POST['submit'])){
		$namabaru=htmlspecialchars($_POST['namabaru']);
		// $username=$fetr['username'];
		// $password=$fetr['password'];
		// $foto=$fetr['foto'];
		// $status=$fetr['status'];
		
		$queryuser="UPDATE user SET 
						nama='$namabaru'
						WHERE iduser=$id
					";
					
		$sqluser=mysqli_query($koneksi, $queryuser);

		header('location: index.php');
		// $fet=mysqli_fetch_assoc($sql);
		// $nama=$fet['nama'];
	}

?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

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
                  <li><a href="index.php">kembali</a></li>
                </ul>
              </div>
            </div>
          </nav>
        </div>

        <!-- side nav -->
        <ul class="sidenav" id="mobile-nav">
          <li><a href="index.php">kembali</a></li>
        </ul>

        <!-- slider -->
        <section class="login">
            <h1 class="center blue-text">Ganti nama</h1>
          <form action="" method="post">
            <div class="row">
              <div class="col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">textsms</i>
                    <input type="text" name="namabaru" id="autocomplete-input" class="autocomplete" value="">
                    <label for="autocomplete-input">masukan nama baru</label>
                  </div>
                </div>
              </div>
            </div>
            <button class="btn waves-effect waves-light btn-center" type="submit" name="submit">Submit
              <i class="material-icons right">send</i>
            </button>
          </form>

        </section> 

        

      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <!-- <script>
        var sidenav=document.querySelectorAll('.sidenav');
        M.Sidenav.init(sidenav);

        var slider=document.querySelectorAll('.slider');
        M.Slider.init(slider,{
          indicators:false,
          interval:3000,
          height:500
        });

        var carousel=document.querySelectorAll('.carousel');
        M.Carousel.init(carousel,{
        fullWidth: false,
        numVisible:10,
        padding:20,
        shift:0
        });

        var box=document.querySelectorAll('.materialboxed');
        M.Materialbox.init(box,{
          inDuration:500
        });
      </script> -->
    </body>
  </html>