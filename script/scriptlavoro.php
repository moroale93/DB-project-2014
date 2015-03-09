<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$email=trim($_SESSION["username"]);
	$tipo=$_GET["tipo"];
	if($tipo=="1"){
		$nome=$_GET["NomeLavoro"];
		$dat=$_GET["nomeDat"];
		$data=$_GET["DataLavoro"];
		$cap=$_GET["CAPLuogo"];
		$nomel=$_GET["NomeLuogo"];
		$alt=$_GET["Altitudine"];
		$stato=$_GET["stato"];
		mysql_query("CALL Lavora_Presso('$email',\"".mysql_real_escape_string($nome)."\",'$dat','$data','$cap','$nomel','$alt','$stato')");
	}
	else {
		$idl=$_GET["idLavoro"];
		mysql_query("update Persone set IdLavoro='$idl' where EmailUser='$email';");
	}
	header("Location:../first_page.php?avviso=informazione%20inserita!");
?>
