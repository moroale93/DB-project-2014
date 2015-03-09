<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$IdGruppo=$_GET['idGruppo'];
	$email=trim($_SESSION['username']);
	mysql_query("CALL Iscrizione_Gruppo('$email','$IdGruppo')");
	//magari con value della form con id nascosto in versione 2.0
	header("Location:../first_page.php?avviso=Sei%20iscritto%20!");
?>
