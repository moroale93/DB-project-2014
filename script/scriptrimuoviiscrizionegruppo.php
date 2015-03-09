<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$gruppo=trim($_GET['IdGruppoDEL']);
	$email=trim($_SESSION['username']);
	mysql_query("CALL Disiscrizione_Gruppo('$email','$gruppo');");
	header("Location:../first_page.php?avviso=Iscrizione%20rimossa%20!");
?>
