<?php  

	$koneksi=mysqli_connect('localhost','root','','positmedia');

	$sqlonline=mysqli_query($koneksi,'SELECT * FROM online');
	$fetsqlonline=mysqli_fetch_assoc($sqlonline);
	
	function query($query){
	global $koneksi;
	$result= mysqli_query($koneksi,$query);
	$rows=[];
	while($row = mysqli_fetch_assoc($result)){
		$rows[]= $row;
	}
	return $rows;
}

function querya($query){
	global $koneksi;
	$result= mysqli_query($koneksi,$query);
	$rows=[];
	while($row = mysqli_fetch_assoc($result)){
		$rows[]= $row;
	}
	return $rows;
}

function uploadgaleri(){
		$namaFile= $_FILES["foto"]["name"];
		$ukuranFile= $_FILES["foto"]["size"];
		$error= $_FILES["foto"]["error"];
		$tmpname= $_FILES["foto"]["tmp_name"];

	if( $error === 4){
		echo"<script>
				alert('Pilih Foto Terlebih Dahulu!!!');
				document.location.href='index.php';
			</script>";
		return false;
	}
	$exgamval=['jpg','jpeg','png','gif'];
	$exgam=explode('.', $namaFile);
	$exgam=strtolower(end($exgam));
	if(!in_array($exgam, $exgamval)){
		echo"<script>
				alert('Yang Anda Upload Bukan Gambar!!!');
				document.location.href='index.php';
			</script>";
		return false;
	}
	if($ukuranFile > 1000000){
		echo"<script>
				alert('Ukuran Gambar Terlalu Besar');
				document.location.href='index.php';
			</script>";
		return false;
	}

	$namaFileBaru=uniqid();
	$namaFileBaru.='.';
	$namaFileBaru.=$exgam;


	move_uploaded_file($tmpname, 'images/album/' . $namaFileBaru);
	
	return $namaFileBaru;

}
	

?>