<?php 

	session_start();
	require '../functions.php';

	if(!isset($_SESSION['login'])){
		header('location:../login.php');
	}

	$id=$_GET['id'];
	$idk=$_GET['idkomentar'];
	$idstatus=$_GET['idstatus'];
	$login=$_SESSION['login'];

	mysqli_query($koneksi,"DELETE FROM tbkomentar WHERE idk=$id");
	header('Location: ../komentar.php?id='.$idstatus.'&idkomentar=');

?>
