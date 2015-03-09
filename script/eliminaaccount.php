<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$email=trim($_SESSION['username']);
	mysql_query("CALL Rimuovi_Account('$email');");	
	include './logout.php';
?>
