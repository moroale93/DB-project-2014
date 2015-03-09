<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$email=trim($_SESSION["username"]);
	$tipo=$_GET["tipo"];
	if($tipo=="1"){
		$cap=$_GET["CAPLuogo"];
		$nomel=$_GET["NomeLuogo"];
		$altit=$_GET["Altitudine"];
		$stato=$_GET["stato"];
		mysql_query("CALL Visita_Luogo('$email','$cap','$nomel','$altit','$stato');");
	}
	else {
		$id=trim($_GET["cap"]);
		mysql_query("insert into PersoneLuoghi(Idluogo,EmailUser) values('$id','$email');");
	}
	header("Location:../first_page.php?avviso=informazione%20inserita!");
?>
