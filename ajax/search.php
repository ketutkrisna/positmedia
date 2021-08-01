<?php 
	require'../functions.php';
	$keyword=$_GET['keyword'];

	$datacari="SELECT * FROM user WHERE 
			nama LIKE '$keyword%' 	
		";
$tabel=mysqli_query($koneksi,$datacari);

?>

<?php foreach($tabel as $namauser): ?>
	<span style="padding: 2px; display: inline-block;"><a href="profil.php?id=<?=$namauser['id']; ?>"><img style="border-radius: 50%;" src="images/slider/<?=$namauser['foto']; ?>" width="20" height="20"> <?=$namauser['nama'];  ?></a></span><br>
<?php endforeach; ?>