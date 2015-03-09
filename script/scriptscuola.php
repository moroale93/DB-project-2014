<?php
session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$email=trim($_SESSION["username"]);
	$tipo=$_GET["tipo"];
	if($tipo=="1"){
		$nome=$_GET["NomeScuola"];
		$grado=$_GET["GradoScuola"];
		$data=$_GET["DataScuola"];
		$cap=$_GET["CAPLuogo"];
		$nomel=$_GET["NomeLuogo"];
		$alt=$_GET["Altitudine"];
		$stato=$_GET["stato"];
		mysql_query("CALL Studia_Presso('$email',\"".mysql_real_escape_string($nome)."\",'$grado','$data','$cap','$nomel','$alt','$stato')");
	}
	else {
		$ids=trim($_GET["idscuola"]);
		mysql_query("update Persone set IdScuola='$ids' where EmailUser='$email';");
	}
	header("Location:../first_page.php?avviso=informazione%20inserita!");
?>
