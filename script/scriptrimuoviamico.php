<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$EmailAmico=trim($_GET['EmailPersonaDEL']);
	$email=trim($_SESSION['username']);
	mysql_query("CALL Rimuovi_Amicizia('$email','$EmailAmico');");
	header("Location:../first_page.php?avviso=Amicizia%20rimossa%20!");
?>
