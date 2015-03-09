<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$Nomegr=$_GET['NomeGruppo'];
	mysql_query("CALL Crea_Gruppo('$Nomegr')");
	header("Location:../first_page.php?avviso=Gruppo%20$Nomegr%20creato!");
?>
