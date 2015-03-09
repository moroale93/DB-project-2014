<?php

	function ripristina_situazione_e_alert($maxid)
	{
    	mysql_query("delete from Bacheche where IdBacheca = '$maxid'");
    	header("Location:../index.php?avviso=Campi%20con%20errori%20(devi%20essere%20maggiorenne%20)");
	}

	$email=$_POST['user'];
	$password=$_POST['psw'];
	$passwordcon=$_POST['pswcon'];
	$nome=$_POST['nome'];
	$cognome=$_POST['cognome'];
	$data=$_POST['data'];
	if($passwordcon===$password){
		$passin=sha1($password);
	include '../include/connection.php';
		mysql_query("call Registra_Persona('$email','$passin','$nome','$cognome','$data')")
		or die(ripristina_situazione_e_alert($max));
		header("Location:../index.php?avviso=Accedi%20ora%20sei%20registrato");
		mysql_close();
	}
	else {
		header("Location:../index.php?avviso=La%20Password%20non%20coincide");
	}
?>
