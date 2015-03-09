<?php
	include '../include/header.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>LifeON</title>
	</head>
	<body style="background-position-y: 35pt">
		<form action="../script/scriptcreagruppo.php" method="get">
			<legend>Crea Gruppo:</legend>
			<label for="gruppo">Nome Gruppo*</label>
			<input type="text" id="gruppo" name="NomeGruppo">
			<input type="submit" id="Crea" value="Crea">
		</form>
	</body>
</html>