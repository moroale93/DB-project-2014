<?php
	include '../include/header.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<br/>
		<a href="accettaamici.php"><img style="border:0;" src="../img/richieste.png" width="300" height="40"></a><br /><br />
		<form action="formcercapersona.php" method="get">
			<legend>Cerca Persona:</legend>
			<label for="NomeP">Nome Persona*</label>
			<input type="text" id="NomeP" name="NomePersona">
			<label for="CognomeP">Cognome Persona*</label>
			<input type="text" id="CognomeP" name="CognomePersona">
			<input type="submit" id="cerca" value="Cerca">
		</form>
	</body>
</html>