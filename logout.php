<?php  

session_start();
require'functions.php';

	if(!isset($_SESSION['login'])){
		header('location:login.php');
	}

$id=$_SESSION['login'];


$online=mysqli_query($koneksi,"UPDATE online SET id_login='0' WHERE id_session=$id");

session_destroy();
header('location: login.php');

?>