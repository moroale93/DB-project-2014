<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$emailsession=trim($_SESSION['username']);
	$idpost=$_GET['idpost'];
	$email=$_GET['email'];
	mysql_query("insert into Likes(EmailUser,IdPost) values('$emailsession','$idpost')");
	header("Location:../form/profiloamico.php?EmailPersona=$email");
?>
