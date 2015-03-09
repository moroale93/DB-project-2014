<?php
	session_start();
	if(!isset($_SESSION['username']))
		header("Location:../index.php");
	include '../include/connection.php';
	$idGruppo=$_POST['idGruppo'];
	$cap=trim($_POST["CAPLuogo"]);
	$citta=trim($_POST["CittaLuogo"]);
	$altitudine=trim($_POST["AltitudineLuogo"]);
	$naz=trim($_POST["NazioneLuogo"]);
		
	//inizio upload foto
	//get file information --step1
	$fileName = $_FILES['userfile']['name'];
	$tmpName = $_FILES['userfile']['tmp_name'];
	$fileSize = $_FILES['userfile']['size'];
	//get file content -- step1
	if($fileSize!=0){
		$fp = fopen($tmpName, "r");
		$content = fread($fp, $fileSize);
		$content = addslashes($content);
		fclose($fp);
		//insert into database --step3 
		$query = mysql_query("call Posta_Foto_Su_Gruppo('$idGruppo','$content','$cap','$citta','$altitudine','$naz')")
		or die(header("Location:../first_page.php?avviso=Foto%20non%20caricata!"));
		//fine upload foto
		header("Location:../first_page.php?avviso=Foto%20caricata!");
	}
?>
