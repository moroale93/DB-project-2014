<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$emailSessione=trim($_SESSION['username']);
	$emailRic=trim($_GET['NomePersona']);
	$result=mysql_query("call Richiedi_Amicizia('$emailSessione','$emailRic')") or die(header("Location:../first_page.php?avviso=Errore!"));
	header("Location:../first_page.php?avviso=Richiesta%20inviata!");
?>