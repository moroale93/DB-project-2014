<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$idGruppo=trim($_GET['idGruppo']);
	$stato=trim($_GET["statoInserito"]);
	$cap=trim($_GET["CAPLuogo"]);
	$citta=trim($_GET["CittaLuogo"]);
	$altitudine=trim($_GET["AltitudineLuogo"]);
	$naz=trim($_GET["NazioneLuogo"]);
	$result=mysql_query("call Posta_Stato_Su_Gruppo('$idGruppo',\"".mysql_real_escape_string($stato)."\",'$cap','$citta','$altitudine','$naz')");
	header("Location:../first_page.php?avviso=Post%20inserito!");
?>
