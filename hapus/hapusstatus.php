<?php 

	session_start();
	require '../functions.php';

	if(!isset($_SESSION['login'])){
		header('location:../login.php');
	}

	$id=$_GET['ids'];
	$login=$_SESSION['login'];
	$idp=$_GET['id'];
if($_GET['ids']){
	mysqli_query($koneksi,"DELETE FROM status WHERE ids=$id");
	header('Location: ../index.php');
}else{
	mysqli_query($koneksi,"DELETE FROM status WHERE ids=$idp");
	header('Location: ../profil.php?id='.$login);
}
	
	
	
	

?>
